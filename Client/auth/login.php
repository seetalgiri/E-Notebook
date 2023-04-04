<?php
// Connecting to db
include "../../Server/DBConnect.php";

// login user authontication
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration form</title>
  <link rel="stylesheet" href="../styles/login.css" />
</head>

<body>
  <div id="container" class="overflow-hidden">
    <div id="paragraph">
      <h2>I-NoteBook</h2>
      <p>Save your notes and share it with your friends and other world</p>
    </div>
    <div id="loginform" class="overflow-hidden">
      <form method="post" action="../../Server/Auth.php">
        <div id="inputfields">
          <h1 id="login">Login to see your Notes</h1>

          <div class="username">
            <label for="name"></label>
            <input type="email" id="email" name="email" placeholder="Enter your email" />
          </div>

          <div class="username">
            <label for="password"></label>
            <input type="password" id="password" name="password" placeholder="Enter your password" />
            <span id="toggle-password" class="show-password"></span>
          </div>
          <p>I don't have account <a href="./client/auth/register.php">SignUp?</a></p>

          <button type="submit" name="login">Login</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>