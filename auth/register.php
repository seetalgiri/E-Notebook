<?php
if (isset($_GET['error'])) {
    echo '<div class="fullcontainerToast">
    <div class="toastifier">
        <div class="toastifierContent errorToast ">
        <div class="cross" onclick="crossClk()">X</div>

        <div class="innercontent">
            <!-- <svg
            width="16"
            height="16"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
            >
            <path
                d="M10 0C4.5 0 0 4.5 0 10C0 15.5 4.5 20 10 20C15.5 20 20 15.5 20 10C20 4.5 15.5 0 10 0ZM8 15L3 10L4.41 8.59L8 12.17L15.59 4.58L17 6L8 15Z"
            />
            </svg> -->

            <svg
            width="16"
            height="16"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
            >
            <path
                d="M10 0C15.53 0 20 4.47 20 10C20 15.53 15.53 20 10 20C4.47 20 0 15.53 0 10C0 4.47 4.47 0 10 0ZM13.59 5L10 8.59L6.41 5L5 6.41L8.59 10L5 13.59L6.41 15L10 11.41L13.59 15L15 13.59L11.41 10L15 6.41L13.59 5Z"
            />
            </svg>

            <span> ' . $_GET['error'] . '</span>
        </div>
            </div>
        </div>
    </div>';
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// getting user value from sesstion
if (isset($_SESSION['id'])) {
    header('Location: ../index.php');
}


// importaing configurations 
include '../Configuration.php';

//database connection
$con = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);

if (!$con) {
    die("Database connection failed");
}

// to show all data in frontend
$sql = "SELECT * FROM `faculty`";
$resfac = mysqli_query($con, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration form</title>
    <link rel="stylesheet" href="../Client/styles/global.css" />
    <link rel="stylesheet" href="../Client/styles/logins.css" />

</head>

<body>
    <div id="container" class="regCont">
        <div class="rightDiv">
            <h1>E-NoteBook</h1>
            <p style="letter-spacing: 2px">Unlock Knowledge, Ace Your Journey: eNotebook - Your Gateway to Comprehensive
                Notes and Study Material.
            </p>
        </div>

        <div id="socialmedia">
            <div class="longLine"></div>
            <div id="Facebook" class="icons">
                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20 14.19C20 17.83 17.83 20 14.19 20H13C12.45 20 12 19.55 12 19V13.23C12 12.96 12.22 12.73 12.49 12.73L14.25 12.7C14.39 12.69 14.51 12.59 14.54 12.45L14.89 10.54C14.8968 10.4967 14.8941 10.4525 14.8822 10.4103C14.8702 10.3681 14.8492 10.3291 14.8207 10.2958C14.7922 10.2625 14.7568 10.2358 14.717 10.2176C14.6771 10.1993 14.6338 10.1899 14.59 10.19L12.46 10.22C12.18 10.22 11.96 10 11.95 9.73L11.91 7.28C11.91 7.12 12.04 6.98 12.21 6.98L14.61 6.94C14.78 6.94 14.91 6.81 14.91 6.64L14.87 4.24C14.87 4.07 14.74 3.94 14.57 3.94L11.87 3.98C11.4759 3.98599 11.0868 4.06969 10.725 4.22632C10.3633 4.38295 10.0361 4.60942 9.76201 4.89276C9.48796 5.1761 9.27252 5.51073 9.12803 5.87748C8.98354 6.24422 8.91285 6.63588 8.92 7.03L8.97 9.78C8.98 10.06 8.76 10.28 8.48 10.29L7.28 10.31C7.11 10.31 6.98 10.44 6.98 10.61L7.01 12.51C7.01 12.68 7.14 12.81 7.31 12.81L8.51 12.79C8.79 12.79 9.01 13.01 9.02 13.28L9.11 18.98C9.12 19.54 8.67 20 8.11 20H5.81C2.17 20 0 17.83 0 14.18V5.81C0 2.17 2.17 0 5.81 0H14.19C17.83 0 20 2.17 20 5.81V14.19Z" />
                </svg>
            </div>
            <div class=" shortLine">
            </div>
            <div id="Email" class="icons">
                <svg width="20" height="20" viewBox="0 0 20 16" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M18 4L10 9L2 4V2L10 7L18 2M18 0H2C0.89 0 0 0.89 0 2V14C0 14.5304 0.210714 15.0391 0.585786 15.4142C0.960859 15.7893 1.46957 16 2 16H18C18.5304 16 19.0391 15.7893 19.4142 15.4142C19.7893 15.0391 20 14.5304 20 14V2C20 0.89 19.1 0 18 0Z" />
                </svg>
            </div>
            <div class=" shortLine">
            </div>
            <div id="Linkedin" class="icons">
                <svg width="20" height="20" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M16 0C16.5304 0 17.0391 0.210714 17.4142 0.585786C17.7893 0.960859 18 1.46957 18 2V16C18 16.5304 17.7893 17.0391 17.4142 17.4142C17.0391 17.7893 16.5304 18 16 18H2C1.46957 18 0.960859 17.7893 0.585786 17.4142C0.210714 17.0391 0 16.5304 0 16V2C0 1.46957 0.210714 0.960859 0.585786 0.585786C0.960859 0.210714 1.46957 0 2 0H16ZM15.5 15.5V10.2C15.5 9.33539 15.1565 8.5062 14.5452 7.89483C13.9338 7.28346 13.1046 6.94 12.24 6.94C11.39 6.94 10.4 7.46 9.92 8.24V7.13H7.13V15.5H9.92V10.57C9.92 9.8 10.54 9.17 11.31 9.17C11.6813 9.17 12.0374 9.3175 12.2999 9.58005C12.5625 9.8426 12.71 10.1987 12.71 10.57V15.5H15.5ZM3.88 5.56C4.32556 5.56 4.75288 5.383 5.06794 5.06794C5.383 4.75288 5.56 4.32556 5.56 3.88C5.56 2.95 4.81 2.19 3.88 2.19C3.43178 2.19 3.00193 2.36805 2.68499 2.68499C2.36805 3.00193 2.19 3.43178 2.19 3.88C2.19 4.81 2.95 5.56 3.88 5.56ZM5.27 15.5V7.13H2.5V15.5H5.27Z" />
                </svg>
            </div>
            <div class=" shortLine">
            </div>
            <div id="Instagram" class="icons">
                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M14.19 0H5.81C2.17 0 0 2.17 0 5.81V14.18C0 17.83 2.17 20 5.81 20H14.18C17.82 20 19.99 17.83 19.99 14.19V5.81C20 2.17 17.83 0 14.19 0ZM10 13.88C7.86 13.88 6.12 12.14 6.12 10C6.12 7.86 7.86 6.12 10 6.12C12.14 6.12 13.88 7.86 13.88 10C13.88 12.14 12.14 13.88 10 13.88ZM15.92 4.88C15.87 5 15.8 5.11 15.71 5.21C15.61 5.3 15.5 5.37 15.38 5.42C15.198 5.49725 14.9971 5.51853 14.803 5.48113C14.6089 5.44372 14.4303 5.34933 14.29 5.21C14.2 5.11 14.13 5 14.08 4.88C14.0286 4.75982 14.0015 4.63069 14 4.5C14 4.37 14.03 4.24 14.08 4.12C14.13 3.99 14.2 3.89 14.29 3.79C14.52 3.56 14.87 3.45 15.19 3.52C15.26 3.53 15.32 3.55 15.38 3.58C15.44 3.6 15.5 3.63 15.56 3.67C15.61 3.7 15.66 3.75 15.71 3.79C15.8 3.89 15.87 3.99 15.92 4.12C15.97 4.24 16 4.37 16 4.5C16 4.63 15.97 4.76 15.92 4.88Z" />
                </svg>

            </div>
            <div class=" longLine">
            </div>
        </div>
        <div id="loginform">
            <form method="post" class="shadow" action="../Server/auths.php">
                <div id="inputfields" class="register">
                    <h3 id="login">Register</h3>
                    <div class="input-box">
                        <label for="Username">Username</label>
                        <input type="text" id="Username" name="username" placeholder="Enter your Username"
                            autocomplete="off" />
                        <svg width="16" height="16" viewBox="0 0 17 17" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.30737 0.443001C9.36824 0.443001 10.3857 0.864428 11.1358 1.61457C11.8859 2.36472 12.3074 3.38213 12.3074 4.443C12.3074 5.50387 11.8859 6.52128 11.1358 7.27143C10.3857 8.02157 9.36824 8.443 8.30737 8.443C7.24651 8.443 6.22909 8.02157 5.47895 7.27143C4.7288 6.52128 4.30737 5.50387 4.30737 4.443C4.30737 3.38213 4.7288 2.36472 5.47895 1.61457C6.22909 0.864428 7.24651 0.443001 8.30737 0.443001ZM8.30737 10.443C12.7274 10.443 16.3074 12.233 16.3074 14.443V16.443H0.307373V14.443C0.307373 12.233 3.88737 10.443 8.30737 10.443Z" />
                        </svg>
                    </div>
                    <span id="nameError" class="error regErr"></span>


                    <div class="input-box">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" autocomplete="off" />
                        <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM19.6 8.25L12.53 12.67C12.21 12.87 11.79 12.87 11.47 12.67L4.4 8.25C4.29973 8.19371 4.21192 8.11766 4.14189 8.02645C4.07186 7.93525 4.02106 7.83078 3.99258 7.71937C3.96409 7.60796 3.9585 7.49194 3.97616 7.37831C3.99381 7.26468 4.03434 7.15581 4.09528 7.0583C4.15623 6.96079 4.23632 6.87666 4.33073 6.811C4.42513 6.74533 4.53187 6.69951 4.6445 6.6763C4.75712 6.65309 4.87328 6.65297 4.98595 6.67595C5.09863 6.69893 5.20546 6.74453 5.3 6.81L12 11L18.7 6.81C18.7945 6.74453 18.9014 6.69893 19.014 6.67595C19.1267 6.65297 19.2429 6.65309 19.3555 6.6763C19.4681 6.69951 19.5749 6.74533 19.6693 6.811C19.7637 6.87666 19.8438 6.96079 19.9047 7.0583C19.9657 7.15581 20.0062 7.26468 20.0238 7.37831C20.0415 7.49194 20.0359 7.60796 20.0074 7.71937C19.9789 7.83078 19.9281 7.93525 19.8581 8.02645C19.7881 8.11766 19.7003 8.19371 19.6 8.25Z" />
                        </svg>
                    </div>
                    <span id="emailError" class="error regErr"></span>

                    <div class="input-box">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password"
                            autocomplete="off" />
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
                    <span id="passwordError" class="error regErr"></span>

                    <p class="dontHaveAcc">Already have account, <a href="./login.php">Login?</a></p>
                    <p class="dontHaveAcc gobackHwRg">Don't Want Register, <a href="/e_notebook/index.php">Go Back?</a>
                    </p>

                    <button type="submit" name="register">Signup</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const password = document.getElementById("password");
        const hideIcon = document.getElementById("hideIcon");
        const showIcon = document.getElementById("showIcon");
        // for client side validation 
        const nameInput = document.getElementById("Username");
        const emailInput = document.getElementById("email");

        const emailError = document.getElementById("emailError");
        const nameError = document.getElementById("nameError");
        const passowrdError = document.getElementById("passwordError");

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

        const nameValidation = () => {
            if (nameInput.value.trim() === "") {
                nameError.textContent = "Name is required.";
                nameError.style.display = "block";
                return false;
            } else {
                nameError.style.display = "none";
                return true;
            }
        };
        const passwordValidation = () => {
            if (password.value.trim() === "") {
                passowrdError.textContent = "Password is required.";
                passowrdError.style.display = "block";
                return false;
            }
            else if (password.value.trim().length <= 6) {
                passowrdError.textContent = "Password must be greater than 6 character.";
                passowrdError.style.display = "block";
                return false;
            }
            else {
                passowrdError.style.display = "none";
                return true;
            }
        };

        const emailValidation = () => {
            const email = emailInput.value.trim();
            const emailRegex = /^\S+@\S+\.\S+$/;
            if (email === "") {
                emailError.textContent = "Email is required.";
                emailError.style.display = "block";
                return false;
            } else if (!emailRegex.test(email)) {
                emailError.textContent = "Invalid email format.";
                emailError.style.display = "block";
                return false;
            } else {
                emailError.style.display = "none";
                return true;
            }
        };
        // Validate name field
        password.addEventListener("input", () => passwordValidation());
        // Validate name field
        nameInput.addEventListener("input", () => nameValidation());
        // Validate email field
        emailInput.addEventListener("input", () => emailValidation());

        const form = document.querySelector("form");
        form.addEventListener("submit", function (event) {
            nameValidation();
            passwordValidation();

            if (!emailValidation() || !nameValidation() || !passwordValidation()) {
                event.preventDefault();
            } else {
                return true;
            }
        });
        const fullcontainerToast = document.querySelectorAll(".fullcontainerToast");
        setTimeout(() => {
            for (let i = 0; i < fullcontainerToast.length; i++) {
                fullcontainerToast[i].style.right = "0px";
            }
        }, 200);
        setInterval(() => {
            closeModal(); // Call the closeModal function
        }, 2000);
        const crossClk = () => {
            closeModal(); // Call the closeModal function
        };

        const closeModal = () => {
            for (let i = 0; i < fullcontainerToast.length; i++) {
                fullcontainerToast[i].style.right = "-700px";
                window.location.reload();
            }
        };
        if (window.location.search.includes('error')) {
            // Remove the 'error' parameter from the URL without refreshing the page
            history.replaceState({}, document.title, window.location.pathname);
        }
    </script>

</body>

</html>