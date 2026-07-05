<?php
$page_title = 'About Us';
$page_desc  = 'Learn about ASJ Eye Hospital in Kampala — our story, our approach to eye care, and the values behind every consultation.';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header">
    <div class="container">
        <div class="breadcrumb"><a href="/">Home</a> <i class="fa-solid fa-chevron-right" style="font-size:0.6rem;"></i> <span>About Us</span></div>
        <span class="eyebrow">About ASJ Eye Hospital</span>
        <h1>Dedicated to one thing: your eyesight.</h1>
        <p>A specialist eye hospital on Kyadondo Road, Kampala — built for accurate diagnosis, considered treatment, and care that doesn't rush you through the door.</p>
    </div>
</section>

<section class="section">
    <div class="container split">
        <div class="split__media">
            <span class="split__photo-accent split__photo-accent--tl" aria-hidden="true"></span>
            <div class="split__photo">
                <picture><source srcset="assets/img/photo-facility-1.webp" type="image/webp"><img src="assets/img/photo-facility-1.jpg" alt="ASJ Eye Hospital reception and facility" width="800" height="533" loading="lazy" decoding="async"></picture>
            </div>
            <span class="split__photo-accent split__photo-accent--br" aria-hidden="true"></span>
        </div>
        <div class="split__body">
            <span class="eyebrow">Our Story</span>
            <h2>A new name, the same specialist standard.</h2>
            <p>ASJ Eye Hospital operates from 14 Kyadondo Road, Kampala, as a dedicated ophthalmology facility. Following a change in ownership, the hospital has been rebranded from its earlier identity to ASJ Eye Hospital — while carrying forward the same commitment to specialised, technology-supported eye care that the site was built on.</p>
            <p>Today, under local ownership, ASJ continues to serve Kampala and the wider region with a focus purely on eyes: diagnosis, medical treatment, and surgery, delivered by a team that works in ophthalmology and nothing else.</p>
        </div>
    </div>
</section>

<section class="section section--mist">
    <div class="container split split--reverse">
        <div class="split__body">
            <span class="eyebrow">Our Approach</span>
            <h2>How we think about your care.</h2>
            <p>Every eye tells a slightly different story — genetics, age, lifestyle and existing conditions all shape what "good vision" looks like for you. We start every relationship with a full diagnostic picture before recommending any treatment path.</p>
            <ul class="check-list">
                <li><i class="fa-solid fa-circle-check"></i> Full diagnostic work-up before any treatment decision</li>
                <li><i class="fa-solid fa-circle-check"></i> Treatment options explained in plain language</li>
                <li><i class="fa-solid fa-circle-check"></i> Follow-up care built into every surgical plan</li>
                <li><i class="fa-solid fa-circle-check"></i> Separate, gentler protocols for pediatric patients</li>
            </ul>
        </div>
        <div class="split__media">
            <span class="split__photo-accent split__photo-accent--tl" aria-hidden="true"></span>
            <div class="split__photo">
                <picture><source srcset="assets/img/photo-exam-1.webp" type="image/webp"><img src="assets/img/photo-exam-1.jpg" alt="Detailed eye diagnostic exam at ASJ Eye Hospital" width="800" height="533" loading="lazy" decoding="async"></picture>
            </div>
            <span class="split__photo-accent split__photo-accent--br" aria-hidden="true"></span>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head center">
            <span class="eyebrow">What We Stand For</span>
            <h2>The values behind every appointment.</h2>
        </div>
        <div class="value-grid">
            <div class="value-card reveal">
                <div class="value-card__icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                <h3>Precision</h3>
                <p>Accurate diagnosis before any recommendation — no guesswork, no shortcuts.</p>
            </div>
            <div class="value-card reveal">
                <div class="value-card__icon"><i class="fa-solid fa-heart-pulse"></i></div>
                <h3>Compassion</h3>
                <p>Eye problems can be frightening. We take the time to explain, reassure, and guide.</p>
            </div>
            <div class="value-card reveal">
                <div class="value-card__icon"><i class="fa-solid fa-shield-heart"></i></div>
                <h3>Integrity</h3>
                <p>We recommend what your eyes need — never more, never less.</p>
            </div>
            <div class="value-card reveal">
                <div class="value-card__icon"><i class="fa-solid fa-arrows-rotate"></i></div>
                <h3>Continuity</h3>
                <p>Your care doesn't end at surgery — we follow up until you're fully recovered.</p>
            </div>
        </div>
    </div>
</section>

<section class="section section--mist">
    <div class="container">
        <div class="section-head center">
            <span class="eyebrow">Inside ASJ</span>
            <h2>Our facility &amp; team.</h2>
        </div>
        <div class="gallery-grid">
            <figure class="reveal"><picture><source srcset="assets/img/photo-facility-2.webp" type="image/webp"><img src="assets/img/photo-facility-2.jpg" alt="ASJ Eye Hospital equipment" width="800" height="533" loading="lazy" decoding="async"></picture><figcaption>Diagnostic Equipment</figcaption></figure>
            <figure class="reveal"><picture><source srcset="assets/img/photo-team.webp" type="image/webp"><img src="assets/img/photo-team.jpg" alt="ASJ Eye Hospital care team" width="800" height="533" loading="lazy" decoding="async"></picture><figcaption>Our Care Team</figcaption></figure>
            <figure class="reveal"><picture><source srcset="assets/img/photo-exam-2.webp" type="image/webp"><img src="assets/img/photo-exam-2.jpg" alt="Consultation in progress" width="800" height="533" loading="lazy" decoding="async"></picture><figcaption>Consultation Room</figcaption></figure>
            <figure class="reveal"><picture><source srcset="assets/img/photo-eye-macro.webp" type="image/webp"><img src="assets/img/photo-eye-macro.jpg" alt="Close-up of a human eye" width="800" height="533" loading="lazy" decoding="async"></picture><figcaption>Focused on Vision</figcaption></figure>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
