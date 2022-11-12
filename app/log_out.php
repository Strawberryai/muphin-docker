<?php
session_start();

require('Logs.php');
$user = isset($_SESSION['user']) ? $_SESSION['user'] : "Not logged in";
$log = new Log("log", "");
$log->insert("Intento de login {user: $user}");

session_destroy();
header("Location:index.php")

?>
