<?php
<<<<<<< HEAD
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
=======
if (session_status() === PHP_SESSION_NONE)
    session_start();
>>>>>>> 630326700dad90d9b2eafaa435850f2fe7beb352

// Importing configurations 
include '../Configuration.php';

<<<<<<< HEAD
$privilege = 2;
=======
// $privilege = 2;
>>>>>>> 630326700dad90d9b2eafaa435850f2fe7beb352

// Database connection
$con = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);

<<<<<<< HEAD
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
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'gaurabsunar0001@gmail.com';
        $mail->Password = 'unkewaqezreankae';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        //Recipients
        $mail->setFrom('gaurabsunar0001@gmail.com', 'E-NoteBook');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Email verification code from E-Notebook';
        $mail->Body = "Thanks for registration!<br>Please enter the following code to verify your email: <b>$v_code</b>";

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
        if (!isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['password'])) {
            echo "Please fill in all the required fields.";
            exit;
        }

=======
if (!$con) {
    die("Could not connect to the database");
}

// Check if the button is set or not
else {
    if (isset($_POST['register'])) {
        // if (!isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['stream'])) {
        //     echo "Please fill in all the required fields.";
        //     exit;
        // }

        // Validate username
        if (!isset($_POST['username']) || empty($_POST['username'])) {
            echo "Please enter a username.";
            exit;
        }

        // Validate email
        if (!isset($_POST['email']) || empty($_POST['email'])) {
            echo "Please enter an email.";
            exit;
        }

        // Validate password
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            echo "Please enter a password.";
            exit;
        }

        // Validate stream
        if (!isset($_POST['stream']) || empty($_POST['stream'])) {
            echo "Please select a stream.";
            exit;
        }


>>>>>>> 630326700dad90d9b2eafaa435850f2fe7beb352
        // Fetch data from the frontend
        $name = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
<<<<<<< HEAD
        $verification_code = rand(100000, 999999);

        $is_verified = 0;
=======
        $stream = $_POST['stream'];
>>>>>>> 630326700dad90d9b2eafaa435850f2fe7beb352

        // Check if email already exists
        $emailQuery = "SELECT * FROM `auth` WHERE `email` = '$email'";
        $emailResult = mysqli_query($con, $emailQuery);
        if (mysqli_num_rows($emailResult) > 0) {
<<<<<<< HEAD
            header("Location: ../auth/register.php?error=User already registered");
        } else {

            // Set super user privileges to 0
            if (strtolower($email) == "superadmin@gmail.com") {
                $privilege = 0;
            }

            $hashedPass = password_hash($password, PASSWORD_DEFAULT);
            if ($email === "superadmin@gmail.com") {
                $is_verified = 1;
            }
            // Insert into the database
            $regQuery = "INSERT INTO `auth` (`name`, `email`, `password`, `privilege`, `is_verified`) VALUES ('$name', '$email', '$hashedPass', '$privilege', '$is_verified')";

            // Execute the query
            if (strtolower($email) != "superadmin@gmail.com") {
                $regResponse = mysqli_query($con, $regQuery) && sendMail($email, $verification_code);
            } else {
                $regResponse = mysqli_query($con, $regQuery);
            }

            if (!$regResponse) {
                header("Location: ../auth/register.php?error=Cannot register user");
            } else {
                // Retrieve the inserted data's ID
                $insertedId = mysqli_insert_id($con);
                if (strtolower($email) != "superadmin@gmail.com") {
                    // // Set session variables
                    $_SESSION['vcode'] = $verification_code;
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $insertedId;
                    header("Location: ./otpverify.php");
                } else {
                    $_SESSION['id'] = $insertedId;
                    $_SESSION['username'] = $name;
                    $_SESSION['email'] = $email;
                    $_SESSION['privilege'] = $privilege;
                    $_SESSION['isverified'] = 1;
                    header("Location: ../index.php");
                }

=======
            echo "User already registered";
        } else {

            if (strtolower($email) == "superadmin@gmail.com") {
                $privilege = 0;
            }
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);
            // Insert into the database
            $regQuery = "INSERT INTO `auth` (`name`, `email`, `password`, `stream`, `privilege`) VALUES ('$name', '$email', '$hashedPass', '$stream', '$privilege')";

            // Execute the query
            $regResponse = mysqli_query($con, $regQuery);

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
                    header("Location:../admin/dashboard.php");
                } else {
                    header("Location: ../index.php");
                }
>>>>>>> 630326700dad90d9b2eafaa435850f2fe7beb352
                exit();
            }
        }
    }

    // Check if the login button is clicked or not
    if (isset($_POST['login'])) {
<<<<<<< HEAD
=======

        if (!isset($_POST['email']) || empty($_POST['email'])) {
            echo "Please enter an email.";
            exit;
        }

        // Validate password
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            echo "Please enter a password.";
            exit;
        }

>>>>>>> 630326700dad90d9b2eafaa435850f2fe7beb352
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare the SQL query to select user data based on the provided email
        $loginQuery = "SELECT * FROM `auth` WHERE `email` = '$email'";
        $resLogin = mysqli_query($con, $loginQuery);

        // Check whether the user is registered or not
        if (mysqli_num_rows($resLogin) < 1) {
<<<<<<< HEAD
            header("Location: ../auth/login.php?error=Enter valid credential");
            // echo "User not registered or password incorrect";
=======
            echo "User not registered or password incorrect";
>>>>>>> 630326700dad90d9b2eafaa435850f2fe7beb352
        } else {
            $user = mysqli_fetch_assoc($resLogin);
            $hashedPassword = $user['password'];

            // Verify the password
            if (password_verify($password, $hashedPassword)) {
                // Setting value session variables
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['name'];
                $_SESSION['email'] = $user['email'];
<<<<<<< HEAD
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
                // echo "User not registered or password incorrect";
                header("Location: ../auth/login.php?error=Enter valid credential");
            }
        }
    }
}
=======
                $_SESSION['stream'] = $user['stream'];
                $_SESSION['privilege'] = $user['privilege'];


                if ($_SESSION['privilege'] == 0) {
                    header("Location:../admin/dashboard.php");
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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['logout'])) {
            // Handle logout action
            // Perform any necessary logout logic here

            // Redirect to the login page
            header("Location: ../../auth/login.php");
            exit();
        } elseif (isset($_POST['home'])) {
            // Handle home action
            // Perform any necessary home logic here

            // Redirect to the home page
            header("Location: e_notebook/index.php");
            exit();
        }
    }
}
>>>>>>> 630326700dad90d9b2eafaa435850f2fe7beb352
