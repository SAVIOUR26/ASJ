<?php
/**
 * SQLite storage for appointment requests submitted through the contact
 * form — uses pdo_sqlite (a PHP extension, not a Composer package) to
 * keep with the site's no-build-step approach. The database file lives
 * outside version control (see .gitignore) and is created on first use.
 */
function get_appointments_db(): PDO
{
    $dir = __DIR__ . '/../data';
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }

    $pdo = new PDO('sqlite:' . $dir . '/appointments.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('CREATE TABLE IF NOT EXISTS appointment_requests (
        id             INTEGER PRIMARY KEY AUTOINCREMENT,
        name           TEXT NOT NULL,
        phone          TEXT NOT NULL,
        email          TEXT,
        service        TEXT,
        message        TEXT,
        appt_date      TEXT,
        appt_time      TEXT,
        status         TEXT NOT NULL DEFAULT "pending",
        reminder_sent  INTEGER NOT NULL DEFAULT 0,
        created_at     TEXT NOT NULL
    )');

    return $pdo;
}

function save_appointment_request(array $data): int
{
    $pdo = get_appointments_db();
    $stmt = $pdo->prepare('INSERT INTO appointment_requests
        (name, phone, email, service, message, appt_date, appt_time, created_at)
        VALUES (:name, :phone, :email, :service, :message, :appt_date, :appt_time, :created_at)');
    $stmt->execute([
        ':name'       => $data['name'],
        ':phone'      => $data['phone'],
        ':email'      => $data['email'] ?? null,
        ':service'    => $data['service'] ?? null,
        ':message'    => $data['message'] ?? null,
        ':appt_date'  => $data['appt_date'] ?? null,
        ':appt_time'  => $data['appt_time'] ?? null,
        ':created_at' => gmdate('c'),
    ]);

    return (int) $pdo->lastInsertId();
}
