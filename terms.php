<?php
$page_title = 'Terms of Use';
$page_desc  = 'Terms of use for the ASJ Eye Hospital website.';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header">
    <div class="container">
        <div class="breadcrumb"><a href="index.php">Home</a> <i class="fa-solid fa-chevron-right" style="font-size:0.6rem;"></i> <span>Terms of Use</span></div>
        <span class="eyebrow">Legal</span>
        <h1>Terms of Use</h1>
        <p>The terms that apply to using this website — separate from the clinical terms of any in-person treatment.</p>
    </div>
</section>

<section class="section">
    <div class="container" style="max-width: 820px;">

        <p class="doctor-note"><i class="fa-solid fa-circle-info"></i> Draft terms covering this website only. Clinical consent, treatment terms and billing policies are handled separately in person at the hospital and are outside the scope of this page — have legal counsel confirm both align before launch.</p>

        <p><strong>Last updated:</strong> <?= date('j F Y') ?></p>

        <h2 style="margin-top: 40px;">1. Purpose of this website</h2>
        <p>This website provides general information about ASJ Eye Hospital's services and lets visitors send an enquiry or request an appointment. It is not a substitute for an in-person clinical consultation, and nothing on it should be treated as personal medical advice or a diagnosis.</p>

        <h2 style="margin-top: 40px;">2. Medical disclaimer</h2>
        <p>If you have an urgent eye concern, please call us directly or seek immediate medical attention rather than relying on this website or its contact form, which is handled during business hours.</p>

        <h2 style="margin-top: 40px;">3. Using the contact form</h2>
        <p>You agree to submit accurate contact details and not to use the form to send unlawful, abusive or unsolicited commercial content. We reserve the right to disregard submissions that appear to be spam or automated.</p>

        <h2 style="margin-top: 40px;">4. Appointment requests</h2>
        <p>Submitting the form is a request, not a confirmed booking — a member of our team will contact you to confirm a time. Please arrive with any relevant history (glasses, current prescriptions, prior eye reports) as noted on the <a href="contact.php">Contact page</a>.</p>

        <h2 style="margin-top: 40px;">5. Content &amp; intellectual property</h2>
        <p>The text, photography, logo and design of this website belong to ASJ Eye Hospital unless otherwise credited, and may not be reproduced without permission.</p>

        <h2 style="margin-top: 40px;">6. Third-party links</h2>
        <p>Where this site links out (e.g. a map or social media profile), we aren't responsible for the content or privacy practices of that external site.</p>

        <h2 style="margin-top: 40px;">7. Changes</h2>
        <p>We may update these terms as the website changes. The "last updated" date at the top of this page reflects the most recent revision.</p>

        <h2 style="margin-top: 40px;">8. Contact</h2>
        <p>Questions about these terms can be sent to <a href="mailto:<?= htmlspecialchars($site['email']) ?>"><?= htmlspecialchars($site['email']) ?></a>.</p>

    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
