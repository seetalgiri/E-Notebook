<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$username = "User";
$id = 0;
$email = "user@example.com";
$privilege = 2;

// getting user value from sesstion
if (isset($_SESSION['username'], $_SESSION['id'], $_SESSION['email'], $_SESSION['privilege'])) {
    $username = $_SESSION['username'];
    $id = (int) $_SESSION['id'];
    $email = $_SESSION['email'];
    $privilege = $_SESSION['privilege'];
}