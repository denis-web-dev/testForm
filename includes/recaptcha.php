<?php
declare(strict_types=1);

function verifyRecaptcha(string $token): bool
{
    if (empty($token)) {
        error_log("reCAPTCHA: Token empty");
        return false;
    }

    $secretKey = getenv('GOOGLE_RECAPTCHA_SECRET_KEY');

    if (empty($secretKey)) {
        error_log("reCAPTCHA: Secret key not found");
        return false;
    }

    $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'secret'   => $secretKey,
        'response' => $token,
        'remoteip' => $_SERVER['REMOTE_ADDR'] ?? ''
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $response = curl_exec($ch);
    curl_close($ch);

    if (empty($response)) {
        return false;
    }

    $result = json_decode($response, true);

    return isset($result['success']) && $result['success'] === true && ($result['score'] ?? 0) >= 0.5;
}
