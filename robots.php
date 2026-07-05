<?php
/**
 * Dynamic robots.txt — served at /robots.txt via the rewrite rule in
 * .htaccess. Built from the live request so the Sitemap: line always
 * points at the right host, whatever domain this ends up deployed on.
 */
header('Content-Type: text/plain; charset=UTF-8');

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$origin = $scheme . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost');
?>
User-agent: *
Allow: /

Sitemap: <?= $origin ?>/sitemap.xml
