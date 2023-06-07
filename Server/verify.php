<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../Configuration.php';

// Database connection
$con = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);


if (isset($_GET['email']) && $_GET['v_code']) {
    $email = $_GET['email'];
    $vCode = $_GET['v_code'];
    $sql = "SELECT * FROM auth WHERE email = '$email'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if ($user['verification_code'] == $vCode) {
            $UpdateSql = "UPDATE auth SET is_verified = 1 WHERE email = '$email'";
            $updatee = mysqli_query($con, $UpdateSql);
            if ($updatee) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['stream'] = $user['stream'];
                $_SESSION['privilege'] = $user['privilege'];
                header("Location: " . '../index.php');
            }
        } else {
            echo "Some error occurred";
        }
    }
}
