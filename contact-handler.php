<?php
/**
 * Contact / appointment form handler.
 * Validates input, blocks obvious spam, and emails the enquiry to the hospital.
 * Update $site['email'] in includes/config.php with the real inbox before going live,
 * and fill in $site['smtp'] (see includes/mailer.php) once Mailcow is configured.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/mailer.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/ics.php';

function redirect_with_status($status) {
    header('Location: contact.php?status=' . $status . '#book');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_status('invalid');
}

// CSRF check — the token is minted per-session in contact.php.
$submittedToken = $_POST['csrf_token'] ?? '';
if (empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $submittedToken)) {
    redirect_with_status('invalid');
}

// Honeypot — if this hidden field is filled, silently treat as spam.
if (!empty($_POST['website'])) {
    redirect_with_status('success');
}

$name      = trim($_POST['name'] ?? '');
$phone     = trim($_POST['phone'] ?? '');
$email     = trim($_POST['email'] ?? '');
$service   = trim($_POST['service'] ?? '');
$message   = trim($_POST['message'] ?? '');
$apptDate  = trim($_POST['appt_date'] ?? '');
$apptTime  = trim($_POST['appt_time'] ?? '');

if ($name === '' || $phone === '' || $message === '') {
    redirect_with_status('invalid');
}

if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirect_with_status('invalid');
}

// Preferred date/time are optional, but if given they must be a real,
// future, in-hours slot — not just whatever a tampered POST body sends.
$apptDateTime = null;
if ($apptDate !== '') {
    $parsedDate = DateTimeImmutable::createFromFormat('Y-m-d', $apptDate);
    if (!$parsedDate || $parsedDate->format('Y-m-d') !== $apptDate || $parsedDate < new DateTimeImmutable('tomorrow')) {
        redirect_with_status('invalid');
    }
    if ($parsedDate->format('N') === '7') { // closed Sundays per $site['hours']
        redirect_with_status('invalid');
    }
    if ($apptTime !== '') {
        if (!preg_match('/^([01]\d|2[0-3]):[0-5]\d$/', $apptTime)) {
            redirect_with_status('invalid');
        }
        [$hour, $minute] = array_map('intval', explode(':', $apptTime));
        $minutesSinceMidnight = $hour * 60 + $minute;
        if ($minutesSinceMidnight < 8 * 60 || $minutesSinceMidnight > 17 * 60 + 30) {
            redirect_with_status('invalid');
        }
        $apptDateTime = $parsedDate->setTime($hour, $minute);
    }
}

$name    = strip_tags($name);
$phone   = strip_tags($phone);
$service = strip_tags($service);
$message = strip_tags($message);

save_appointment_request([
    'name'      => $name,
    'phone'     => $phone,
    'email'     => $email !== '' ? $email : null,
    'service'   => $service !== '' ? $service : null,
    'message'   => $message,
    'appt_date' => $apptDate !== '' ? $apptDate : null,
    'appt_time' => $apptTime !== '' ? $apptTime : null,
]);

$to      = $site['email'];
$subject = 'New Enquiry — ' . $site['name'] . ($service !== '' ? ' (' . $service . ')' : '');

$body  = "New enquiry received via the website contact form:\n\n";
$body .= "Name: {$name}\n";
$body .= "Phone: {$phone}\n";
$body .= "Email: " . ($email !== '' ? $email : 'Not provided') . "\n";
$body .= "Service: " . ($service !== '' ? $service : 'Not specified') . "\n";
if ($apptDate !== '') {
    $body .= "Preferred date/time: {$apptDate} " . ($apptTime !== '' ? $apptTime : '(no specific time)') . "\n";
}
$body .= "\nMessage:\n{$message}\n";

$sent = send_site_mail($site, $to, $subject, $body, $email !== '' ? $email : null);

// If we have both an email and a concrete requested slot, send the patient
// a calendar invite for it — clearly marked as a request, not a booking.
if ($sent && $email !== '' && $apptDateTime !== null) {
    $ics = build_appointment_ics($site, $name, $apptDateTime);
    $confirmSubject = 'Your appointment request — ' . $site['name'];
    $confirmBody = "Hi {$name},\n\n"
        . "We've received your appointment request for " . $apptDateTime->format('l, j F Y \a\t g:i A') . " at {$site['name']}.\n"
        . "This is a request, not a confirmed booking — our team will call or email you to confirm the exact time.\n\n"
        . "A calendar invite is attached so you can hold the slot provisionally.\n\n"
        . "If anything urgent comes up before then, call us on {$site['phone']}.\n";
    send_site_mail($site, $email, $confirmSubject, $confirmBody, $site['email'], [
        ['filename' => 'appointment-request.ics', 'mime' => 'text/calendar; method=REQUEST', 'content' => $ics],
    ]);
}

// One-time token — mint a fresh one so a replayed POST can't resubmit.
unset($_SESSION['csrf_token']);

redirect_with_status($sent ? 'success' : 'error');
