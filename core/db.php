<?php
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";          // put your MySQL password if any
$DB_NAME = "call_billing";

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Optional: set strict mode (recommended)
$conn->set_charset("utf8mb4");
