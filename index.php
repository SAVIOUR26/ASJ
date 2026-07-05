<?php
$page_title = 'Home';
$page_desc  = 'ASJ Eye Hospital in Kampala — comprehensive, specialist eye care from cataract surgery and LASIK to glaucoma, retina and pediatric ophthalmology.';
require_once __DIR__ . '/includes/header.php';
?>

<!-- HERO -->
<section class="hero">
    <div class="container hero__inner">
        <div class="hero__copy">
            <div class="hero__eyebrow-row">
                <span class="eyebrow">Specialist Eye Hospital · Kampala</span>
            </div>
            <h1>Clear vision, <span class="accent">brought into focus</span> — for every stage of life.</h1>
            <p class="hero__lede">ASJ Eye Hospital brings specialist ophthalmology to Kyadondo Road — modern diagnostic technology, experienced eye specialists, and a treatment plan built around your eyes, not a general checklist.</p>
            <div class="hero__actions">
                <a href="contact.php#book" class="btn btn--primary"><i class="fa-regular fa-calendar-check"></i> Book an Appointment</a>
                <a href="services.php" class="btn btn--outline"><i class="fa-solid fa-eye"></i> Explore Services</a>
            </div>
            <div class="hero__trust">
                <div class="hero__trust-item"><i class="fa-solid fa-user-doctor"></i> Experienced Specialists</div>
                <div class="hero__trust-item"><i class="fa-solid fa-microscope"></i> Modern Diagnostics</div>
                <div class="hero__trust-item"><i class="fa-solid fa-hospital"></i> Surgical &amp; Outpatient Care</div>
            </div>
        </div>
        <div class="hero__art">
            <div class="aperture">
                <svg class="aperture__ring" viewBox="0 0 240 240" aria-hidden="true">
                    <circle class="ring--sky" cx="120" cy="120" r="100"></circle>
                    <circle cx="120" cy="120" r="110"></circle>
                </svg>
                <div class="aperture__photo">
                    <img src="assets/img/photo-eye-macro.jpg" alt="Close-up of a human eye, representing the clarity ASJ Eye Hospital aims for in every treatment">
                </div>
                <div class="aperture__badge">
                    <i class="fa-solid fa-circle-check"></i>
                    <span><strong>Precision Diagnostics</strong>Every treatment starts with a clear picture of your eyes.</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WHY CHOOSE -->
<section class="section">
    <div class="container">
        <div class="section-head center">
            <span class="eyebrow">Why ASJ</span>
            <h2>Eye care built around clarity, comfort and follow-through.</h2>
            <p>From your first consultation to post-treatment review, our approach stays the same: understand your eyes fully, explain what we find plainly, and treat with precision.</p>
        </div>
        <div class="value-grid">
            <div class="value-card reveal">
                <div class="value-card__icon"><i class="fa-solid fa-hospital-user"></i></div>
                <h3>Complete Care, One Roof</h3>
                <p>Consultation, diagnostics and treatment happen at the same facility — less waiting, faster answers.</p>
            </div>
            <div class="value-card reveal">
                <div class="value-card__icon"><i class="fa-solid fa-radar"></i></div>
                <h3>Early, Accurate Detection</h3>
                <p>Modern imaging picks up conditions like glaucoma and retinal disease before they affect your sight.</p>
            </div>
            <div class="value-card reveal">
                <div class="value-card__icon"><i class="fa-solid fa-hands-holding-circle"></i></div>
                <h3>Personalized Treatment</h3>
                <p>Your lifestyle and vision goals shape the plan — not a one-size-fits-all protocol.</p>
            </div>
            <div class="value-card reveal">
                <div class="value-card__icon"><i class="fa-solid fa-comments"></i></div>
                <h3>Care You Can Follow</h3>
                <p>Clear explanations at every step, in the language you're comfortable with, so you know what's next.</p>
            </div>
        </div>
    </div>
</section>

<!-- SERVICES -->
<section class="section section--mist">
    <div class="container">
        <div class="section-head center">
            <span class="eyebrow">Our Specialities</span>
            <h2>Every angle of eye care, under specialist attention.</h2>
            <p>From routine exams to advanced surgical treatment — explore the areas our team focuses on most.</p>
        </div>
        <div class="services-grid">
            <?php foreach (array_filter($services, fn($s) => $s['featured']) as $s): ?>
            <div class="service-card reveal" id="<?= htmlspecialchars($s['slug']) ?>">
                <div class="service-card__icon"><i class="fa-solid <?= htmlspecialchars($s['icon']) ?>"></i></div>
                <h3><?= htmlspecialchars($s['name']) ?></h3>
                <p><?= htmlspecialchars($s['short']) ?></p>
                <a href="services.php#<?= htmlspecialchars($s['slug']) ?>" class="service-card__link">Learn more <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-lg">
            <a href="services.php" class="btn btn--outline">View All Services <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
</section>

<!-- ABOUT TEASER -->
<section class="section">
    <div class="container split">
        <div class="split__media">
            <span class="split__photo-accent split__photo-accent--tl" aria-hidden="true"></span>
            <div class="split__photo">
                <img src="assets/img/photo-exam-2.jpg" alt="Eye specialist examining a patient at ASJ Eye Hospital">
            </div>
            <span class="split__photo-accent split__photo-accent--br" aria-hidden="true"></span>
        </div>
        <div class="split__body">
            <span class="eyebrow">Our Story</span>
            <h2>Specialist eye care, rooted in Kampala.</h2>
            <p>ASJ Eye Hospital continues a long-standing tradition of dedicated, specialist ophthalmology at 14 Kyadondo Road — now under new local ownership and a renewed name, with the same focus on clinical precision and patient comfort.</p>
            <p>We treat one thing: eyes. That focus means every consultation, every piece of equipment and every specialist on our team is here for exactly one purpose — helping you see clearly.</p>
            <ul class="check-list">
                <li><i class="fa-solid fa-circle-check"></i> Dedicated, ophthalmology-only facility</li>
                <li><i class="fa-solid fa-circle-check"></i> Modern diagnostic &amp; surgical equipment</li>
                <li><i class="fa-solid fa-circle-check"></i> Care for children, adults and seniors</li>
            </ul>
            <div class="hero__actions" style="margin-top:30px;">
                <a href="about.php" class="btn btn--primary">Read Our Story</a>
            </div>
        </div>
    </div>
</section>

<!-- GALLERY -->
<section class="section section--mist">
    <div class="container">
        <div class="section-head center">
            <span class="eyebrow">Inside ASJ</span>
            <h2>A closer look at our facility.</h2>
        </div>
        <div class="gallery-grid">
            <figure class="reveal"><img src="assets/img/photo-exam-1.jpg" alt="Diagnostic eye examination in progress"><figcaption>Diagnostic Examination</figcaption></figure>
            <figure class="reveal"><img src="assets/img/photo-facility-1.jpg" alt="ASJ Eye Hospital facility interior"><figcaption>Our Facility</figcaption></figure>
            <figure class="reveal"><img src="assets/img/photo-facility-2.jpg" alt="Eye care equipment at ASJ Eye Hospital"><figcaption>Modern Equipment</figcaption></figure>
            <figure class="reveal"><img src="assets/img/photo-team.jpg" alt="ASJ Eye Hospital care team"><figcaption>Our Care Team</figcaption></figure>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="section">
    <div class="container">
        <div class="section-head center">
            <span class="eyebrow">Common Questions</span>
            <h2>Good to know before your visit.</h2>
        </div>
        <div class="faq">
            <div class="faq-item">
                <button class="faq-question">Do I need an appointment, or can I walk in? <i class="fa-solid fa-plus"></i></button>
                <div class="faq-answer"><p>We recommend booking ahead so we can match you with the right specialist, though urgent eye concerns are seen as quickly as possible — call us directly for same-day guidance.</p></div>
            </div>
            <div class="faq-item">
                <button class="faq-question">What should I bring to my first visit? <i class="fa-solid fa-plus"></i></button>
                <div class="faq-answer"><p>Bring any glasses or contact lenses you currently use, a list of medications, and any previous eye reports or prescriptions if available.</p></div>
            </div>
            <div class="faq-item">
                <button class="faq-question">Do you treat children's eye conditions? <i class="fa-solid fa-plus"></i></button>
                <div class="faq-answer"><p>Yes — our pediatric ophthalmology service covers vision screening, squint (crossed eyes) correction and lazy-eye therapy for children.</p></div>
            </div>
            <div class="faq-item">
                <button class="faq-question">Is payment by insurance accepted? <i class="fa-solid fa-plus"></i></button>
                <div class="faq-answer"><p>Please contact our front desk with your insurance provider's details so we can confirm coverage before your visit.</p></div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
