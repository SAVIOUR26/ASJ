<?php
/**
 * Planned-maintenance page. Not linked from navigation — shown site-wide
 * only when the maintenance-mode rewrite block in .htaccess is switched on.
 */
$page_title = 'Down for Maintenance';
$page_desc  = 'ASJ Eye Hospital website is briefly down for scheduled maintenance.';
require_once __DIR__ . '/includes/header.php';
?>

<section class="section" style="text-align:center; padding-block:120px;">
    <div class="container">
        <span class="eyebrow" style="justify-content:center;">Back Shortly</span>
        <h1 style="margin-top:14px;">We're making a few improvements.</h1>
        <p style="max-width:50ch; margin:16px auto 32px;">The website is briefly offline for scheduled maintenance and will be back soon. For anything urgent in the meantime, please call or WhatsApp us directly.</p>
        <div class="hero__actions" style="justify-content:center;">
            <a href="tel:<?= htmlspecialchars($site['phone_href']) ?>" class="btn btn--primary"><i class="fa-solid fa-phone"></i> <?= htmlspecialchars($site['phone']) ?></a>
            <a href="https://wa.me/<?= htmlspecialchars($site['whatsapp']) ?>" class="btn btn--outline" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp Us</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
