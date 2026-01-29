<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../core/session_secure.php';
require_once __DIR__ . '/../../core/auth.php';
require_once __DIR__ . '/../../core/db.php';

header('Content-Type: application/json');

$userId = $_SESSION['user_id'] ?? 1;

/* Safety check */
if (!isset($pdo)) {
    echo json_encode(["status" => "error", "message" => "DB not connected"]);
    exit;
}

$stmt = $pdo->prepare("
  UPDATE call_records
  SET paid = 1
  WHERE user_id = ? AND paid = 0
");

$stmt->execute([$userId]);

echo json_encode([
  "status"  => "success",
  "message" => "Bill cleared"
]);
