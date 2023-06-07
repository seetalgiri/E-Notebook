<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Importing configurations 
include '../Configuration.php';

$privilege = 2;

// Database connection
$con = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);

function sendMail($email, $v_code)
{
    require 'PHPMailer\PHPMailer.php';
    require 'PHPMailer\SMTP.php';
    require 'PHPMailer\Exception.php';
    // https://www.youtube.com/watch?v=w43LAiVV-cM&t=1139s first watch this 
    // https://www.youtube.com/watch?v=_sRQX_9C9l8 and solve the problem of email sending with the help of theis

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'gaurabsunar0001@gmail.com';
        $mail->Password   = 'unkewaqezreankae';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        //Recipients
        $mail->setFrom('gaurabsunar0001@gmail.com', 'E-NoteBook');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification from E-Notebook';
        $mail->Body    = "Thanks for registration <br> click the link below to verify the email address <a href='http://localhost/e_notebook/Server/verify.php?email=$email&v_code=$v_code'>Verify</a>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if (!$con) {
    die("Could not connect to the database");
}
// Check if the register button is set or not
else {
    if (isset($_POST['register'])) {
        if (!isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['stream'])) {
            echo "Please fill in all the required fields.";
            exit;
        }


        // Fetch data from the frontend
        $name = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $stream = $_POST['stream'];
        $verification_code = bin2hex(random_bytes(16));
        $is_verified = 0;

        // Check if email already exists
        $emailQuery = "SELECT * FROM `auth` WHERE `email` = '$email'";
        $emailResult = mysqli_query($con, $emailQuery);
        if (mysqli_num_rows($emailResult) > 0) {
            echo "User already registered";
        } else {

            // Set super user privileges to 0
            if (strtolower($email) == "superadmin@gmail.com") {
                $privilege = 0;
            }

            $hashedPass = password_hash($password, PASSWORD_DEFAULT);
            // Insert into the database
            $regQuery = "INSERT INTO `auth` (`name`, `email`, `password`, `stream`, `privilege`, `verification_code`, `is_verified`) VALUES ('$name', '$email', '$hashedPass', '$stream', '$privilege', '$verification_code', '$is_verified')";

            // Execute the query
            $regResponse = mysqli_query($con, $regQuery) && sendMail($email, $verification_code);

            if (!$regResponse) {
                echo "Cannot insert into the database";
            } else {
                // Retrieve the inserted data's ID
                $insertedId = mysqli_insert_id($con);

                // Set session variables
                $_SESSION['id'] = $insertedId;
                $_SESSION['username'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['stream'] = $stream;
                $_SESSION['privilege'] = $privilege;

                // Redirect to index.php
                if ($privilege == 0) {
                    header("Location: ../admin/dashboard.php");
                } else {
                    header("Location: ../index.php");
                }
                exit();
            }
        }
    }

    // Check if the login button is clicked or not
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare the SQL query to select user data based on the provided email
        $loginQuery = "SELECT * FROM `auth` WHERE `email` = '$email'";
        $resLogin = mysqli_query($con, $loginQuery);

        // Check whether the user is registered or not
        if (mysqli_num_rows($resLogin) < 1) {
            echo "User not registered or password incorrect";
        } else {
            $user = mysqli_fetch_assoc($resLogin);
            $hashedPassword = $user['password'];

            // Verify the password
            if (password_verify($password, $hashedPassword)) {
                // Setting value session variables
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['stream'] = $user['stream'];
                $_SESSION['privilege'] = $user['privilege'];

                // Redirect to index.php or any other page you desire
                if ($user['privilege'] == 0) {
                    header("Location: ../admin/dashboard.php");
                } else {
                    header("Location: ../index.php");
                }
                exit();
            } else {
                // Password is incorrect
                echo "User not registered or password incorrect";
            }
        }
    }
}
