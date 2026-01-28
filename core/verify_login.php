<?php
require 'session_secure.php';

$config = require '../config/config.php';

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

/* Simple Rate Limit */
$_SESSION['attempts'] = $_SESSION['attempts'] ?? 0;

if ($_SESSION['attempts'] >= 5) {
    die("Too many attempts. Try again later.");
}

/* Verify */
if (
    hash_equals($config['admin_username'], $username) &&
    password_verify($password, $config['admin_password_hash'])
) {

    session_regenerate_id(true);

    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_username'] = $username;
    $_SESSION['attempts'] = 0;

    header("Location: ../public/index.php");
    exit;

} else {
    $_SESSION['attempts']++;
    header("Location: login.php");
    exit;
}
?>ubuntu@ip-172-31-44-186:/var/www/call-dashboard/ai_calling_system$ sudo nano core/verify_login.php
ubuntu@ip-172-31-44-186:/var/www/call-dashboard/ai_calling_system$ cat  core/verify_login.php
<?php
require 'session_secure.php';

$config = require '../config/config.php';

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

/* Simple Rate Limit */
$_SESSION['attempts'] = $_SESSION['attempts'] ?? 0;

if ($_SESSION['attempts'] >= 5) {
    die("Too many attempts. Try again later.");
}

/* Verify */
if (
    hash_equals($config['admin_username'], $username) &&
    password_verify($password, $config['admin_password_hash'])
) {

    session_regenerate_id(true);

    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_username'] = $username;
    $_SESSION['attempts'] = 0;

    header("Location: /");
    exit;

} else {
    $_SESSION['attempts']++;
    header("Location: /login.php");
    exit;
}
?>
