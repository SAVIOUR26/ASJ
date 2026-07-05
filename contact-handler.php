<?php
/**
 * Contact / appointment form handler.
 * Validates input, blocks obvious spam, and emails the enquiry to the hospital.
 * Update $site['email'] in includes/config.php with the real inbox before going live,
 * and make sure the server's mail() function (or an SMTP-based mailer) is configured.
 */
require_once __DIR__ . '/includes/config.php';

function redirect_with_status($status) {
    header('Location: contact.php?status=' . $status . '#book');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_status('invalid');
}

// Honeypot — if this hidden field is filled, silently treat as spam.
if (!empty($_POST['website'])) {
    redirect_with_status('success');
}

$name    = trim($_POST['name'] ?? '');
$phone   = trim($_POST['phone'] ?? '');
$email   = trim($_POST['email'] ?? '');
$service = trim($_POST['service'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $phone === '' || $message === '') {
    redirect_with_status('invalid');
}

if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirect_with_status('invalid');
}

$name    = strip_tags($name);
$phone   = strip_tags($phone);
$service = strip_tags($service);
$message = strip_tags($message);

$to      = $site['email'];
$subject = 'New Enquiry — ' . $site['name'] . ($service !== '' ? ' (' . $service . ')' : '');

$body  = "New enquiry received via the website contact form:\n\n";
$body .= "Name: {$name}\n";
$body .= "Phone: {$phone}\n";
$body .= "Email: " . ($email !== '' ? $email : 'Not provided') . "\n";
$body .= "Service: " . ($service !== '' ? $service : 'Not specified') . "\n\n";
$body .= "Message:\n{$message}\n";

$headers = "From: " . $site['name'] . " Website <no-reply@" . ($_SERVER['HTTP_HOST'] ?? 'localhost') . ">\r\n";
if ($email !== '') {
    $headers .= "Reply-To: {$email}\r\n";
}

$sent = @mail($to, $subject, $body, $headers);

redirect_with_status($sent ? 'success' : 'error');
