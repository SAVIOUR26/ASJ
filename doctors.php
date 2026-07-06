<?php
$page_title = 'Our Team';
$page_desc  = 'Meet the specialist team at ASJ Eye Hospital, Kampala.';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header">
    <div class="container">
        <div class="breadcrumb"><a href="/">Home</a> <i class="fa-solid fa-chevron-right" style="font-size:0.6rem;"></i> <span>Our Team</span></div>
        <span class="eyebrow">Meet the Experts</span>
        <h1>Specialists focused on one thing — your eyes.</h1>
        <p>Every member of our clinical team works in ophthalmology exclusively, so your care is always led by someone who specializes in exactly what you need.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <!--
            TODO for ASJ Eye Hospital: replace the placeholder roles, photos and
            bios below with your actual specialists' names, qualifications and headshots.
        -->
        <div class="doctor-grid">
            <div class="doctor-card reveal">
                <div class="doctor-card__photo"><picture><source srcset="assets/img/photo-team.webp" type="image/webp"><img src="assets/img/photo-team.jpg" alt="Placeholder photo for Lead Ophthalmologist — replace with real staff photo" width="800" height="533" loading="lazy" decoding="async"></picture></div>
                <div class="doctor-card__body">
                    <h3>Lead Ophthalmologist</h3>
                    <span class="doctor-card__role">Cataract &amp; Refractive Surgery</span>
                    <p>Placeholder profile — add name, qualifications and years of experience.</p>
                </div>
            </div>
            <div class="doctor-card reveal">
                <div class="doctor-card__photo"><picture><source srcset="assets/img/photo-exam-2.webp" type="image/webp"><img src="assets/img/photo-exam-2.jpg" alt="Placeholder photo for Consultant Ophthalmologist — replace with real staff photo" width="800" height="533" loading="lazy" decoding="async"></picture></div>
                <div class="doctor-card__body">
                    <h3>Consultant Ophthalmologist</h3>
                    <span class="doctor-card__role">Retina &amp; Vitreous</span>
                    <p>Placeholder profile — add name, qualifications and years of experience.</p>
                </div>
            </div>
            <div class="doctor-card reveal">
                <div class="doctor-card__photo"><picture><source srcset="assets/img/photo-exam-1.webp" type="image/webp"><img src="assets/img/photo-exam-1.jpg" alt="Placeholder photo for Pediatric Ophthalmologist — replace with real staff photo" width="800" height="533" loading="lazy" decoding="async"></picture></div>
                <div class="doctor-card__body">
                    <h3>Pediatric Ophthalmologist</h3>
                    <span class="doctor-card__role">Squint &amp; Children's Vision</span>
                    <p>Placeholder profile — add name, qualifications and years of experience.</p>
                </div>
            </div>
        </div>

        <p class="doctor-note"><i class="fa-solid fa-circle-info"></i> These are placeholder profiles. Send over your specialists' real names, qualifications, photos and short bios and we'll drop them straight in before launch.</p>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
