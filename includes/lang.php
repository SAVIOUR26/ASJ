<?php
/**
 * Minimal i18n scaffolding: an English dictionary (real, complete) and a
 * Luganda one (structurally complete, but each string still holds the
 * English text — see lang/lg.php). This covers shared chrome (nav, footer,
 * a few buttons), not full page copy; translating the marketing prose
 * throughout the site is a separate, larger pass a native speaker should
 * review for medical/cultural accuracy before it ships.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$available_locales = ['en', 'lg'];

if (isset($_GET['lang']) && in_array($_GET['lang'], $available_locales, true)) {
    $_SESSION['locale'] = $_GET['lang'];
}

$locale = $_SESSION['locale'] ?? 'en';
if (!in_array($locale, $available_locales, true)) {
    $locale = 'en';
}

$translations = require __DIR__ . '/../lang/en.php';
if ($locale !== 'en') {
    $translations = array_merge($translations, require __DIR__ . '/../lang/' . $locale . '.php');
}

function t(string $key): string
{
    global $translations;
    return $translations[$key] ?? $key;
}
