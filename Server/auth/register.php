<?php
// Connecting to db
// include "../../Server/DBConnect.php";

$con = mysqli_connect("localhost", "root", "", "e_notebook");
if (!$con) {
  die("Database connection failed");
}

// check btn is clicked or not for connect
if (isset($_POST['register'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];
  echo "$password";

  // convert password into hash password
  $hash = password_hash($password, PASSWORD_BCRYPT);
  $password = $hash;

  // post data into server db named auth
  $query = "INSERT INTO `register` (`username`,`email`, `password`) VALUES ('$username','$email','$password')";
  $result = mysqli_query($con, $query);
  if ($result) {
    echo "Data inserted into server db";
  } else {
    echo "Cannot insert data into server db";
  }
}
?>