<?php
/**
 * SMS notifications via Africa's Talking (widely used across Uganda/East
 * Africa, unlike Twilio's more US/EU-centric coverage). Inert until
 * $site['sms']['username'] and ['api_key'] are filled in — see
 * includes/config.php. No SDK/Composer dependency: it's a single HTTP POST.
 */
function send_sms_notification(array $site, string $to, string $message): bool
{
    $sms = $site['sms'] ?? [];
    if (empty($sms['username']) || empty($sms['api_key'])) {
        return false; // not configured yet — silent no-op
    }

    $endpoint = !empty($sms['sandbox'])
        ? 'https://api.sandbox.africastalking.com/version1/messaging'
        : 'https://api.africastalking.com/version1/messaging';

    $ch = curl_init($endpoint);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 8,
        CURLOPT_HTTPHEADER     => [
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded',
            'apiKey: ' . $sms['api_key'],
        ],
        CURLOPT_POSTFIELDS => http_build_query([
            'username' => $sms['username'],
            'to'       => $to,
            'message'  => $message,
            'from'     => $sms['sender_id'] ?? '',
        ]),
    ]);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($response === false || $httpCode >= 300) {
        error_log('[ASJ notifier] SMS send failed (HTTP ' . $httpCode . '): ' . $curlError);
        return false;
    }

    return true;
}
