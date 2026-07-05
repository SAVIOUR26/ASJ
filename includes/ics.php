<?php
/**
 * Build a minimal .ics calendar invite (RFC 5545) for an appointment
 * request, so a patient can drop it straight into their phone's calendar.
 * It's a request, not a confirmed slot — the summary/description say so.
 */
function build_appointment_ics(array $site, string $patientName, DateTimeImmutable $start, int $durationMinutes = 30): string
{
    $end = $start->modify("+{$durationMinutes} minutes");
    $uid = bin2hex(random_bytes(16)) . '@' . preg_replace('/[^a-z0-9.-]/i', '', $_SERVER['HTTP_HOST'] ?? 'asjeyehospital.com');

    $escape = fn(string $v) => str_replace(["\\", ",", ";", "\n"], ["\\\\", "\\,", "\\;", "\\n"], $v);

    $lines = [
        'BEGIN:VCALENDAR',
        'VERSION:2.0',
        'PRODID:-//' . $escape($site['name']) . '//Website//EN',
        'METHOD:REQUEST',
        'BEGIN:VEVENT',
        'UID:' . $uid,
        'DTSTAMP:' . gmdate('Ymd\THis\Z'),
        'DTSTART:' . $start->setTimezone(new DateTimeZone('UTC'))->format('Ymd\THis\Z'),
        'DTEND:' . $end->setTimezone(new DateTimeZone('UTC'))->format('Ymd\THis\Z'),
        'SUMMARY:' . $escape('Appointment request — ' . $site['name']),
        'DESCRIPTION:' . $escape("Requested appointment for {$patientName} at {$site['name']}. This is a request pending confirmation by our team, not a booked slot — we'll be in touch to confirm the exact time."),
        'LOCATION:' . $escape($site['address']),
        'STATUS:TENTATIVE',
        'END:VEVENT',
        'END:VCALENDAR',
    ];

    return implode("\r\n", $lines) . "\r\n";
}
