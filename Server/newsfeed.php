<?php

session_start();

include '../Configuration.php';
include '../Server/auths.php';

// Database connection
$con = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);

if (!$con) {
    die("Could not connect to the database");
}

if (isset($_SESSION['user_id']) && is_numeric($_SESSION['mybook_userid'])) {
    $id = $_SESSION['user_id'];
    $login = new login();
    $result = $login->check_login($id);

    if ($result) {
        //retrieve user data;
        $user = new User();

        $user_data = $user-- > get_data($id);

        if (!user_data) {
            header("Location: login.php");
            die;
        }
    } else {
        header("Location:login.php");
        die;
    }
}
