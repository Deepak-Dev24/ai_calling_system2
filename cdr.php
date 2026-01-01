<?php
putenv("VOBIZ_AUTH_ID=MA_HBHNNLV7");
putenv("VOBIZ_AUTH_TOKEN=xfqiPaeTk6KIiZWVLXfbNWaQSvRRjrCurLn8jPcPStk4XehzHesP8SjoThlJqB2c");

$authId = getenv('VOBIZ_AUTH_ID');
$authToken = getenv('VOBIZ_AUTH_TOKEN');

$allData = [];
$page = 1;

do {
    $url = "https://api.vobiz.ai/api/v1/account/$authId/cdr?page=$page&per_page=50";

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "X-Auth-ID: $authId",
            "X-Auth-Token: $authToken"
        ]
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $json = json_decode($response, true);

    if (!isset($json['data'])) break;

    $allData = array_merge($allData, $json['data']);

    $hasNext = $json['pagination']['has_next'] ?? false;
    $page++;

} while ($hasNext);

// FINAL OUTPUT
header("Content-Type: application/json");
echo json_encode([
    "success" => true,
    "count" => count($allData),
    "data" => $allData
]);
