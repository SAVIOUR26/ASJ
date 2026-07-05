# ASJ Eye Hospital — Website (Stage 1)

Custom PHP website for ASJ Eye Hospital, 14 Kyadondo Road, Kampala. Built as the
first design/build pass — ready to push to GitHub and hand off to Claude Code
for remaining adjustments, real content, and deployment.

## Stack

- Plain PHP (includes-based templating, no framework) — matches the rest of
  Thirdsan's custom-PHP client sites.
- Font Awesome 6 (via cdnjs CDN) for iconography.
- Google Fonts: **Fraunces** (display) + **Inter** (body/UI).
- No build step, no dependencies to install — just PHP + a webserver.

## Structure

```
asj/
├── index.php              Homepage
├── about.php               Our story, approach, values
├── services.php             Full specialities list
├── doctors.php              Team page (placeholder profiles — see below)
├── contact.php              Contact info + appointment form + map
├── contact-handler.php     Server-side form handler (mail())
├── 404.php                 Not-found page
├── includes/
│   ├── config.php          ⚙️ Site-wide settings: phone, email, address, nav, services list
│   ├── header.php          <head>, topbar, nav
│   └── footer.php          CTA banner, footer, back-to-top
└── assets/
    ├── css/style.css       Full design system (tokens at the top of the file)
    ├── js/main.js          Nav toggle, scroll reveal, FAQ accordion, back-to-top
    └── img/                Logo, favicon set, and the 6 supplied facility photos
```

## Design notes

- **Palette** pulled directly from the ASJ logo: deep navy `#0b2343`, primary
  blue `#0f5987`, sky blue `#3a99ca` / `#5db4d0`, pale mist `#eef5f6`, plus one
  warm gold accent `#e3a23c` used sparingly for the primary CTA and focus-ring
  details — keeps the clinical blue from feeling cold.
- **Signature motif**: an "aperture / focus ring" — a thin circular ring that
  draws itself around the hero photo on load, and reappears as a hover ring
  around service icons. It's a literal nod to optics ("bringing things into
  focus") rather than decorative flourish.
- All copy avoids inventing facts (patient numbers, named doctors, fabricated
  testimonials) — anywhere real content is still needed, it's marked clearly
  (see TODOs below) rather than filled with placeholder claims that could
  mislead a visitor.

## Before going live — TODO for the client / Claude Code

1. **`includes/config.php`** — replace the placeholder phone number, WhatsApp
   number, and email address with real ones (search `TODO` in that file).
2. **`doctors.php`** — swap the three placeholder specialist cards for real
   names, qualifications, photos and bios.
3. **Contact form email** — `contact-handler.php` uses PHP's `mail()`. On most
   shared hosting this works out of the box; on the Contabo VPS you'll likely
   want to wire it to Mailcow via SMTP (e.g. PHPMailer) instead of relying on
   `mail()`, since VPS mail() delivery is unreliable without a configured MTA.
4. **Map embed** — `contact.php` uses a key-less Google Maps embed
   (`google.com/maps?q=...&output=embed`). It couldn't render inside this
   sandbox (no outbound access to google.com here), but it will work as soon
   as it's on a real server with internet access. Worth a live check after
   deploy, and swap in exact map coordinates if the address search doesn't
   pin the right building.
5. **Real facility/service photos** — only 6 unique photos were supplied (2
   were exact duplicates and were skipped). More photos (exterior signage,
   OT/surgical theatre, additional consultation rooms, real staff) would let
   the gallery and doctors page carry more of their own weight.
6. **Legal/compliance copy** — no privacy policy or terms page included yet;
   add if required for the region.
7. **Analytics / SEO** — no tracking pixel or sitemap included; add per the
   client's preference.

## Local preview

```bash
php -S localhost:8000
```
Then visit `http://localhost:8000/index.php`.

## Deployment

Standard PHP hosting (Apache/Nginx + PHP-FPM) — no `.htaccess` rewrite rules
are required since every page is addressed by its real `.php` filename. If
clean URLs are wanted later (e.g. `/services` instead of `/services.php`),
that's a small addition once this is on the VPS.
