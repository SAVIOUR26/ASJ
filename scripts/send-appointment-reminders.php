<?php
/**
 * Sends an SMS reminder for every appointment request scheduled for
 * tomorrow that hasn't already had one sent. Meant to run once a day via
 * cron — it isn't wired up to anything automatically, since that's a
 * server-level change outside this repo (see README > Deployment):
 *
 *   0 8 * * * php /path/to/site/scripts/send-appointment-reminders.php
 *
 * A no-op until $site['sms'] (includes/config.php) has real Africa's
 * Talking credentials — see includes/notifier.php.
 */
if (php_sapi_name() !== 'cli') {
    http_response_code(403);
    exit('This script is meant to be run from the command line (cron), not the web.');
}

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/notifier.php';

$tomorrow = (new DateTimeImmutable('tomorrow'))->format('Y-m-d');

$pdo = get_appointments_db();
$stmt = $pdo->prepare('SELECT * FROM appointment_requests
    WHERE appt_date = :date AND reminder_sent = 0 AND status != "cancelled"');
$stmt->execute([':date' => $tomorrow]);
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($appointments)) {
    echo "No appointment reminders due for {$tomorrow}.\n";
    exit(0);
}

$markSent = $pdo->prepare('UPDATE appointment_requests SET reminder_sent = 1 WHERE id = :id');

foreach ($appointments as $appt) {
    $when = trim($appt['appt_date'] . ' ' . $appt['appt_time']);
    $message = "Reminder: your appointment request with {$site['name']} is for {$when}. "
        . "Reply or call {$site['phone']} if you need to reschedule.";

    $sent = send_sms_notification($site, $appt['phone'], $message);
    $markSent->execute([':id' => $appt['id']]);

    printf("[%s] %s (%s) -> %s\n", $appt['id'], $appt['name'], $appt['phone'], $sent ? 'sent' : 'skipped (SMS not configured)');
}
