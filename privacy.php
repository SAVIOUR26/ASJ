<?php
$page_title = 'Privacy Policy';
$page_desc  = 'How ASJ Eye Hospital collects, uses and protects the personal data of patients and website visitors.';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header">
    <div class="container">
        <div class="breadcrumb"><a href="index.php">Home</a> <i class="fa-solid fa-chevron-right" style="font-size:0.6rem;"></i> <span>Privacy Policy</span></div>
        <span class="eyebrow">Legal</span>
        <h1>Privacy Policy</h1>
        <p>How we collect, use and protect your personal data when you visit this website or get in touch with us.</p>
    </div>
</section>

<section class="section">
    <div class="container" style="max-width: 820px;">

        <p class="doctor-note"><i class="fa-solid fa-circle-info"></i> Draft policy — reflects what the website itself actually collects (the contact form, and analytics if enabled). It should be reviewed by ASJ Eye Hospital's own legal counsel, and extended to cover in-clinic patient records and any other systems outside this website, before publishing.</p>

        <p><strong>Last updated:</strong> <?= date('j F Y') ?></p>

        <p>ASJ Eye Hospital ("ASJ", "we", "us") operates this website. This policy explains what personal data the website collects, why, and the rights you have over it under Uganda's <strong>Data Protection and Privacy Act, 2019</strong> and its 2021 Regulations.</p>

        <h2 style="margin-top: 40px;">1. What we collect</h2>
        <p>Through the contact and appointment-request form, we collect the information you choose to submit: your name, phone number, email address (optional), the service you're enquiring about, and your message. We do not require you to create an account or submit payment details through this website.</p>
        <p>If analytics is enabled on the site (see <code>includes/config.php</code>), we also collect standard, aggregated visit data — pages viewed, approximate location, device/browser type — through Google Analytics or a similar provider.</p>

        <h2 style="margin-top: 40px;">2. How we use it</h2>
        <ul class="check-list">
            <li><i class="fa-solid fa-circle-check"></i> To respond to your enquiry and, where relevant, arrange an appointment</li>
            <li><i class="fa-solid fa-circle-check"></i> To contact you by phone, email or WhatsApp about that enquiry</li>
            <li><i class="fa-solid fa-circle-check"></i> To understand how visitors use the site, so we can improve it</li>
        </ul>
        <p>We do not sell or rent your personal data, and we do not use it for advertising profiling.</p>

        <h2 style="margin-top: 40px;">3. Who we share it with</h2>
        <p>Enquiry details are sent to ASJ Eye Hospital's own staff mailbox to action your request. We use a mail/SMTP provider and, if enabled, an analytics provider (e.g. Google) purely as processors acting on our instructions — they don't use your data for their own purposes.</p>

        <h2 style="margin-top: 40px;">4. How long we keep it</h2>
        <p>Enquiry messages are kept only as long as needed to handle your request and any reasonable follow-up, then deleted. Medical records created during an in-clinic visit are retained separately, under ASJ's clinical record-keeping policy, not this website.</p>

        <h2 style="margin-top: 40px;">5. Your rights</h2>
        <p>Under the Data Protection and Privacy Act, 2019, you have the right to:</p>
        <ul class="check-list">
            <li><i class="fa-solid fa-circle-check"></i> Ask what personal data we hold about you, and get a copy of it</li>
            <li><i class="fa-solid fa-circle-check"></i> Ask us to correct inaccurate data</li>
            <li><i class="fa-solid fa-circle-check"></i> Ask us to delete data we no longer have a lawful reason to keep</li>
            <li><i class="fa-solid fa-circle-check"></i> Object to how your data is being used, and withdraw consent at any time</li>
            <li><i class="fa-solid fa-circle-check"></i> Lodge a complaint with Uganda's National Personal Data Protection Office (NPDPO) if you believe we've mishandled your data</li>
        </ul>
        <p>To exercise any of these, contact us using the details below.</p>

        <h2 style="margin-top: 40px;">6. Security</h2>
        <p>The contact form is protected against cross-site request forgery and automated spam submission, and enquiry emails are sent over an encrypted connection where our mail provider supports it. No online system is completely risk-free, and we continue to review these protections as the site evolves.</p>

        <h2 style="margin-top: 40px;">7. Contact</h2>
        <p>Questions about this policy, or a request relating to your data, can be sent to <a href="mailto:<?= htmlspecialchars($site['email']) ?>"><?= htmlspecialchars($site['email']) ?></a> or by post to <?= htmlspecialchars($site['address']) ?>.</p>

    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
