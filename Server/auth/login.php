<?php
$con = mysqli_connect("localhost", "root", "", "e_notebook");
if (!$con) {
    die("Database connection failed");
}

// check btn is clicked or not for connect

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    // password_verify()

    // fetch data from db and check if password and email are correct
    $sql = "SELECT * FROM `register` WHERE `email` = '$email'";
    $rowEmail = mysqli_query($con, $sql);
    if (mysqli_num_rows($rowEmail) > 0) {
        $userdata = mysqli_fetch_assoc($rowEmail);
        // check text password and hash password are correct
        // set header to index.php
        if (password_verify($password, $userdata['password'])) {
            header("Location: ../../index.php ");
        } else {
            echo "password incorrect";
        }
    } else {
        echo "user not found";
    }
}

?>