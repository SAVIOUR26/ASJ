# ASJ Eye Hospital — Website

Custom PHP website for ASJ Eye Hospital, 14 Kyadondo Road, Kampala. Started as
a Stage 1 design/build pass, since carried through a full Phase 0–3 build —
see **[ROADMAP.md](ROADMAP.md)** for exactly what's shipped versus what's
still blocked on real client input (contact details, doctor bios, photos,
legal sign-off, SMS/analytics credentials).

## Stack

- Plain PHP (includes-based templating, no framework) — matches the rest of
  Thirdsan's custom-PHP client sites.
- Font Awesome 6 (via cdnjs CDN) for iconography.
- Google Fonts: **Fraunces** (display) + **Inter** (body/UI).
- No build step, no Composer/npm dependencies — just PHP (with the `gd`,
  `pdo_sqlite` and `curl` extensions, all standard) + a webserver.

## Structure

```
asj/
├── index.php, about.php, services.php, doctors.php   Core pages
├── contact.php / contact-handler.php                 Enquiry + appointment-request form
├── blog.php / blog-post.php                          Insights section (example posts — see ROADMAP.md)
├── privacy.php, terms.php                             Legal pages (drafted, pending legal sign-off)
├── 404.php, 500.php, maintenance.php                  Error / maintenance pages
├── robots.php, sitemap.php                            Dynamic, served as /robots.txt and /sitemap.xml via .htaccess
├── .htaccess                                           Clean URLs, security headers, error documents
├── includes/
│   ├── config.php      ⚙️ Site-wide settings: contact info, nav, services, SMTP, SMS, GA4 — TODOs marked
│   ├── header.php / footer.php   Shared chrome, SEO/OG/schema.org meta
│   ├── mailer.php       Dependency-free SMTP client (falls back to mail())
│   ├── db.php           SQLite storage for appointment requests
│   ├── ics.php          .ics calendar invite generation
│   ├── notifier.php     SMS via Africa's Talking (inert without credentials)
│   └── lang.php         EN/LG locale switch (see lang/)
├── lang/en.php, lang/lg.php   Translation strings for shared chrome
├── scripts/send-appointment-reminders.php   Cron-ready SMS reminder job (see ROADMAP.md)
├── data/                SQLite database, created at runtime — gitignored
└── assets/
    ├── css/style.css    Full design system (tokens at the top of the file)
    ├── js/main.js       Nav toggle, scroll reveal, FAQ accordion, back-to-top
    └── img/             Logo, favicon set, facility photos + generated .webp versions
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

## Before going live

Full punch list with status and effort estimates lives in
**[ROADMAP.md](ROADMAP.md)**. In short, everything that was pure engineering
work is done and tested; what's left needs real input only ASJ can provide:

1. **`includes/config.php`** — replace the placeholder phone number, WhatsApp
   number, and email address with real ones (search `TODO` in that file),
   plus real SMTP (Mailcow) and, optionally, Africa's Talking/GA4 credentials.
2. **`doctors.php`** — swap the three placeholder specialist cards for real
   names, qualifications, photos and bios.
3. **Map embed** — `contact.php` uses a key-less Google Maps embed. It
   couldn't render inside this sandbox (no outbound access to google.com
   here); worth a live check once deployed, and swap in exact coordinates if
   the address search doesn't pin the right building.
4. **Real facility/service photos** — only 6 unique photos were supplied (2
   were exact duplicates and were skipped). More photos (exterior signage,
   OT/surgical theatre, additional consultation rooms, real staff) would let
   the gallery, doctors page and blog carry more of their own weight.
5. **Legal review** — `privacy.php` and `terms.php` are drafted against
   Uganda's Data Protection and Privacy Act 2019, but need ASJ's own legal
   sign-off before they should be relied on.
6. **Luganda translation** — the EN/LG toggle works, but `lang/lg.php` still
   holds English placeholder text pending a native-speaker review (see the
   comment at the top of that file for why it wasn't guessed at).
7. **Cron for appointment reminders** — `scripts/send-appointment-reminders.php`
   is ready to run daily but isn't scheduled anywhere; add it to the VPS
   crontab once Africa's Talking credentials are in place (see the script's
   header comment for the exact line).

## Local preview

```bash
php -S localhost:8000
```
Then visit `http://localhost:8000/index.php`.

## Deployment

Standard PHP hosting (Apache/Nginx + PHP-FPM). On **Apache**, `.htaccess`
already handles clean URLs (`/services` instead of `/services.php`), security
headers, and the custom error pages — just make sure `AllowOverride All` (or
at least `FileInfo`+`Indexes`) is set for this directory, and that
`mod_rewrite`/`mod_headers` are enabled. On **Nginx**, `.htaccess` has no
effect — the rewrite rules and headers in it need to be translated into the
server block by hand; the file is commented well enough to do that directly
from it.

A few things also need doing once on the real server, outside this repo:

- Enable `pdo_sqlite`, `gd` and `curl` PHP extensions if not already on
  (used by the appointment-booking store, image tooling, and SMS notifier).
- Make sure the `data/` directory (created automatically on first booking) is
  writable by the PHP process and *not* web-accessible.
- Add the cron line from `scripts/send-appointment-reminders.php`'s header
  comment once SMS is configured.
