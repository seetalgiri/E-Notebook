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
  <div id="container">

    <div id="loginform">
      <form method="post" action="../../Server/Auth.php">
        <div id="inputfields">
          <h1>Register</h1>

          <div class="input-box">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M7.5 6.5C7.5 8.981 9.519 11 12 11C14.481 11 16.5 8.981 16.5 6.5C16.5 4.019 14.481 2 12 2C9.519 2 7.5 4.019 7.5 6.5ZM20 21H21V20C21 16.141 17.859 13 14 13H10C6.14 13 3 16.141 3 20V21H20Z" fill="black" fill-opacity="0.8" />
            </svg>
            <label for="name"></label>
            <input type="username" id="username" name="username" placeholder="Enter your username" />
          </div>

          <div class="input-box">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM19.6 8.25L12.53 12.67C12.21 12.87 11.79 12.87 11.47 12.67L4.4 8.25C4.29973 8.19371 4.21192 8.11766 4.14189 8.02645C4.07186 7.93525 4.02106 7.83078 3.99258 7.71937C3.96409 7.60796 3.9585 7.49194 3.97616 7.37831C3.99381 7.26468 4.03434 7.15581 4.09528 7.0583C4.15623 6.96079 4.23632 6.87666 4.33073 6.811C4.42513 6.74533 4.53187 6.69951 4.6445 6.6763C4.75712 6.65309 4.87328 6.65297 4.98595 6.67595C5.09863 6.69893 5.20546 6.74453 5.3 6.81L12 11L18.7 6.81C18.7945 6.74453 18.9014 6.69893 19.014 6.67595C19.1267 6.65297 19.2429 6.65309 19.3555 6.6763C19.4681 6.69951 19.5749 6.74533 19.6693 6.811C19.7637 6.87666 19.8438 6.96079 19.9047 7.0583C19.9657 7.15581 20.0062 7.26468 20.0238 7.37831C20.0415 7.49194 20.0359 7.60796 20.0074 7.71937C19.9789 7.83078 19.9281 7.93525 19.8581 8.02645C19.7881 8.11766 19.7003 8.19371 19.6 8.25Z" fill="black" />
            </svg>

            <label for="email"></label>
            <input type="email" id="email" name="email" placeholder="Enter your email" />
          </div>

          <div class="input-box">

            <svg width="18" height="18" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M5.03131 16.5313C4.13097 16.5311 3.24718 16.2893 2.47212 15.8311C1.69707 15.373 1.05916 14.7153 0.624928 13.9265C0.1907 13.1378 -0.0239325 12.2471 0.0034218 11.3471C0.0307761 10.4472 0.299115 9.57112 0.780444 8.81025C1.26177 8.04937 1.93846 7.4316 2.73991 7.02136C3.54136 6.61113 4.4382 6.42348 5.33689 6.47798C6.23558 6.53247 7.10318 6.82713 7.84918 7.3312C8.59519 7.83527 9.19226 8.53029 9.57812 9.34375H20.1251L22.2813 11.5L20.1251 13.6563L18.6876 12.2188L17.2501 13.6563L15.8126 12.2188L14.3751 13.6563L12.9376 12.2188L11.5001 13.6563H9.57812C9.17001 14.5166 8.5261 15.2435 7.72123 15.7525C6.91636 16.2614 5.98358 16.5314 5.03131 16.5313ZM3.59381 12.9375C3.97506 12.9375 4.34069 12.7861 4.61028 12.5165C4.87986 12.2469 5.03131 11.8812 5.03131 11.5C5.03131 11.1188 4.87986 10.7531 4.61028 10.4835C4.34069 10.214 3.97506 10.0625 3.59381 10.0625C3.21256 10.0625 2.84693 10.214 2.57734 10.4835C2.30776 10.7531 2.15631 11.1188 2.15631 11.5C2.15631 11.8812 2.30776 12.2469 2.57734 12.5165C2.84693 12.7861 3.21256 12.9375 3.59381 12.9375Z" fill="black" fill-opacity="0.8" />
            </svg>
            <label for="password"></label>
            <input type="password" id="password" name="password" placeholder="Enter your password" />
            <div class="password">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon" onclick="showPassword()">
                <path d="M10.5 8C10.5 8.66304 10.2366 9.29893 9.76777 9.76777C9.29893 10.2366 8.66304 10.5 8 10.5C7.33696 10.5 6.70107 10.2366 6.23223 9.76777C5.76339 9.29893 5.5 8.66304 5.5 8C5.5 7.33696 5.76339 6.70107 6.23223 6.23223C6.70107 5.76339 7.33696 5.5 8 5.5C8.66304 5.5 9.29893 5.76339 9.76777 6.23223C10.2366 6.70107 10.5 7.33696 10.5 8Z" fill="black" />
                <path d="M0 8C0 8 3 2.5 8 2.5C13 2.5 16 8 16 8C16 8 13 13.5 8 13.5C3 13.5 0 8 0 8ZM8 11.5C8.92826 11.5 9.8185 11.1313 10.4749 10.4749C11.1313 9.8185 11.5 8.92826 11.5 8C11.5 7.07174 11.1313 6.1815 10.4749 5.52513C9.8185 4.86875 8.92826 4.5 8 4.5C7.07174 4.5 6.1815 4.86875 5.52513 5.52513C4.86875 6.1815 4.5 7.07174 4.5 8C4.5 8.92826 4.86875 9.8185 5.52513 10.4749C6.1815 11.1313 7.07174 11.5 8 11.5Z" fill="black" fill-opacity="0.8" />
              </svg>
              <svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.37159 3.87481C8.08545 3.83974 7.79471 3.81963 7.5 3.81463C6.21219 3.82111 4.87721 4.17612 3.61359 4.85639C2.67536 5.38229 1.76143 6.12472 0.967713 7.04052C0.5779 7.50802 0.0803875 8.18494 0 8.90715C0.0095 9.53278 0.601913 10.305 0.967713 10.7738C1.712 11.6536 2.60214 12.3748 3.61359 12.9579C3.64796 12.9769 3.68246 12.9955 3.71704 13.014L2.77864 14.8712L4.0537 15.7253L10.9464 2.12483L9.71908 1.27472L8.37159 3.87481ZM11.282 4.80243L10.3454 6.64207C10.7763 7.27648 11.0321 8.05882 11.0321 8.90715C11.0321 11.0216 9.45058 12.7359 7.49908 12.7359C7.41471 12.7359 7.33295 12.7256 7.25005 12.7193L6.63024 13.9354C6.91609 13.9701 7.20511 13.9953 7.49999 13.9997C8.78903 13.9931 10.1233 13.634 11.3855 12.9579C12.3237 12.432 13.2386 11.6896 14.0323 10.7738C14.4221 10.3063 14.9196 9.6294 15 8.90715C14.9905 8.28154 14.3981 7.50934 14.0323 7.04051C13.288 6.16067 12.3969 5.43949 11.3855 4.85636C11.3514 4.83761 11.3164 4.82073 11.282 4.80243ZM7.49909 5.07844C7.58466 5.07844 7.66956 5.08232 7.7536 5.08881L7.02759 6.51343C6.00866 6.74754 5.24414 7.73006 5.24414 8.90613C5.24414 9.20157 5.29215 9.4844 5.38055 9.74657C5.38065 9.74687 5.38045 9.74732 5.38055 9.74762L4.6527 11.1764C4.22081 10.5414 3.96605 9.75647 3.96605 8.90714C3.96606 6.79269 5.5476 5.07843 7.49909 5.07844ZM9.6112 8.08227L7.97516 11.2947C8.98861 11.0562 9.74763 10.0781 9.74763 8.90613C9.74763 8.61609 9.69655 8.34033 9.6112 8.08227Z" fill="black" />
              </svg>
            </div>
          </div>

          <div class="input-box">
            <select name="stream" id="stream">
              <option value="all">All</option>
              <option value="bca">BCA</option>
              <option value="bbm">BBM</option>
              <option value="others">others</option>
            </select>
          </div>
          <p>Already have an account? <a href="./login.php">Login</a></p>

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