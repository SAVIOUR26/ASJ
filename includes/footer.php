</main>

<section class="cta-banner">
    <div class="container cta-banner__inner">
        <div class="cta-banner__text">
            <span class="eyebrow eyebrow--light">Not sure where to start?</span>
            <h2>Talk to our team before you book.</h2>
            <p>Call us or send a message — we’ll point you to the right specialist for your eyes.</p>
        </div>
        <div class="cta-banner__actions">
            <a href="tel:<?= htmlspecialchars($site['phone_href']) ?>" class="btn btn--light">
                <i class="fa-solid fa-phone" aria-hidden="true"></i> <?= htmlspecialchars($site['phone']) ?>
            </a>
            <a href="contact.php#book" class="btn btn--outline-light">
                <i class="fa-regular fa-calendar-check" aria-hidden="true"></i> Book Appointment
            </a>
        </div>
    </div>
</section>

<footer class="site-footer">
    <div class="container site-footer__grid">
        <div class="footer-col footer-col--brand">
            <a href="index.php" class="brand brand--footer">
                <img src="assets/img/logo.jpg" alt="<?= htmlspecialchars($site['name']) ?> logo" class="brand__logo">
                <span class="brand__text">
                    <span class="brand__name">ASJ <em>Eye Hospital</em></span>
                </span>
            </a>
            <p>Comprehensive, specialist eye care in the heart of Kampala — from routine checkups to advanced surgical treatment.</p>
            <div class="social-links">
                <a href="<?= htmlspecialchars($site['social']['facebook']) ?>" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="<?= htmlspecialchars($site['social']['instagram']) ?>" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="<?= htmlspecialchars($site['social']['twitter']) ?>" aria-label="X (Twitter)"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="<?= htmlspecialchars($site['social']['youtube']) ?>" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>

        <div class="footer-col">
            <h3>Explore</h3>
            <ul>
                <?php foreach ($nav as $item): ?>
                <li><a href="<?= htmlspecialchars($item['href']) ?>"><?= htmlspecialchars($item['label']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="footer-col">
            <h3>Specialities</h3>
            <ul>
                <?php foreach (array_slice($services, 0, 5) as $s): ?>
                <li><a href="services.php#<?= htmlspecialchars($s['slug']) ?>"><?= htmlspecialchars($s['name']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="footer-col">
            <h3>Visit Us</h3>
            <ul class="footer-contact">
                <li><i class="fa-solid fa-location-dot" aria-hidden="true"></i> <?= htmlspecialchars($site['address']) ?></li>
                <li><i class="fa-solid fa-phone" aria-hidden="true"></i> <a href="tel:<?= htmlspecialchars($site['phone_href']) ?>"><?= htmlspecialchars($site['phone']) ?></a></li>
                <li><i class="fa-regular fa-envelope" aria-hidden="true"></i> <a href="mailto:<?= htmlspecialchars($site['email']) ?>"><?= htmlspecialchars($site['email']) ?></a></li>
                <li><i class="fa-regular fa-clock" aria-hidden="true"></i> <?= htmlspecialchars($site['hours']) ?></li>
            </ul>
        </div>
    </div>

    <div class="container site-footer__bottom">
        <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($site['name']) ?>. All rights reserved.</p>
        <p class="site-footer__legal"><a href="privacy.php">Privacy Policy</a> · <a href="terms.php">Terms of Use</a></p>
        <p class="site-footer__credit">Kampala, Uganda</p>
    </div>
</footer>

<button class="back-to-top" id="back-to-top" aria-label="Back to top">
    <i class="fa-solid fa-arrow-up" aria-hidden="true"></i>
</button>

<script src="assets/js/main.js"></script>
</body>
</html>
