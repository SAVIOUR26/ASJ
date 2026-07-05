<?php
/**
 * Server error page. Deliberately self-contained — no require of
 * includes/config.php or includes/header.php, since a broken config or
 * include is exactly the kind of thing that could trigger a 500 in the
 * first place, and this page needs to render regardless.
 */
http_response_code(500);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Something went wrong — ASJ Eye Hospital</title>
<meta name="robots" content="noindex">
<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32.png">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<section class="section" style="text-align:center; padding-block:120px;">
    <div class="container">
        <span class="eyebrow" style="justify-content:center;">500</span>
        <h1 style="margin-top:14px;">Something went wrong on our end.</h1>
        <p style="max-width:50ch; margin:16px auto 32px;">This isn't a problem with your connection — our server hit an unexpected error. Please try again in a moment, or call us directly if it's urgent.</p>
        <a href="/" class="btn btn--primary"><i class="fa-solid fa-house"></i> Back to Home</a>
    </div>
</section>
</body>
</html>
