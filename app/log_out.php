<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
header("Content-Security-Policy: default-src 'self'; font-src fonts.gstatic.com https://ka-f.fontawesome.com 'unsafe-inline'; style-src 'self' fonts.googleapis.com 'unsafe-inline'; script-src 'self' https://kit.fontawesome.com; connect-src 'self' https://ka-f.fontawesome.com");

require('Logs.php');
$user = isset($_SESSION['user']) ? $_SESSION['user'] : "Not logged in";
$log = new Log("log", "");
$log->insert("Logout {user: $user}");

session_destroy();
header("Location:index.php")

?>
