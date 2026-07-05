<?php
require_once __DIR__ . '/includes/blog-data.php';

$slug = $_GET['slug'] ?? '';
$post = null;
foreach ($blog_posts as $candidate) {
    if ($candidate['slug'] === $slug) {
        $post = $candidate;
        break;
    }
}

if ($post === null) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    return;
}

$page_title = $post['title'];
$page_desc  = $post['excerpt'];
$current    = 'blog'; // highlight "Insights" in the nav, not a nonexistent tab for this post
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header">
    <div class="container">
        <div class="breadcrumb"><a href="/">Home</a> <i class="fa-solid fa-chevron-right" style="font-size:0.6rem;"></i> <a href="/blog">Insights</a> <i class="fa-solid fa-chevron-right" style="font-size:0.6rem;"></i> <span><?= htmlspecialchars($post['title']) ?></span></div>
        <span class="eyebrow"><?= htmlspecialchars(date('j F Y', strtotime($post['date']))) ?></span>
        <h1><?= htmlspecialchars($post['title']) ?></h1>
    </div>
</section>

<section class="section">
    <div class="container" style="max-width: 760px;">
        <?php if ($post['example']): ?>
        <p class="doctor-note"><i class="fa-solid fa-circle-info"></i> Example post demonstrating this section — pending review by ASJ's own clinical staff before publishing as the hospital's guidance.</p>
        <?php endif; ?>

        <div class="blog-post-body"><?= $post['body'] ?></div>

        <p style="margin-top: 40px;"><a href="/blog" class="btn btn--outline"><i class="fa-solid fa-arrow-left"></i> Back to Insights</a></p>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
