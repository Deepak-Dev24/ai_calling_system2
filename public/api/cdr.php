<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../core/auth.php';
require_once __DIR__ . '/../../config/vobiz_config.php';

header('Content-Type: application/json');
$authId    = VOBIZ_AUTH_ID;
$authToken = VOBIZ_AUTH_TOKEN;

$page  = max(1, (int)($_GET['page'] ?? 1));
$limit = min(50, max(10, (int)($_GET['limit'] ?? 50)));
$date  = $_GET['date'] ?? null;

function normalize($num) {
    return preg_replace('/\D+/', '', $num ?? '');
}

/* 1️⃣ Fetch recordings ONCE */
$recordingIndex = [];

$recUrl = "https://api.vobiz.ai/api/v1/Account/$authId/Recording/?recording_type=trunk";

$ch = curl_init($recUrl);
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    "X-Auth-ID: $authId",
    "X-Auth-Token: $authToken"
  ],
]);
$recJson = json_decode(curl_exec($ch), true);
curl_close($ch);

foreach ($recJson['objects'] ?? [] as $rec) {
  $recordingIndex[$rec['call_uuid']] = $rec['recording_url'];
}

/* 2️⃣ Fetch ONLY ONE PAGE of CDR */
$cdrUrl = "https://api.vobiz.ai/api/v1/account/$authId/cdr?page=$page&per_page=$limit";

$ch = curl_init($cdrUrl);
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    "X-Auth-ID: $authId",
    "X-Auth-Token: $authToken"
  ],
]);
$cdrJson = json_decode(curl_exec($ch), true);
curl_close($ch);



$data = [];

foreach ($cdrJson['data'] ?? [] as $cdr) {
     if ($date) {
        $cdrDate = date('Y-m-d', strtotime($cdr['start_time']));
        if ($cdrDate !== $date) {
            continue; // ✅ now valid
        }
    }
  $data[] = [
    "uuid"          => $cdr['uuid'],
    "date"          => $cdr['start_time'],
    "direction"     => $cdr['call_direction'],
    "from"          => $cdr['caller_id_number'],
    "to"            => $cdr['destination_number'],
    "duration"      => $cdr['billsec'] ?? 0,
    "status"        => ucfirst($cdr['hangup_disposition']),
    "recording_url" => $recordingIndex[$cdr['uuid']] ?? null
  ];
}

echo json_encode([
  "page"     => $page,
  "limit"   => $limit,
  "hasNext" => $cdrJson['pagination']['has_next'] ?? false,
  "data"    => $data
]);
?>
