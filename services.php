<?php
$page_title = 'Services';
$page_desc  = 'Explore ASJ Eye Hospital\'s full range of eye care services — cataract surgery, LASIK, glaucoma care, retina treatment, pediatric ophthalmology and more.';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header">
    <div class="container">
        <div class="breadcrumb"><a href="/">Home</a> <i class="fa-solid fa-chevron-right" style="font-size:0.6rem;"></i> <span>Services</span></div>
        <span class="eyebrow">Our Specialities</span>
        <h1>Eye care for every condition, every age.</h1>
        <p>From routine exams to advanced surgical treatment — each service below is led by specialists focused on that specific area of the eye.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="services-grid">
            <?php foreach ($services as $s): ?>
            <div class="service-card reveal" id="<?= htmlspecialchars($s['slug']) ?>">
                <div class="service-card__icon"><i class="fa-solid <?= htmlspecialchars($s['icon']) ?>"></i></div>
                <h3><?= htmlspecialchars($s['name']) ?></h3>
                <p><?= htmlspecialchars($s['short']) ?></p>
                <a href="/contact#book" class="service-card__link">Book a consultation <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section--mist">
    <div class="container">
        <div class="section-head center">
            <span class="eyebrow">Not Sure Which Service You Need?</span>
            <h2>Start with a comprehensive eye exam.</h2>
            <p>If you're unsure what's affecting your vision, a full diagnostic exam is the right first step — we'll identify the issue and direct you to the specialist you need.</p>
        </div>
        <div class="text-center">
            <a href="/contact#book" class="btn btn--primary"><i class="fa-regular fa-calendar-check"></i> Book a Comprehensive Exam</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
