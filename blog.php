<?php
$page_title = 'Insights';
$page_desc  = 'General eye-health guidance and updates from ASJ Eye Hospital, Kampala.';
require_once __DIR__ . '/includes/blog-data.php';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header">
    <div class="container">
        <div class="breadcrumb"><a href="/">Home</a> <i class="fa-solid fa-chevron-right" style="font-size:0.6rem;"></i> <span>Insights</span></div>
        <span class="eyebrow">From ASJ Eye Hospital</span>
        <h1>Eye-health guidance, in plain language.</h1>
        <p>General information to help you know when — and why — to see a specialist. Always book a consultation for anything specific to your own eyes.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <p class="doctor-note"><i class="fa-solid fa-circle-info"></i> The posts below are example content demonstrating this section — written to be safely general, but still pending review by ASJ's own clinical staff before they should be treated as the hospital's published guidance.</p>

        <div class="doctor-grid" style="margin-top: 32px;">
            <?php foreach ($blog_posts as $post): ?>
            <article class="doctor-card reveal">
                <div class="doctor-card__body">
                    <span class="doctor-card__role"><?= htmlspecialchars(date('j F Y', strtotime($post['date']))) ?><?= $post['example'] ? ' · Example post' : '' ?></span>
                    <h3><a href="/blog/<?= htmlspecialchars($post['slug']) ?>"><?= htmlspecialchars($post['title']) ?></a></h3>
                    <p><?= htmlspecialchars($post['excerpt']) ?></p>
                    <p style="margin-top: 14px;"><a href="/blog/<?= htmlspecialchars($post['slug']) ?>" class="service-card__link">Read more <i class="fa-solid fa-arrow-right"></i></a></p>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
