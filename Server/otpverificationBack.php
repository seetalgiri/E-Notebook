<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../Configuration.php';

// Database connection
$con = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);
$email = "";

if (isset($_SESSION['vcode']) && isset($_SESSION['email'])) {
    $vCode = $_SESSION['vcode'];
    $email = $_SESSION['email'];
}


// Check if the verification code is provided
if (isset($_POST['verificationCode'])) {
    $verificationCode = $_POST['verificationCode'];
    if ($vCode == $verificationCode) {
        $updateSql = "UPDATE auth SET is_verified = 1 WHERE email = '$email'";
        $updateResult = mysqli_query($con, $updateSql);

        if ($updateResult) {
            echo "Verification successful";
        } else {
            echo "Error: Unable to update verification status";
        }
    } else {
        echo "Plesse Enter Correct Verification Code";
    }
}
