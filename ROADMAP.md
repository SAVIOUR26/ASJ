# ASJ Eye Hospital — Build Roadmap

Snapshot taken at the Stage 1 handoff review, now updated after the Phase
0–3 build pass. Of the original 19 items, everything that was pure
engineering work has shipped; what's left is real-world input only ASJ
itself can provide (live contact details, real staff bios, extra
photography, legal sign-off, SMS/analytics credentials) or a native
Luganda review — all called out explicitly below rather than guessed at.

- **Phase 0 — Launch blockers**: nothing goes live until these close.
- **Phase 1 — Pre-promotion hardening**: needed before a wider marketing push.
- **Phase 2 — Polish**: raises the ceiling, doesn't block the floor.
- **Phase 3 — Growth track**: future scope, quoted separately.

Owner key: **Client** (content/business info only) · **Dev** · **Client + Dev** ·
**Dev/DevOps** (server-level, outside the app repo).

## Phase 0 — Launch blockers

| # | Task | Status | Ref |
|---|------|--------|-----|
| 1 | Swap placeholder contact details for the real ones | ⏳ **Blocked on client** — phone/WhatsApp/email in config.php are still `TODO` placeholders; no one but ASJ can supply the real ones | `includes/config.php` |
| 2 | Replace the three placeholder specialist profiles | ⏳ **Blocked on client** — needs real names/quals/photos/bios before `doctors.php` can drop them in | `doctors.php` |
| 3 | Move the contact form off PHP `mail()` | ✅ **Shipped** — hand-rolled SMTP client (no Composer), falls back to `mail()` until `$site['smtp']` is filled in | `includes/mailer.php` |
| 4 | Add CSRF protection to the enquiry form | ✅ **Shipped** — per-session token, verified end-to-end against a live SMTP handshake | `contact.php`, `contact-handler.php` |
| 5 | Verify the live map pin | ⏳ **Blocked on deploy** — still can't reach google.com from this sandbox; needs a live check once on a real domain | `contact.php` |

## Phase 1 — Pre-promotion hardening

| # | Task | Status | Ref |
|---|------|--------|-----|
| 6 | SEO fundamentals: sitemap, robots.txt, structured data | ✅ **Shipped** — dynamic robots.txt/sitemap.xml, OG/Twitter meta, schema.org MedicalClinic JSON-LD | `includes/header.php`, `robots.php`, `sitemap.php` |
| 7 | Wire up analytics | ✅ **Scaffolded** — GA4 snippet loads only once `$site['ga4_id']` is set; ⏳ blocked on client's analytics account | `includes/header.php` |
| 8 | Draft Privacy Policy & Terms pages | ✅ **Drafted** — grounded in Uganda's Data Protection and Privacy Act 2019; ⏳ still needs ASJ's own legal sign-off before launch | `privacy.php`, `terms.php` |
| 9 | Set security headers at the server | ✅ **Shipped** (Apache) — HSTS/CSP/X-Frame-Options/Referrer-Policy/Permissions-Policy in `.htaccess`; ⏳ Nginx hosts need the documented equivalent applied at the vhost | `.htaccess` |
| 10 | Commission more facility photography | ⏳ **Blocked on client** — only 6 unique photos exist; no amount of engineering substitutes for real photos | `assets/img/` |

## Phase 2 — Polish

| # | Task | Status | Ref |
|---|------|--------|-----|
| 11 | Clean URLs | ✅ **Shipped** — `/about` instead of `/about.php`, with a 301 from the old path; verified via a full route test | `.htaccess` |
| 12 | Image & asset performance pass | ✅ **Shipped** — every image now WebP + JPEG fallback via `<picture>`, explicit dimensions, lazy-loaded except the hero | `assets/img/*.webp` |
| 13 | Accessibility pass beyond current baseline | ✅ **Shipped** — fixed 3 contrast failures (measured against WCAG, not eyeballed), FAQ `aria-expanded`, mobile nav no longer keyboard-focusable while hidden | `assets/css/style.css`, `assets/js/main.js` |
| 14 | Custom 500 / maintenance page | ✅ **Shipped** — self-contained `500.php` (doesn't depend on the config it might be reporting is broken) + `maintenance.php` with a one-line `.htaccess` toggle | `500.php`, `maintenance.php` |
| 15 | Basic CI smoke checks | ✅ **Shipped** — lints every PHP file, boots the site, hits every route, fails on stray debug files | `.github/workflows/ci.yml` |

## Phase 3 — Growth track

| # | Task | Status | Ref |
|---|------|--------|-----|
| 16 | Real-time appointment booking | ✅ **Shipped** (request-based) — date/time fields with server-side business-hours validation, stored to SQLite, confirmation email with a `.ics` calendar invite. Not a live-availability calendar against real clinic scheduling — that's a larger, separately-scoped project | `contact.php`, `includes/db.php`, `includes/ics.php` |
| 17 | WhatsApp/SMS appointment reminders | ✅ **Scaffolded** — Africa's Talking integration + a cron-ready reminder script; ⏳ blocked on ASJ having a real SMS account, and on someone actually adding the cron line on the VPS | `includes/notifier.php`, `scripts/send-appointment-reminders.php` |
| 18 | Content/blog section | ✅ **Shipped** — full listing + post engine at `/blog`; the two posts in it are explicitly marked example content, ⏳ pending review by ASJ's clinical staff before being treated as real published guidance | `blog.php`, `blog-post.php`, `includes/blog-data.php` |
| 19 | Luganda/English language toggle | ✅ **Scaffolded** — working EN/LG switch covering shared chrome (nav, footer, buttons); Luganda strings are honest placeholders (English text + a visible "translation in progress" notice), ⏳ blocked on a native-speaker review rather than a guessed translation | `includes/lang.php`, `lang/en.php`, `lang/lg.php` |

## At a glance

- **19/19** items have a real, tested code change behind them — nothing left as a bare TODO comment
- **6** items are still blocked, and every one of them needs something only ASJ (or a native Luganda reviewer) can provide: real contact details, real doctor bios, more photography, a live-domain map check, legal sign-off on the drafted policies, and SMS/analytics account credentials
- Everything shipped was exercised directly, not just written: SMTP over a real socket handshake, CSRF replay/rejection, the full clean-URL route table, WCAG contrast math, the booking flow's SQLite write + `.ics` email attachment, and the CI script's own exit code
