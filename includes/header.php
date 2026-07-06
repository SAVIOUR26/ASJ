<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/lang.php';
$page_title = isset($page_title) ? $page_title . ' — ' . $site['name'] : $site['name'] . ' — ' . $site['tagline'];
$page_desc  = isset($page_desc) ? $page_desc : 'ASJ Eye Hospital in Kampala offers comprehensive eye care — cataract, LASIK, glaucoma, retina and pediatric ophthalmology — from experienced specialists using modern diagnostic technology.';
$page_image = isset($page_image) ? $page_image : 'assets/img/photo-eye-macro.jpg';

// Built from the live request rather than a hardcoded domain, so canonical/
// OG tags are correct on localhost, staging, or the eventual production host.
$scheme      = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$origin      = $scheme . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost');
$canonical   = $origin . '/' . ltrim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
$page_image_url = str_starts_with($page_image, 'http') ? $page_image : $origin . '/' . ltrim($page_image, '/');

$social_links = array_filter($site['social'], fn($url) => $url !== '' && $url !== '#');
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($locale) ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title) ?></title>
<meta name="description" content="<?= htmlspecialchars($page_desc) ?>">
<link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32.png">
<link rel="apple-touch-icon" href="assets/img/favicon-180.png">

<!-- Open Graph / Twitter card -->
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= htmlspecialchars($site['name']) ?>">
<meta property="og:title" content="<?= htmlspecialchars($page_title) ?>">
<meta property="og:description" content="<?= htmlspecialchars($page_desc) ?>">
<meta property="og:url" content="<?= htmlspecialchars($canonical) ?>">
<meta property="og:image" content="<?= htmlspecialchars($page_image_url) ?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= htmlspecialchars($page_title) ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($page_desc) ?>">
<meta name="twitter:image" content="<?= htmlspecialchars($page_image_url) ?>">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">

<!-- schema.org: helps Google understand this as a medical clinic, its
     address, hours and contact point (uses live config data — fill in
     includes/config.php and this updates automatically). -->
<script type="application/ld+json">
<?= json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'MedicalClinic',
    'name'     => $site['name'],
    'url'      => $origin . '/',
    'image'    => $page_image_url,
    'telephone'=> $site['phone_href'],
    'email'    => $site['email'],
    'address'  => [
        '@type'           => 'PostalAddress',
        'streetAddress'   => $site['address_street'],
        'addressLocality' => $site['address_city'],
        'addressCountry'  => $site['address_country'],
    ],
    'medicalSpecialty' => 'Ophthalmic',
    'sameAs'   => array_values($social_links),
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
</script>

<?php if (!empty($site['ga4_id'])): ?>
<!-- Google Analytics (GA4) — only loads once $site['ga4_id'] is set. -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= urlencode($site['ga4_id']) ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?= htmlspecialchars($site['ga4_id']) ?>');
</script>
<?php endif; ?>
</head>
<body>

<a class="skip-link" href="#main">Skip to content</a>

<div class="topbar">
    <div class="container topbar__inner">
        <div class="topbar__item"><i class="fa-solid fa-location-dot" aria-hidden="true"></i> <?= htmlspecialchars($site['address']) ?></div>
        <div class="topbar__item topbar__item--right">
            <a href="tel:<?= htmlspecialchars($site['phone_href']) ?>"><i class="fa-solid fa-phone" aria-hidden="true"></i> <?= htmlspecialchars($site['phone']) ?></a>
            <span class="topbar__divider" aria-hidden="true">|</span>
            <span><i class="fa-regular fa-clock" aria-hidden="true"></i> <?= htmlspecialchars($site['hours_short']) ?></span>
            <span class="topbar__divider" aria-hidden="true">|</span>
            <span class="lang-switch">
                <a href="?lang=en" class="<?= $locale === 'en' ? 'is-active' : '' ?>" aria-current="<?= $locale === 'en' ? 'true' : 'false' ?>">EN</a>
                <span aria-hidden="true">/</span>
                <a href="?lang=lg" class="<?= $locale === 'lg' ? 'is-active' : '' ?>" aria-current="<?= $locale === 'lg' ? 'true' : 'false' ?>">LG</a>
            </span>
        </div>
    </div>
</div>

<?php if ($locale === 'lg'): ?>
<div class="lang-pending-notice"><i class="fa-solid fa-language" aria-hidden="true"></i> <?= htmlspecialchars(t('lang_pending_notice')) ?></div>
<?php endif; ?>

<header class="site-header" id="site-header">
    <div class="container site-header__inner">
        <a href="/" class="brand">
            <picture><source srcset="assets/img/logo.webp" type="image/webp"><img src="assets/img/logo.jpg" alt="<?= htmlspecialchars($site['name']) ?> logo" width="1024" height="1024" loading="eager" decoding="async" class="brand__logo"></picture>
            <span class="brand__text">
                <span class="brand__name">ASJ <em>Eye Hospital</em></span>
                <span class="brand__tag">Kampala</span>
            </span>
        </a>

        <nav class="nav" id="site-nav" aria-label="Primary">
            <ul class="nav__list">
                <?php foreach ($nav as $item): ?>
                <li>
                    <a href="<?= htmlspecialchars($item['href']) ?>" class="<?= $current === $item['match'] ? 'is-active' : '' ?>">
                        <?= htmlspecialchars(t('nav_' . $item['match'])) ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <div class="site-header__actions">
            <a href="/contact#book" class="btn btn--primary" aria-label="<?= htmlspecialchars(t('book_appointment')) ?>">
                <i class="fa-regular fa-calendar-check" aria-hidden="true"></i> <span><?= htmlspecialchars(t('book_appointment')) ?></span>
            </a>
            <button class="nav-toggle" id="nav-toggle" aria-expanded="false" aria-controls="site-nav" aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>

<main id="main">
