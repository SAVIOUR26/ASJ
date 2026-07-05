<?php
/**
 * Dynamic sitemap.xml — served at /sitemap.xml via the rewrite rule in
 * .htaccess. Lists every public page with its on-disk last-modified time,
 * so it never drifts out of sync with what's actually on the site.
 */
header('Content-Type: application/xml; charset=UTF-8');

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$origin = $scheme . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost');

// 'file' is the on-disk script (for lastmod); 'path' is the clean public URL.
$pages = [
    ['file' => 'index.php',    'path' => '',         'priority' => '1.0'],
    ['file' => 'about.php',    'path' => 'about',    'priority' => '0.8'],
    ['file' => 'services.php', 'path' => 'services', 'priority' => '0.9'],
    ['file' => 'doctors.php',  'path' => 'doctors',  'priority' => '0.7'],
    ['file' => 'blog.php',     'path' => 'blog',     'priority' => '0.6'],
    ['file' => 'contact.php',  'path' => 'contact',  'priority' => '0.8'],
    ['file' => 'privacy.php',  'path' => 'privacy',  'priority' => '0.3'],
    ['file' => 'terms.php',    'path' => 'terms',    'priority' => '0.3'],
];

require_once __DIR__ . '/includes/blog-data.php';
foreach ($blog_posts as $post) {
    $pages[] = [
        'file'     => 'includes/blog-data.php',
        'path'     => 'blog/' . $post['slug'],
        'priority' => '0.5',
    ];
}

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($pages as $page): ?>
    <url>
        <loc><?= htmlspecialchars($origin . '/' . $page['path']) ?></loc>
        <lastmod><?= date('Y-m-d', filemtime(__DIR__ . '/' . $page['file'])) ?></lastmod>
        <priority><?= $page['priority'] ?></priority>
    </url>
<?php endforeach; ?>
</urlset>
