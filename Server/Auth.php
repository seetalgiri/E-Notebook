<?php
session_start();

//variable declaration for database connection
$commonHost = "localhost";
$commonUser = "root";
$commonPassword = "";
$commonDbname = "s_enotebook";
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
        if (mysqli_num_rows($emailResult) > 1) {
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

        //get data from the frontend
        $email = $_POST['email'];
        $password = $_POST['password'];

        //fetch user query
        $emailQuery = "SELECT * FROM `users` WHERE `email` = '$email'";
        $resEmail = mysqli_query($con, $emailQuery);
        //check whether user is registered or not
        if (mysqli_num_rows($resEmail) < 1) {
            echo "Invalid credential";
        } else {
            $user = mysqli_fetch_assoc($resEmail);
            $hashedPass = $user['password'];

            //compare hashed and plain password
            if (password_verify($password, $hashedPass)) {
                echo "login successfully";
            } else {
                echo "Invalid credential";
            }
        }
    }
}

?>