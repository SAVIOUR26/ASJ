# ASJ Eye Hospital — Build Roadmap

Snapshot taken at the Stage 1 handoff review. 19 open items across four phases,
ordered by what actually blocks launch versus what can wait.

- **Phase 0 — Launch blockers**: nothing goes live until these close.
- **Phase 1 — Pre-promotion hardening**: needed before a wider marketing push.
- **Phase 2 — Polish**: raises the ceiling, doesn't block the floor.
- **Phase 3 — Growth track**: future scope, quoted separately.

Owner key: **Client** (content/business info only) · **Dev** · **Client + Dev** ·
**Dev/DevOps** (server-level, outside the app repo).

## Phase 0 — Launch blockers

| # | Task | Why it matters | Owner | Effort | Ref |
|---|------|-----------------|-------|--------|-----|
| 1 | Swap placeholder contact details for the real ones | Phone, WhatsApp and email are still `TODO` placeholders — every call/WhatsApp/mailto link goes nowhere real | Client | 15 min | `includes/config.php` |
| 2 | Replace the three placeholder specialist profiles | Generic role cards with stock photos, no real names/quals/bios | Client + Dev | 1–2 hrs | `doctors.php` |
| 3 | Move the contact form off PHP `mail()` | Unreliable on an unconfigured VPS MTA; wire to Mailcow via SMTP (PHPMailer) | Dev | 2–4 hrs | `contact-handler.php` |
| 4 | Add CSRF protection to the enquiry form | Honeypot stops bots, not forged submissions — no token binds the POST to a session-issued form | Dev | 1 hr | `contact.php`, `contact-handler.php` |
| 5 | Verify the live map pin | Key-less Maps embed couldn't render in the sandbox (no outbound access); confirm it resolves correctly post-deploy | Dev | 30 min | `contact.php` |

## Phase 1 — Pre-promotion hardening

| # | Task | Why it matters | Owner | Effort | Ref |
|---|------|-----------------|-------|--------|-----|
| 6 | SEO fundamentals: sitemap, robots.txt, structured data | No sitemap.xml/robots.txt/OG-Twitter meta/schema.org markup yet — nothing for Google to index efficiently | Dev | 3–4 hrs | `includes/header.php` |
| 7 | Wire up analytics | No enquiry-volume or traffic-source visibility yet (GA4 or Plausible/Fathom, client's call) | Client + Dev | 1 hr | `includes/header.php` |
| 8 | Draft Privacy Policy & Terms pages | No legal/compliance copy exists for a site collecting names/phone/medical enquiries; draft against Uganda's Data Protection and Privacy Act, 2019 | Dev + Client sign-off | 2–3 hrs | new: `privacy.php`, `terms.php` |
| 9 | Set security headers at the server | HSTS/CSP/X-Frame-Options/Referrer-Policy belong in the vhost — none set yet, no server config in this repo | Dev/DevOps | 1–2 hrs | server vhost config |
| 10 | Commission more facility photography | Only 6 unique photos exist (2 supplied duplicates dropped); exterior, OT, more staff would carry the gallery further | Client | n/a | `assets/img/` |

## Phase 2 — Polish

| # | Task | Why it matters | Owner | Effort | Ref |
|---|------|-----------------|-------|--------|-----|
| 11 | Clean URLs | Route `/services` instead of `/services.php` via rewrite rules | Dev | 1–2 hrs | `.htaccess` / nginx rewrite |
| 12 | Image & asset performance pass | Compress/convert photos to WebP, add explicit width/height + lazy-loading | Dev | 2–3 hrs | `assets/img/` |
| 13 | Accessibility pass beyond current baseline | Skip-link/aria already in place; full WCAG 2.1 AA pass on contrast, focus order, form labeling | Dev | 2–3 hrs | `assets/css/style.css` |
| 14 | Custom 500 / maintenance page | 404.php exists; server errors and maintenance windows still hit a bare default page | Dev | 1 hr | `404.php` |
| 15 | Basic CI smoke checks | No automated check on push — PHP lint + broken-link check would catch a bad include path before production | Dev | 2–4 hrs | new: `.github/workflows/` |

## Phase 3 — Growth track (scoped separately)

| # | Task | Why it matters | Owner |
|---|------|-----------------|-------|
| 16 | Real-time appointment booking | Replace enquiry-and-callback with a live calendar/slot picker | Dev |
| 17 | WhatsApp/SMS appointment reminders | Automated patient reminders to reduce no-shows | Dev |
| 18 | Content/blog section | Ongoing content surface for eye-health articles, ranks for long-tail search | Dev + Client content |
| 19 | Luganda/English language toggle | Bilingual support for the local patient base — a full i18n pass, not a copy-paste job | Dev |

## At a glance

- **19** open items tracked
- **5** launch blockers (Phase 0)
- **4** items waiting on client input (contact info, doctor content, photography, legal sign-off)
- **~12–18 hrs** of dev time to reach launch-ready (Phase 0 + 1, dev-side effort only)
