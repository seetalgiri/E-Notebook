<?php
session_start();

// Importing configurations 
include '../Configuration.php';

// Database connection
$con = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);

if (!$con) {
    die("Could not connect to the database");
}

// Check if the button is set or not
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

        // Check if email already exists
        $emailQuery = "SELECT * FROM `auth` WHERE `email` = '$email'";
        $emailResult = mysqli_query($con, $emailQuery);
        if (mysqli_num_rows($emailResult) > 0) {
            echo "User already registered";
        } else {
            // Insert into the database
            $regQuery = "INSERT INTO `auth` (`name`, `email`, `password`, `stream`) VALUES ('$name', '$email', '$password', '$stream')";

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

                // Redirect to index.php
                header("Location: ../index.php");
                exit();
            }
        }
    }

    // Check if the login button is clicked or not
    if (isset($_POST['login'])) {
        $email = $_POST['email']; // Assuming the email is obtained from the login form
        $password = $_POST['password']; // Assuming the password is obtained from the login form

        // Prepare the SQL query to select user data based on the provided email and password
        $loginQuery = "SELECT * FROM `auth` WHERE `email` = '$email' AND `password` = '$password'";

        $resLogin = mysqli_query($con, $loginQuery);

        // Check whether the user is registered or not
        if (mysqli_num_rows($resLogin) < 1) {
            echo "User not registered or password incorrect";
        } else {
            $user = mysqli_fetch_assoc($resLogin);

            // Set session variables
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['name'];
            $_SESSION['email'] = $user['email'];

            // Redirect to index.php or any other page you desire
            header("Location: ../index.php");
            exit();
        }
    }
}
?>