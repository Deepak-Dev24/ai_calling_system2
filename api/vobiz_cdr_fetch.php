<?php
require_once __DIR__ . '/../config/vobiz_config.php';

function fetchVobizCDR($page = 1, $limit = 50) {

    $authId    = VOBIZ_AUTH_ID;
    $authToken = VOBIZ_AUTH_TOKEN;

    $url = "https://api.vobiz.ai/api/v1/account/$authId/cdr?page=$page&per_page=$limit";

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,

        // 🔥 THIS WAS THE MISSING PIECE (WINDOWS CLI FIX)
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,

        CURLOPT_HTTPHEADER => [
            "X-Auth-ID: $authId",
            "X-Auth-Token: $authToken",
            "Accept: application/json"
        ],
    ]);

    $raw = curl_exec($ch);
    curl_close($ch);

    return json_decode($raw, true);
}
