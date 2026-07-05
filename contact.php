<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$page_title = 'Contact & Book an Appointment';
$page_desc  = 'Get in touch with ASJ Eye Hospital in Kampala or book an appointment with one of our eye specialists.';
require_once __DIR__ . '/includes/header.php';

$status = isset($_GET['status']) ? $_GET['status'] : null;
?>

<section class="page-header">
    <div class="container">
        <div class="breadcrumb"><a href="index.php">Home</a> <i class="fa-solid fa-chevron-right" style="font-size:0.6rem;"></i> <span>Contact</span></div>
        <span class="eyebrow">Get In Touch</span>
        <h1>Book an appointment or ask us a question.</h1>
        <p>Reach us by phone, WhatsApp or the form below — our team responds during opening hours.</p>
    </div>
</section>

<section class="section" id="book">
    <div class="container contact-grid">

        <div class="contact-info-card">
            <div class="contact-info-item">
                <i class="fa-solid fa-location-dot"></i>
                <div>
                    <h3>Visit Us</h3>
                    <p><?= htmlspecialchars($site['address']) ?></p>
                </div>
            </div>
            <div class="contact-info-item">
                <i class="fa-solid fa-phone"></i>
                <div>
                    <h3>Call Us</h3>
                    <p><a href="tel:<?= htmlspecialchars($site['phone_href']) ?>"><?= htmlspecialchars($site['phone']) ?></a></p>
                </div>
            </div>
            <div class="contact-info-item">
                <i class="fa-brands fa-whatsapp"></i>
                <div>
                    <h3>WhatsApp</h3>
                    <p><a href="https://wa.me/<?= htmlspecialchars($site['whatsapp']) ?>" target="_blank" rel="noopener">Message us directly</a></p>
                </div>
            </div>
            <div class="contact-info-item">
                <i class="fa-regular fa-envelope"></i>
                <div>
                    <h3>Email</h3>
                    <p><a href="mailto:<?= htmlspecialchars($site['email']) ?>"><?= htmlspecialchars($site['email']) ?></a></p>
                </div>
            </div>
            <div class="contact-info-item">
                <i class="fa-regular fa-clock"></i>
                <div>
                    <h3>Opening Hours</h3>
                    <p><?= htmlspecialchars($site['hours']) ?></p>
                </div>
            </div>
            <div class="contact-info-item">
                <i class="fa-solid fa-truck-medical"></i>
                <div>
                    <h3>Urgent Concern?</h3>
                    <p><?= htmlspecialchars($site['emergency']) ?> — call us directly.</p>
                </div>
            </div>
        </div>

        <div class="form-card">
            <h2 style="margin-bottom: 8px;">Send us a message</h2>
            <p style="margin-bottom: 24px;">Tell us what you need and we'll get back to you to confirm a time.</p>

            <?php if ($status === 'success'): ?>
                <div class="form-alert form-alert--success"><i class="fa-solid fa-circle-check"></i> Thank you — your request has been sent. We'll be in touch shortly.</div>
            <?php elseif ($status === 'error'): ?>
                <div class="form-alert form-alert--error"><i class="fa-solid fa-triangle-exclamation"></i> Something went wrong sending your message. Please try again or call us directly.</div>
            <?php elseif ($status === 'invalid'): ?>
                <div class="form-alert form-alert--error"><i class="fa-solid fa-triangle-exclamation"></i> Please fill in all required fields with valid details.</div>
            <?php endif; ?>

            <form action="contact-handler.php" method="POST" class="form-grid">
                <div class="field">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="field">
                    <label for="phone">Phone Number *</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="field">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email">
                </div>
                <div class="field">
                    <label for="service">Service Needed</label>
                    <select id="service" name="service">
                        <option value="">Select a service (optional)</option>
                        <?php foreach ($services as $s): ?>
                        <option value="<?= htmlspecialchars($s['name']) ?>"><?= htmlspecialchars($s['name']) ?></option>
                        <?php endforeach; ?>
                        <option value="Not sure">Not sure — general enquiry</option>
                    </select>
                </div>
                <div class="field full">
                    <label for="message">Message *</label>
                    <textarea id="message" name="message" required placeholder="Tell us about your concern or preferred appointment time..."></textarea>
                </div>

                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

                <!-- Honeypot spam trap — kept hidden from real visitors -->
                <div class="field full" style="position:absolute; left:-9999px;" aria-hidden="true">
                    <label for="website">Leave this field empty</label>
                    <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                </div>

                <div class="field full">
                    <button type="submit" class="btn btn--primary btn--block">
                        <i class="fa-regular fa-paper-plane"></i> Send Message
                    </button>
                    <p class="form-note">We typically reply within one business day. For urgent concerns, please call us directly.</p>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="map-wrap">
            <iframe
                src="https://www.google.com/maps?q=<?= urlencode($site['address']) ?>&output=embed"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Map to ASJ Eye Hospital, 14 Kyadondo Road, Kampala">
            </iframe>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
