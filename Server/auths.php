<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

// Importing configurations 
include '../Configuration.php';

// $privilege = 2;

// Database connection
$con = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);

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


        // Fetch data from the frontend
        $name = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $stream = $_POST['stream'];

        // Check if email already exists
        $emailQuery = "SELECT * FROM `auth` WHERE `email` = '$email'";
        $emailResult = mysqli_query($con, $emailQuery);
        if (mysqli_num_rows($emailResult) > 0) {
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
                exit();
            }
        }
    }

    // Check if the login button is clicked or not
    if (isset($_POST['login'])) {

        if (!isset($_POST['email']) || empty($_POST['email'])) {
            echo "Please enter an email.";
            exit;
        }

        // Validate password
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            echo "Please enter a password.";
            exit;
        }

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
