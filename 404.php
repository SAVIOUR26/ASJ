<?php
$page_title = 'Page Not Found';
$page_desc  = 'The page you are looking for could not be found.';
require_once __DIR__ . '/includes/header.php';
?>

<section class="section" style="text-align:center; padding-block:120px;">
    <div class="container">
        <span class="eyebrow" style="justify-content:center;">404</span>
        <h1 style="margin-top:14px;">We couldn't bring this page into focus.</h1>
        <p style="max-width:50ch; margin:16px auto 32px;">The page you're looking for may have moved or no longer exists. Let's get you back on track.</p>
        <a href="index.php" class="btn btn--primary"><i class="fa-solid fa-house"></i> Back to Home</a>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
