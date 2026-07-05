<?php
/**
 * ASJ Eye Hospital — Site Configuration
 * Central place to edit contact details, navigation, and service data.
 * Update the placeholder phone/email/social values before going live.
 */

$site = [
    'name'        => 'ASJ Eye Hospital',
    'tagline'     => 'Kampala’s home for clear, confident vision',
    'phone'       => '+256 700 000 000',      // TODO: replace with live number
    'phone_href'  => '+256700000000',
    'whatsapp'    => '256700000000',           // TODO: replace with live WhatsApp number
    'email'       => 'info@asjeyehospital.com', // TODO: replace with live email
    'address'     => '14 Kyadondo Road, Kampala, Uganda',
    // Structured form of the address above, used for schema.org markup.
    'address_street'  => '14 Kyadondo Road',
    'address_city'    => 'Kampala',
    'address_country' => 'UG',
    'hours'       => 'Mon – Sat: 8:00am – 6:00pm',
    'emergency'   => 'Emergency eye care available on call',
    'map_query'   => '14+Kyadondo+Road+Kampala+Uganda',
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
];

$nav = [
    ['label' => 'Home',      'href' => 'index.php'],
    ['label' => 'About Us',  'href' => 'about.php'],
    ['label' => 'Services',  'href' => 'services.php'],
    ['label' => 'Our Team',  'href' => 'doctors.php'],
    ['label' => 'Contact',   'href' => 'contact.php'],
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

$current = basename($_SERVER['PHP_SELF']);
