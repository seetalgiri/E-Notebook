<?php
// Connecting to db
include "../../Server/DBConnect.php";
$notification = false;

// when register
if (isset($_POST['register'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "INSERT INTO `auth` (`name`, `email`, `password`) VALUES ('$name', '$email', '$password')";
  if (mysqli_query($con, $sql)) {
    $notification = true;
  } else {
    echo "Cannot insert";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>register</title>
  <link rel="stylesheet" href="../styles/registe.css" />
</head>

<body>
    <div id="container">
     
      <div id="loginform" >
        <form method="post" action="../../Server/Auth.php">
          <div id="inputfields">
            <h1>Register</h1>
            
              <label for="name"></label>
              <input
                type="username"
                id="username"
                name="username"
                placeholder="Enter your username"
              />
                      
              <label for="email"></label>
              <input
                type="email"
                id="email"
                name="email"
                placeholder="Enter your email"
              />
           
              <label for="password"></label>
              <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter your password"
              />
              <span id="toggle-password" class="show-password"></span>
                  
              <select name="stream" id="stream">
                <option value="all">All</option>
                <option value="bca">BCA</option>
                <option value="bbm">BBM</option>
                <option value="others">others</option>
              </select>
        
            <p>I don't have account <a href="./login.php">SignUp?</a></p>

            <button type="submit" name="register">Register</button>
          </div>
        </form>
      </div>
      <div id="paragraph">
        <h2>E-NoteBook</h2>
        <p>Save your notes and share it with your friends and others</p>
      </div>
    </div>
  </body>

</html>

<?php
echo $notification;
?>