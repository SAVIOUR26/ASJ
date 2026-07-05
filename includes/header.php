<?php
require_once __DIR__ . '/config.php';
$page_title = isset($page_title) ? $page_title . ' — ' . $site['name'] : $site['name'] . ' — ' . $site['tagline'];
$page_desc  = isset($page_desc) ? $page_desc : 'ASJ Eye Hospital in Kampala offers comprehensive eye care — cataract, LASIK, glaucoma, retina and pediatric ophthalmology — from experienced specialists using modern diagnostic technology.';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title) ?></title>
<meta name="description" content="<?= htmlspecialchars($page_desc) ?>">
<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32.png">
<link rel="apple-touch-icon" href="assets/img/favicon-180.png">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<a class="skip-link" href="#main">Skip to content</a>

<div class="topbar">
    <div class="container topbar__inner">
        <div class="topbar__item"><i class="fa-solid fa-location-dot" aria-hidden="true"></i> <?= htmlspecialchars($site['address']) ?></div>
        <div class="topbar__item topbar__item--right">
            <a href="tel:<?= htmlspecialchars($site['phone_href']) ?>"><i class="fa-solid fa-phone" aria-hidden="true"></i> <?= htmlspecialchars($site['phone']) ?></a>
            <span class="topbar__divider" aria-hidden="true">|</span>
            <span><i class="fa-regular fa-clock" aria-hidden="true"></i> <?= htmlspecialchars($site['hours']) ?></span>
        </div>
    </div>
</div>

<header class="site-header" id="site-header">
    <div class="container site-header__inner">
        <a href="index.php" class="brand">
            <img src="assets/img/logo.jpg" alt="<?= htmlspecialchars($site['name']) ?> logo" class="brand__logo">
            <span class="brand__text">
                <span class="brand__name">ASJ <em>Eye Hospital</em></span>
                <span class="brand__tag">Kampala</span>
            </span>
        </a>

        <nav class="nav" id="site-nav" aria-label="Primary">
            <ul class="nav__list">
                <?php foreach ($nav as $item): ?>
                <li>
                    <a href="<?= htmlspecialchars($item['href']) ?>" class="<?= $current === $item['href'] ? 'is-active' : '' ?>">
                        <?= htmlspecialchars($item['label']) ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <div class="site-header__actions">
            <a href="contact.php#book" class="btn btn--primary">
                <i class="fa-regular fa-calendar-check" aria-hidden="true"></i> Book Appointment
            </a>
            <button class="nav-toggle" id="nav-toggle" aria-expanded="false" aria-controls="site-nav" aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>

<main id="main">
