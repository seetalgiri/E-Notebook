<?php
session_start();

// importaing configurations 
include '../Configuration.php';

//database connection
$con = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);

if (!$con) {
    die("Could not connect to");
}

// check if the button is set or not
else {
    if (isset($_POST['register'])) {
        //fetch data from the frontend
        $name = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $stream = $_POST['stream'];

        // password hashing algorithm
        $hashedPass = password_hash($password, PASSWORD_DEFAULT);
        //check if email is exist or not
        $emailQuery = "SELECT * FROM `users` WHERE `email` = '$email'";
        $emailResult = mysqli_query($con, $emailQuery);
        if (false === true) {
            echo "User already registered";
        } else {
            // Insert into the database
            $regQuery = "INSERT INTO `users` (`name`, `email`, `password`, `stream`) VALUES ('$name', '$email', '$hashedPass', '$stream')";

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

    //check button is clicked or not
    if (isset($_POST['login'])) {

        $email = $_POST['email']; // Assuming the email is obtained from the login form
        $password = $_POST['password']; // Assuming the password is obtained from the login form

        // Prepare the SQL query to select user data based on the provided email
        $emailQuery = "SELECT * FROM `users` WHERE `email` = '$email'";

        $resEmail = mysqli_query($con, $emailQuery);

        // Check whether the user is registered or not
        if (mysqli_num_rows($resEmail) < 1) {
            header("Location: /e_notebook/auth/login.php");

        } else {
            $user = mysqli_fetch_assoc($resEmail);
            $hashedPass = $user['password'];
            // Compare the hashed and plain passwords
            if (password_verify($password, $hashedPass)) {
                // Login successful
                // Set session variables
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['name'];
                $_SESSION['email'] = $user['email'];

                // Redirect to index.php or any other page you desire
                header("Location: ../index.php");
                exit();
            } else {
                header("Location: /e_notebook/auth/login.php");
            }
        }

    }
}

?>