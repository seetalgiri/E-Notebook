<?php
$con = mysqli_connect("localhost", "root", "", "bibak");
if (!$con) {
    die("Database connection failed");
}

// check btn is clicked or not for connect

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // fetch data from db and check if password and email are correct
    $sql = "SELECT * FROM `auth` WHERE `email` = '$email'";
    $rowEmail = mysqli_query($con, $sql);
    if (mysqli_num_rows($rowEmail) > 0) {
        $userdata = mysqli_fetch_assoc($rowEmail);
        // check text password and hash password are correct
        if (password_verify($password, $userdata['password'])) {
            // set header to index.php
            header("Location: ../../index.php");
        } else {
            echo "password incorrect";
        }
    } else {
        echo "user not found";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration form</title>
    <link rel="stylesheet" href="../Client/styles/global.css" />
    <link rel="stylesheet" href="../Client/styles/login.css" />
</head>

<body>
    <div id="container">
        <div id="loginform">
            <form method="post" class="shadow" action="../../Server/Auth.php">
                <div id="inputfields">
                    <h3 id="login">Login</h3>
                    <div class="input-box">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" />
                        <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM19.6 8.25L12.53 12.67C12.21 12.87 11.79 12.87 11.47 12.67L4.4 8.25C4.29973 8.19371 4.21192 8.11766 4.14189 8.02645C4.07186 7.93525 4.02106 7.83078 3.99258 7.71937C3.96409 7.60796 3.9585 7.49194 3.97616 7.37831C3.99381 7.26468 4.03434 7.15581 4.09528 7.0583C4.15623 6.96079 4.23632 6.87666 4.33073 6.811C4.42513 6.74533 4.53187 6.69951 4.6445 6.6763C4.75712 6.65309 4.87328 6.65297 4.98595 6.67595C5.09863 6.69893 5.20546 6.74453 5.3 6.81L12 11L18.7 6.81C18.7945 6.74453 18.9014 6.69893 19.014 6.67595C19.1267 6.65297 19.2429 6.65309 19.3555 6.6763C19.4681 6.69951 19.5749 6.74533 19.6693 6.811C19.7637 6.87666 19.8438 6.96079 19.9047 7.0583C19.9657 7.15581 20.0062 7.26468 20.0238 7.37831C20.0415 7.49194 20.0359 7.60796 20.0074 7.71937C19.9789 7.83078 19.9281 7.93525 19.8581 8.02645C19.7881 8.11766 19.7003 8.19371 19.6 8.25Z" />
                        </svg>
                    </div>
                    <div class="input-box">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" />
                        <div class="password">
                            <svg id="showIcon" width="17" height="17" viewBox="0 0 16 16"
                                xmlns="http://www.w3.org/2000/svg" onclick="eyeOpen()">
                                <path
                                    d="M10.5 8C10.5 8.66304 10.2366 9.29893 9.76777 9.76777C9.29893 10.2366 8.66304 10.5 8 10.5C7.33696 10.5 6.70107 10.2366 6.23223 9.76777C5.76339 9.29893 5.5 8.66304 5.5 8C5.5 7.33696 5.76339 6.70107 6.23223 6.23223C6.70107 5.76339 7.33696 5.5 8 5.5C8.66304 5.5 9.29893 5.76339 9.76777 6.23223C10.2366 6.70107 10.5 7.33696 10.5 8Z" />
                                <path
                                    d="M0 8C0 8 3 2.5 8 2.5C13 2.5 16 8 16 8C16 8 13 13.5 8 13.5C3 13.5 0 8 0 8ZM8 11.5C8.92826 11.5 9.8185 11.1313 10.4749 10.4749C11.1313 9.8185 11.5 8.92826 11.5 8C11.5 7.07174 11.1313 6.1815 10.4749 5.52513C9.8185 4.86875 8.92826 4.5 8 4.5C7.07174 4.5 6.1815 4.86875 5.52513 5.52513C4.86875 6.1815 4.5 7.07174 4.5 8C4.5 8.92826 4.86875 9.8185 5.52513 10.4749C6.1815 11.1313 7.07174 11.5 8 11.5Z"
                                    fill-opacity="0.8" />
                            </svg>
                            <svg id="hideIcon" width="17" height="18" viewBox="0 0 15 17"
                                xmlns="http://www.w3.org/2000/svg" onclick="eyeClose()">
                                <path
                                    d="M8.37159 3.87481C8.08545 3.83974 7.79471 3.81963 7.5 3.81463C6.21219 3.82111 4.87721 4.17612 3.61359 4.85639C2.67536 5.38229 1.76143 6.12472 0.967713 7.04052C0.5779 7.50802 0.0803875 8.18494 0 8.90715C0.0095 9.53278 0.601913 10.305 0.967713 10.7738C1.712 11.6536 2.60214 12.3748 3.61359 12.9579C3.64796 12.9769 3.68246 12.9955 3.71704 13.014L2.77864 14.8712L4.0537 15.7253L10.9464 2.12483L9.71908 1.27472L8.37159 3.87481ZM11.282 4.80243L10.3454 6.64207C10.7763 7.27648 11.0321 8.05882 11.0321 8.90715C11.0321 11.0216 9.45058 12.7359 7.49908 12.7359C7.41471 12.7359 7.33295 12.7256 7.25005 12.7193L6.63024 13.9354C6.91609 13.9701 7.20511 13.9953 7.49999 13.9997C8.78903 13.9931 10.1233 13.634 11.3855 12.9579C12.3237 12.432 13.2386 11.6896 14.0323 10.7738C14.4221 10.3063 14.9196 9.6294 15 8.90715C14.9905 8.28154 14.3981 7.50934 14.0323 7.04051C13.288 6.16067 12.3969 5.43949 11.3855 4.85636C11.3514 4.83761 11.3164 4.82073 11.282 4.80243ZM7.49909 5.07844C7.58466 5.07844 7.66956 5.08232 7.7536 5.08881L7.02759 6.51343C6.00866 6.74754 5.24414 7.73006 5.24414 8.90613C5.24414 9.20157 5.29215 9.4844 5.38055 9.74657C5.38065 9.74687 5.38045 9.74732 5.38055 9.74762L4.6527 11.1764C4.22081 10.5414 3.96605 9.75647 3.96605 8.90714C3.96606 6.79269 5.5476 5.07843 7.49909 5.07844ZM9.6112 8.08227L7.97516 11.2947C8.98861 11.0562 9.74763 10.0781 9.74763 8.90613C9.74763 8.61609 9.69655 8.34033 9.6112 8.08227Z" />
                            </svg>
                        </div>
                    </div>
                    <p class="dontHaveAcc">Don't have an account, <a href="./register.php">Signup?</a></p>
                    <p class="dontHaveAcc gobackHw">Don't Want Login, <a href="/e_notebook/index.php">Go Back?</a></p>
                    </p>

                    <button type="submit" name="login">Login</button>
                </div>
            </form>
        </div>
    </div>
    <script>
    const password = document.getElementById("password");
    const hideIcon = document.getElementById("hideIcon");
    const showIcon = document.getElementById("showIcon");

    const eyeOpen = () => {
        showIcon.style.display = "none";
        hideIcon.style.display = "block";
        password.setAttribute("type", "password");
    }
    const eyeClose = () => {
        showIcon.style.display = "block";
        hideIcon.style.display = "none";
        password.setAttribute("type", "text");
    }
    const bodyMode = document.getElementsByTagName('body')[0];

    if (localStorage.getItem('mode') === 'dark') {
        bodyMode.classList.add('Darkmode');
    } else {
        bodyMode.classList.remove('Darkmode');
    }
    </script>
</body>

</html>