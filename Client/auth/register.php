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
  <link rel="stylesheet" href="../styles/register.css" />
</head>

<body>
  <div id="logform" className="overflow-hidden">
    <form method="post" action="./register.php">
      <div id="inputfields">
        <h1>I-NoteBook</h1>
        <h3>Its free and always will be</h3>

        <div class="username h-full w-full relative">
          <label for="name"></label>
          <input type="text" id="name" name="name" placeholder="Enter your Name" />
          <PersonIcon className=" absolute top-4 right-3 cursor-pointer" />
        </div>
        <div class="username h-full w-full relative mt-6">
          <label for="email"></label>
          <input type="email" id="email" name="email" placeholder="Enter your email" />
          <EmailIcon className=" absolute top-4 right-3 cursor-pointer" />
        </div>

        <div class="username h-full w-full relative mt-6">
          <label for="password"></label>
          <input type="password" id="password" name="password" placeholder="Enter your password" />
        </div>
        <p>I have account <a href="./login.html"> Login?</a></p>
        <button type="submit" name="register">Sign Up</button>
      </div>
    </form>
  </div>
</body>

</html>

<?php
echo $notification;
?>