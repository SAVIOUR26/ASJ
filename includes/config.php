<?php
/**
 * ASJ Eye Hospital — Site Configuration
 * Central place to edit contact details, navigation, and service data.
 * Update the placeholder phone/email/social values before going live.
 */

$site = [
    'name'        => 'ASJ Eye Hospital',
    'tagline'     => 'Clear Vision, Better Life',
    'phone'       => '0750 000 777',
    'phone_href'  => '+256750000777',
    'whatsapp'    => '256703429370',
    'email'       => 'info@asjeyehospital.com',
    'address'     => '14 Kyadondo Road, Opposite Indian High Commission, next to NRM Office, Kampala, Uganda',
    // Structured form of the address above, used for schema.org markup.
    'address_street'  => '14 Kyadondo Road, Opposite Indian High Commission, next to NRM Office',
    'address_city'    => 'Kampala',
    'address_country' => 'UG',

    // Structured opening hours — 'hours_short' is the compact form used in
    // the topbar; 'hours' is the full breakdown for the footer/contact page.
    'hours_short' => 'Mon – Fri: 9:00am – 5:00pm',
    'hours' => [
        ['days' => 'Mon – Fri', 'time' => '9:00am – 5:00pm'],
        ['days' => 'Sat',       'time' => '9:00am – 4:00pm'],
        ['days' => 'Sun',       'time' => 'Closed'],
    ],

    'emergency' => 'Emergency care available 24/7',
    // Both numbers the client gave for urgent/after-hours contact.
    'emergency_phones' => [
        ['display' => '0755 654 588', 'href' => '+256755654588'],
        ['display' => '0703 429 370', 'href' => '+256703429370'],
    ],

    'map_query'   => '14+Kyadondo+Road+Opposite+Indian+High+Commission+Kampala+Uganda',
    'social' => [
        'facebook'  => '#',
        'instagram' => '#',
        'twitter'   => '#',
        'youtube'   => '#',
    ],

    // TODO: fill in once Mailcow (or another SMTP provider) is set up on the
    // VPS. Leave 'host' empty to keep using PHP's mail() in the meantime —
    // see includes/mailer.php.
    'smtp' => [
        'host'       => '',              // e.g. 'mail.asjeyehospital.com'
        'port'       => 587,              // 587 for STARTTLS, 465 for implicit TLS
        'encryption' => 'tls',            // 'tls' or 'ssl'
        'username'   => '',
        'password'   => '',
        'from'       => '',               // defaults to $site['email'] if left blank
    ],

    // TODO: paste a real GA4 Measurement ID (e.g. 'G-XXXXXXXXXX') once the
    // client has an analytics account, or swap the snippet in header.php for
    // a privacy-first alternative (Plausible/Fathom). Left blank, no
    // tracking script is loaded at all.
    'ga4_id' => '',

    // TODO: fill in once an Africa's Talking account exists, to enable SMS
    // appointment-request confirmations and next-day reminders — see
    // includes/notifier.php and scripts/send-appointment-reminders.php.
    // Left blank, SMS sending is a silent no-op.
    'sms' => [
        'provider'  => 'africastalking',
        'username'  => '',
        'api_key'   => '',
        'sender_id' => '',
        'sandbox'   => true,
    ],
];

$nav = [
    ['label' => 'Home',      'href' => '/',         'match' => 'index'],
    ['label' => 'About Us',  'href' => '/about',    'match' => 'about'],
    ['label' => 'Services',  'href' => '/services', 'match' => 'services'],
    ['label' => 'Our Team',  'href' => '/doctors',  'match' => 'doctors'],
    ['label' => 'Insights',  'href' => '/blog',     'match' => 'blog'],
    ['label' => 'Contact',   'href' => '/contact',  'match' => 'contact'],
];

/**
 * Eye care services. Icons reference Font Awesome 6 classes.
 * 'featured' services are shown on the homepage grid.
 */
$services = [
    [
        'slug'     => 'cataract-surgery',
        'icon'     => 'fa-eye-low-vision',
        'name'     => 'Cataract Surgery',
        'short'    => 'Modern, stitch-free cataract removal with premium intraocular lens options for lasting clarity.',
        'featured' => true,
    ],
    [
        'slug'     => 'lasik-refractive',
        'icon'     => 'fa-crosshairs',
        'name'     => 'LASIK & Refractive Surgery',
        'short'    => 'Laser vision correction for short-sightedness, long-sightedness and astigmatism — glasses-free freedom.',
        'featured' => true,
    ],
    [
        'slug'     => 'glaucoma-care',
        'icon'     => 'fa-gauge-high',
        'name'     => 'Glaucoma Care',
        'short'    => 'Early detection and long-term management to protect your optic nerve and preserve sight.',
        'featured' => true,
    ],
    [
        'slug'     => 'retina-vitreous',
        'icon'     => 'fa-satellite-dish',
        'name'     => 'Retina & Vitreous',
        'short'    => 'Diagnosis and treatment of diabetic retinopathy, retinal detachment and macular disease.',
        'featured' => true,
    ],
    [
        'slug'     => 'cornea-treatment',
        'icon'     => 'fa-circle-dot',
        'name'     => 'Cornea Treatment',
        'short'    => 'Care for corneal infections, injuries and transplant needs from a dedicated corneal team.',
        'featured' => true,
    ],
    [
        'slug'     => 'pediatric-ophthalmology',
        'icon'     => 'fa-child-reaching',
        'name'     => 'Pediatric Eye Care',
        'short'    => 'Gentle vision screening, squint correction and lazy-eye therapy built around children.',
        'featured' => true,
    ],
    [
        'slug'     => 'oculoplasty',
        'icon'     => 'fa-hand-sparkles',
        'name'     => 'Oculoplasty',
        'short'    => 'Reconstructive and cosmetic surgery around the eyelids, tear ducts and eye socket.',
        'featured' => false,
    ],
    [
        'slug'     => 'diabetic-eye-care',
        'icon'     => 'fa-droplet',
        'name'     => 'Diabetic Eye Screening',
        'short'    => 'Routine retinal screening for people living with diabetes to catch changes early.',
        'featured' => false,
    ],
    [
        'slug'     => 'optical-shop',
        'icon'     => 'fa-glasses',
        'name'     => 'Optical Shop & Contact Lenses',
        'short'    => 'In-house dispensing with a wide range of frames, lenses and contact lens fittings.',
        'featured' => false,
    ],
    [
        'slug'     => 'general-eye-checkup',
        'icon'     => 'fa-magnifying-glass',
        'name'     => 'Comprehensive Eye Exams',
        'short'    => 'Full diagnostic work-ups using modern imaging to catch problems before they affect vision.',
        'featured' => false,
    ],
];

// A page can set $current itself before requiring header.php (e.g.
// blog-post.php wants the "Insights" nav item highlighted, not itself).
if (!isset($current)) {
    $current = basename($_SERVER['PHP_SELF'], '.php');
}
