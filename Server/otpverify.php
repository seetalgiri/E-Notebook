<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

include '../Configuration.php';

// Database connection
$con = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);
$verificationCode = 0;
$emailaccount = "youremail@gmail.com";

if (isset($_SESSION['email']) && isset($_SESSION['vcode']) && isset($_SESSION['id'])) {
  $verificationCode = $_SESSION['vcode'];
  $userId = $_SESSION['id'];
  $emailaccount = $_SESSION['email'];
} else {
  header("Location: ../auth/register.php");
}

if (isset($_POST['verify'])) {
  if ($verificationCode != 0) {
    $enteredCode = $_POST['otp'];
    if ($enteredCode == $verificationCode) {
      $sql = "UPDATE auth SET is_verified=1 WHERE id='$userId'";
      if (mysqli_query($con, $sql)) {
        $query = "SELECT * FROM `auth` WHERE `id` = '$userId'";
        $res = mysqli_query($con, $query);
        $user = mysqli_fetch_assoc($res);

        // Setting session variables
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['privilege'] = $user['privilege'];
        $_SESSION['isverified'] = $user['is_verified'];
        header('Location: ../index.php');
      }
    } else {
      header('Location: ./otpverify.php');
    }
  }
}
echo $verificationCode;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>E-Notebook OTP Verification</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 90vh;
    }

    #form-container {
      height: 330px;
      width: 300px;
      background-color: rgba(92, 91, 91, 0.221);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 30px;
      border-radius: 4px;
    }

    #form-container svg {
      height: 60px;
    }

    .contentForVerification {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      gap: 0px;
      margin: 10px;
    }

    .contentForVerification h2 {
      font-family: Arial, Helvetica, sans-serif;
      font-weight: 500;
      color: rgb(40, 40, 40);
    }

    .contentForVerification p {
      text-align: center;
      margin-top: -10px;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 15px;
      font-weight: 500;
      color: rgb(97, 97, 97);
    }

    #form-container form {
      display: flex;
      flex-direction: column;
      width: 95%;
      padding: 0 20px;
      gap: 10px;
      padding-bottom: 15px;
    }

    #form-container form input {
      padding: 5px;
      font-size: 16px;
    }

    input::-webkit-inner-spin-button,
    input::-webkit-outer-spin-button {
      display: none;
    }

    #form-container form button {
      padding: 8px;
      font-weight: 600;
      letter-spacing: 1px;
      cursor: pointer;
      background-color: blue;
      color: white;
      border: none;
    }

    #form-container form button:hover {
      background-color: rgb(0, 0, 137);
    }

    .info {
      font-family: Arial, Helvetica, sans-serif;
      width: 100%;
      text-align: start;
    }

    #errorText {
      color: red;
      font-family: Arial, Helvetica, sans-serif;
      width: 100%;
      text-align: start;
      margin-top: 2px;
      position: absolute;
      bottom: 0;
    }

    .bottomContent {
      position: relative;
      display: flex;
      height: 45px;
      width: 100%;
      margin-left: 10px;
    }
  </style>
</head>

<body>
  <div id="form-container">
    <svg enable-background="new 0 0 2039.9 2500" viewBox="0 0 2039.9 2500" xmlns="http://www.w3.org/2000/svg">
      <path clip-rule="evenodd" d="m1991.4 503.9-942 1934.3-1001.9-1284.1z" fill="#fff" fill-rule="evenodd" />
      <path
        d="m1019.9 0-1019.9 453.3v680c0 632.3 437.4 1223.9 1019.9 1366.7 588.2-143.9 1019.9-734.4 1019.9-1366.7v-680zm-226.6 1822.3-453.3-453.3 160.9-160.9 294.6 293.5 748-755.9 160.9 162.1z"
        fill="#4285f4" />
    </svg>
    <div class="contentForVerification">
      <h2>Verify Your Account</h2>
      <p>
        We emailed you the six digit code to
        <?php echo $emailaccount ?><br />
        Enter the code below to confirm your email address.
      </p>
    </div>

    <form action="./otpverify.php" method="post">
      <input type="number" name="otp" id="otp" placeholder="000000" />

      <button id="verifyButton" disabled name="verify">Verify</button>
    </form>
    <div class="bottomContent">
      <small class="info"> Thank you for register !!! </small>
      <small id="errorText"></small>
    </div>
  </div>

  <script>
    const otpInput = document.getElementById("otp");
    const verifyButton = document.getElementById("verifyButton");
    const errorText = document.getElementById("errorText");

    otpInput.addEventListener("input", () => {
      if (otpInput.value.length > 6) {
        otpInput.value = otpInput.value.slice(0, 6);
        errorText.textContent = "Maximum length is 6 characters.";
      } else {
        errorText.textContent = "";
      }

      if (otpInput.value.length === 6) {
        verifyButton.disabled = false;
      } else {
        verifyButton.disabled = true;
      }
    });

    verifyButton.addEventListener("click", (event) => {
      if (otpInput.value.length !== 6) {
        event.preventDefault();
        errorText.textContent = "Please enter a 6-digit code.";
      }
    });
  </script>

</body>

</html>