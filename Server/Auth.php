<?php
// Connecting to db
include "./DBConnect.php";

// when register
if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO `auth` (`name`, `email`, `password`) VALUES ('$name', '$email', '$password')";
    if(mysqli_query($con, $sql)){
        echo "inserted success";
    }
    else{
        echo "Cannot insert";
    }
}

// login user authontication
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
}
