<?php
// Start session

include './admin/UserSessionData.php';



// Check if the logout button is clicked
if (isset($_POST['logoutBtn'])) {
    // Clear all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or any other desired location
    header("Location: index.php");
    exit();
}

?>
<nav class="shadow" id="navigation">
    <div id="logo">
        <a href="./">
            <img src="./Client/images/logo.png" alt="" />
        </a>
    </div>
    <div class="navsectionLink">
        <ul id="MainNav">
            <li class="navLinks index active"><a href="./index.php">News</a></li>
            <li class="navLinks notes"><a href="./notes.php">Notes</a></li>
            <li class="navLinks syllabus">
                <a href="./syllabus.php">Syllabus</a>
            </li>
            <li class="navLinks previousquestions">
                <a href="./previousquestions.php">Question Papers</a>
            </li>
        </ul>
        <div id="user" class="login">

            <!-- ======================================== for login button ======================================== -->
            <?php
            echo $id < 1 ? '<a href="./auth/login.php" style="margin-right: -20px;">
        <button class="shadow-lg">
            <span> Login </span>
            <svg width="15" height="18" viewBox="0 0 16 20" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8 15.2381C8.53043 15.2381 9.03914 15.0374 9.41421 14.6802C9.78929 14.323 10 13.8385 10 13.3333C10 12.2762 9.1 11.4286 8 11.4286C7.46957 11.4286 6.96086 11.6293 6.58579 11.9865C6.21071 12.3437 6 12.8282 6 13.3333C6 13.8385 6.21071 14.323 6.58579 14.6802C6.96086 15.0374 7.46957 15.2381 8 15.2381ZM14 6.66667C14.5304 6.66667 15.0391 6.86735 15.4142 7.22456C15.7893 7.58177 16 8.06625 16 8.57143V18.0952C16 18.6004 15.7893 19.0849 15.4142 19.4421C15.0391 19.7993 14.5304 20 14 20H2C1.46957 20 0.960859 19.7993 0.585786 19.4421C0.210714 19.0849 0 18.6004 0 18.0952V8.57143C0 7.51429 0.9 6.66667 2 6.66667H3V4.7619C3 3.49897 3.52678 2.28776 4.46447 1.39473C5.40215 0.501699 6.67392 0 8 0C8.65661 0 9.30679 0.12317 9.91342 0.362478C10.52 0.601787 11.0712 0.952546 11.5355 1.39473C11.9998 1.83691 12.3681 2.36186 12.6194 2.9396C12.8707 3.51734 13 4.13656 13 4.7619V6.66667H14ZM8 1.90476C7.20435 1.90476 6.44129 2.20578 5.87868 2.7416C5.31607 3.27742 5 4.00414 5 4.7619V6.66667H11V4.7619C11 4.00414 10.6839 3.27742 10.1213 2.7416C9.55871 2.20578 8.79565 1.90476 8 1.90476Z" />
            </svg>
        </button>
    </a>' : '<div class="profileCls topProfileDesktop" id="profileMainContainer">
    <svg onclick="openProfileModal()" id="adminProfile22" width="35" height="40" viewBox="0 0 21 21"
        xmlns="http://www.w3.org/2000/svg">
        <path
            d="M10.4091 17.5812C7.9091 17.5812 5.6991 16.3012 4.4091 14.3812C4.4391 12.3812 8.4091 11.2812 10.4091 11.2812C12.4091 11.2812 16.3791 12.3812 16.4091 14.3812C15.1191 16.3012 12.9091 17.5812 10.4091 17.5812ZM10.4091 3.38123C11.2048 3.38123 11.9678 3.6973 12.5304 4.25991C13.093 4.82251 13.4091 5.58558 13.4091 6.38123C13.4091 7.17688 13.093 7.93994 12.5304 8.50255C11.9678 9.06516 11.2048 9.38123 10.4091 9.38123C9.61345 9.38123 8.85039 9.06516 8.28778 8.50255C7.72517 7.93994 7.4091 7.17688 7.4091 6.38123C7.4091 5.58558 7.72517 4.82251 8.28778 4.25991C8.85039 3.6973 9.61345 3.38123 10.4091 3.38123ZM10.4091 0.381226C9.09588 0.381226 7.79552 0.639883 6.58227 1.14243C5.36901 1.64498 4.26662 2.38157 3.33804 3.31016C1.46267 5.18552 0.409103 7.72906 0.409103 10.3812C0.409103 13.0334 1.46267 15.5769 3.33804 17.4523C4.26662 18.3809 5.36901 19.1175 6.58227 19.62C7.79552 20.1226 9.09588 20.3812 10.4091 20.3812C13.0613 20.3812 15.6048 19.3277 17.4802 17.4523C19.3555 15.5769 20.4091 13.0334 20.4091 10.3812C20.4091 4.85123 15.9091 0.381226 10.4091 0.381226Z" />
    </svg>
    <div id="profilecards" class="shadow-lg">
        <div id="cmtuserDet">
            <div id="userPost">' . ucfirst(substr($username, 0, 1)) . '</div>
            <div id="userNameAndDate">
                <span>' . $username . '</span>
                <span>' . $email . '</span>
            </div>
        </div>
        <div id="streamprofile"><span>Stream:</span><span style="text-transform: uppercase;">' . $stream . '</span></div>
            <form method="POST" action="" class="logoutbtn">
                <button type="submit" name="logoutBtn">LOGOUT</button>
            </form>';

            if (intval($privilege) < 2) {
                echo '<a href="./admin/dashboard.php" class="logoutbtn">
            <button type="submit" name="logoutBtn">DASHBOARD</button>
        </a>';
            }
            echo '</div>
</div>';

            ?>


            <!-- ======================================== for user profile ======================================== -->
            <!--  -->
        </div>
    </div>
    <div id="hamburgerNav">
        <div class="LinesNav"></div>
        <div class="LinesNav"></div>
        <div class="LinesNav"></div>
    </div>
    <div class="navCloseDIv"></div>
    <div class='Mode' id='toggleMode'></div>

    <!-- ======================================== for user profile11. ======================================== -->
    <?php
    echo $id >= 1 ? '
    <div class="profileCls topProfilemobile" id="profileMainContainer">
        <svg onclick="openProfileModal()" id="adminProfile22" width="35" height="40" viewBox="0 0 21 21"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M10.4091 17.5812C7.9091 17.5812 5.6991 16.3012 4.4091 14.3812C4.4391 12.3812 8.4091 11.2812 10.4091 11.2812C12.4091 11.2812 16.3791 12.3812 16.4091 14.3812C15.1191 16.3012 12.9091 17.5812 10.4091 17.5812ZM10.4091 3.38123C11.2048 3.38123 11.9678 3.6973 12.5304 4.25991C13.093 4.82251 13.4091 5.58558 13.4091 6.38123C13.4091 7.17688 13.093 7.93994 12.5304 8.50255C11.9678 9.06516 11.2048 9.38123 10.4091 9.38123C9.61345 9.38123 8.85039 9.06516 8.28778 8.50255C7.72517 7.93994 7.4091 7.17688 7.4091 6.38123C7.4091 5.58558 7.72517 4.82251 8.28778 4.25991C8.85039 3.6973 9.61345 3.38123 10.4091 3.38123ZM10.4091 0.381226C9.09588 0.381226 7.79552 0.639883 6.58227 1.14243C5.36901 1.64498 4.26662 2.38157 3.33804 3.31016C1.46267 5.18552 0.409103 7.72906 0.409103 10.3812C0.409103 13.0334 1.46267 15.5769 3.33804 17.4523C4.26662 18.3809 5.36901 19.1175 6.58227 19.62C7.79552 20.1226 9.09588 20.3812 10.4091 20.3812C13.0613 20.3812 15.6048 19.3277 17.4802 17.4523C19.3555 15.5769 20.4091 13.0334 20.4091 10.3812C20.4091 4.85123 15.9091 0.381226 10.4091 0.381226Z" />
        </svg>
        <div id="profilecards" class="shadow-lg">
            <div id="cmtuserDet">
            <div id="userPost">' . ucfirst(substr($username, 0, 1)) . '</div>
            <div id="userNameAndDate">
                <span>' . $username . '</span>
                <span>' . $email . '</span>
            </div>
            </div>
            <div id="streamprofile"><span>Stream:</span><span style="text-transform: uppercase;">' . $stream . '</span></div>
            <form method="POST" action="" class="logoutbtn">
            <button type="submit" name="logoutBtn">LOGOUT</button>
        </form>
        </div>
    </div>' : '';
    ?>
</nav>
<div id="modalCLoseDIvOutside"></div>
<script>
    var navLinks = document.getElementsByTagName("a");
    const currentUrl = window.location.href;
    const currentPage = currentUrl.substr(currentUrl.lastIndexOf('/') + 1).split('?')[0];
    const clsPage = currentPage.split(".")[0]


    const classes = document.querySelectorAll(".navLinks");
    classes[0].classList.add("active");
    if (clsPage.length > 1) {
        for (let i = 0; i < classes.length; i++) {
            if (classes[i].classList.contains(clsPage)) {
                classes[i].classList.add("active");
            } else {
                classes[i].classList.remove("active");
            }
        }
    }

    const hamburgerNav = document.getElementById("hamburgerNav");
    const navsectionLink = document.querySelector(".navsectionLink");
    const navCloseDIv = document.querySelector(".navCloseDIv");
    const adminProfile22 = document.getElementById("adminProfile22");
    const profilecards = document.getElementById("profilecards");
    const modalCLoseDIvOutside = document.getElementById("modalCLoseDIvOutside");

    const openProfileModal = () => {
        if (profilecards.style.display == "none" || profilecards.style.display == "") {
            profilecards.style.display = "block";
            modalCLoseDIvOutside.style.display = "block";
            document.body.style.overflow = "hidden";
        } else {
            profilecards.style.display = "none";
            modalCLoseDIvOutside.style.display = "none";
            document.body.style.overflow = "auto";
        }
    }
    modalCLoseDIvOutside.addEventListener("click", () => {
        profilecards.style.display = "none";
        modalCLoseDIvOutside.style.display = "none";
        document.body.style.overflow = "auto";
    });


    navsectionLink.style.right = "-120%";
    const navToggleFuction = () => {
        if (navsectionLink.style.right === "-120%") {
            navsectionLink.style.right = "0px";
            navsectionLink.style.paddingBottom = "10vh";
            hamburgerNav.classList.add("crossNav");
            navCloseDIv.style.display = "block";
        } else {
            navsectionLink.style.right = "-120%";
            hamburgerNav.classList.remove("crossNav");
            navCloseDIv.style.display = "none";
        }
    };

    hamburgerNav.addEventListener("click", () => {
        navToggleFuction();
    });

    navCloseDIv.addEventListener("click", () => {
        navToggleFuction();
    });


    const bodyMode = document.getElementsByTagName('body')[0];
    const toggleMode = document.getElementById('toggleMode')


    const LightHTML = `<div id='eachModeLight' class="light eachmode">
            <svg onclick="modeClick()" width="22" height="22" viewBox="0 0 22 22" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M2.55 18.09L3.96 19.5L5.76 17.71L4.34 16.29M11 5C7.69 5 5 7.69 5 11C5 14.31 7.69 17 11 17C14.31 17 17 14.31 17 11C17 7.68 14.31 5 11 5ZM19 12H22V10H19M16.24 17.71L18.04 19.5L19.45 18.09L17.66 16.29M19.45 4L18.04 2.6L16.24 4.39L17.66 5.81M12 0H10V3H12M5.76 4.39L3.96 2.6L2.55 4L4.34 5.81L5.76 4.39ZM0 12H3V10H0M12 19H10V22H12"
                    fill="orange" />
            </svg>
            <div class="hoverMode">Light Mode</div>
        </div>`
    const DarkHTML = `<div id='eachModeDark' class="dark eachmode">
        <svg onclick="modeClick()" width="20" height="22" viewBox="0 0 20 22" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M16.3608 3.64627L13.8308 5.58627L14.7408 8.64627L12.1108 6.83627L9.48079 8.64627L10.3908 5.58627L7.86079 3.64627L11.0508 3.55627L12.1108 0.556274L13.1708 3.55627L16.3608 3.64627ZM19.8608 10.5563L18.2208 11.8063L18.8108 13.7863L17.1108 12.6163L15.4108 13.7863L16.0008 11.8063L14.3608 10.5563L16.4208 10.5063L17.1108 8.55627L17.8008 10.5063L19.8608 10.5563ZM17.5808 15.5063C18.4108 15.4263 19.3008 16.6063 18.7708 17.3563C18.4508 17.8063 18.1108 18.2263 17.6908 18.6263C13.7808 22.5563 7.45079 22.5563 3.55079 18.6263C-0.359214 14.7263 -0.359214 8.38627 3.55079 4.48627C3.95079 4.08627 4.37079 3.72627 4.82079 3.40627C5.57079 2.87627 6.75079 3.76627 6.67079 4.59627C6.40079 7.45627 7.36079 10.4263 9.56079 12.6163C11.7508 14.8163 14.7108 15.7763 17.5808 15.5063ZM15.9408 17.5263C13.1108 17.3663 10.3108 16.1963 8.14079 14.0563C5.97079 11.8663 4.81079 9.05627 4.65079 6.23627C1.84079 9.37627 1.95079 14.1963 4.96079 17.2163C7.98079 20.2263 12.8008 20.3363 15.9408 17.5263Z"
                fill="#000b32d4" />
        </svg>
        <div class="hoverMode">Dark Mode</div>
    </div>`


    if (localStorage.getItem('mode') === 'dark') {
        bodyMode.classList.add('Darkmode');
        toggleMode.innerHTML = LightHTML
    } else {
        bodyMode.classList.remove('Darkmode');
        toggleMode.innerHTML = DarkHTML
    }
    // for dark and light mode
    const modeClick = () => {
        if (localStorage.getItem('mode') === 'dark') {
            toggleMode.innerHTML = DarkHTML
            bodyMode.classList.remove('Darkmode');
            localStorage.setItem('mode', 'light');
        } else {
            toggleMode.innerHTML = LightHTML
            bodyMode.classList.add('Darkmode');
            localStorage.setItem('mode', 'dark');
        }
    }
    window.addEventListener("scroll", () => {
        let scrollY = Math.ceil(window.scrollY || window.pageYOffset);
        if (scrollY > 140) {
            toggleMode.style.right = "-100px"
            toggleMode.style.opacity = "0"

        } else {
            toggleMode.style.right = "0px"
            toggleMode.style.opacity = "1"

        }
    });
</script>