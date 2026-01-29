<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('Asia/Kolkata');

require_once __DIR__ . '/../../core/session_secure.php';
require_once __DIR__ . '/../../core/auth.php';
require_once __DIR__ . '/../../core/db.php';
require_once __DIR__ . '/../../api/vobiz_cdr_fetch.php';

header('Content-Type: application/json');

$userId = $_SESSION['user_id'] ?? 1;
$rate   = 3;
$rows   = 0;

$data = fetchVobizCDR(1, 50);

if (empty($data['data'])) {
    echo json_encode(["status" => "ok", "message" => "No data from Vobiz"]);
    exit;
}

foreach ($data['data'] as $cdr) {

    $billsec = (int) ($cdr['billsec'] ?? 0);
    if ($billsec <= 0) continue;

    $minutes = (int) ceil($billsec / 60);
    $amount  = $minutes * $rate;

    $stmt = $pdo->prepare("
        INSERT INTO call_records
        (user_id, call_uuid, call_date, direction,
         from_number, to_number,
         billsec, bill_minutes, rate_per_min, amount, status, paid)
        VALUES
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)
        ON DUPLICATE KEY UPDATE
            billsec = VALUES(billsec),
            bill_minutes = VALUES(bill_minutes),
            amount = VALUES(amount),
            status = VALUES(status)
    ");

    $stmt->execute([
        $userId,
        $cdr['uuid'],
        str_replace('T', ' ', $cdr['start_time']),
        $cdr['call_direction'],
        $cdr['caller_id_number'],
        $cdr['destination_number'],
        $billsec,
        $minutes,
        $rate,
        $amount,
        ucfirst($cdr['hangup_disposition'])
    ]);

    $rows++;
}

echo json_encode([
    "status" => "success",
    "rows_processed" => $rows
]);
