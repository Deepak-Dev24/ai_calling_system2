<?php
session_start();

/* ADMIN CREDENTIALS */
$ADMIN_USERNAME = "admin";
$ADMIN_PASSWORD = "admin@123";

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username === $ADMIN_USERNAME && $password === $ADMIN_PASSWORD) {

    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_username'] = $username;

    header("Location: index.php");
    exit;

} else {
    header("Location: login.php?error=1");
    exit;
}
?>