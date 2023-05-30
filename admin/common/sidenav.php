<?php
// checking if user is admin/superadmin or not
function goHome()
{
    header("Location: ../index.php");
    exit();
}
if (isset($_SESSION['privilege'])) {
    $privilege = intval($_SESSION['privilege']);
} else {
    goHome();
}

if ($privilege > 1) {
    goHome();
}

?>

<div id="navigations">
    <nav id="sidenav">
        <div id="mainham">
            <div id="hamburger" onclick="hambarclk()">
                <div class="div3 hamdivs"></div>
                <div class="div2 hamdivs"></div>
                <div class="div1 hamdivs"></div>
            </div>
        </div>
        <div id="sidnavLine"></div>
        <div id="sidelinks">
            <ul id="sideNavLikes">
                <div class="sidnavLine"></div>
                <li class="lists listItems listWidth">
                    <a href="dashboard.php">
                        <div class="listName">
                            Dashboard
                        </div>
                        <div class="addressTracker dashboard "></div>
                        <svg width="28" height="28" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.25 3.75V11.25H26.25V3.75M16.25 26.25H26.25V13.75H16.25M3.75 26.25H13.75V18.75H3.75M3.75 16.25H13.75V3.75H3.75V16.25Z" />
                        </svg>
                    </a>
                    <div class="addressTracker1">
                        <p>Dashboard</p>
                    </div>
                </li>
                <div class="sidnavLine"></div>
                <li class="lists listItems">
                    <a href="faculty.php">
                        <div class="listName">
                            Faculty
                        </div>
                        <div class="addressTracker faculty"></div>
                        <svg width="28" height="28" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 3.75L1.25 11.25L15 18.75L26.25 12.6125V21.25H28.75V11.25M6.25 16.475V21.475L15 26.25L23.75 21.475V16.475L15 21.25L6.25 16.475Z" />
                        </svg>
                    </a>
                    <div class="addressTracker1">
                        <p>Faculty</p>
                    </div>
                </li>
                <div class="sidnavLine"></div>
                <li class="lists listItems">
                    <a href="subjectname.php">
                        <div class="listName">
                            Subject Name
                        </div>
                        <div class="addressTracker subjectname"></div>
                        <svg width="28" height="28" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.025 21.25L16.25 24.1V27.5H7.5C6.1125 27.5 5 26.3875 5 25V5C5 3.625 6.1125 2.5 7.5 2.5H8.75V11.25L11.875 9.375L15 11.25V2.5H22.5C23.875 2.5 25 3.6125 25 5V15.675L23.125 14.65L11.025 21.25ZM30 21.25L23.125 17.5L16.25 21.25L23.125 25L30 21.25ZM18.75 23.8625V26.3625L23.125 28.75L27.5 26.3625V23.8625L23.125 26.25L18.75 23.8625Z" />
                        </svg>
                    </a>
                    <div class="addressTracker1">
                        <p>
                            <span> subject </span>
                            <span> name </span>
                        </p>
                    </div>
                </li>
                <div class="sidnavLine"></div>
                <li class="lists listItems">
                    <a href="requestpost.php">
                        <div class="listName">
                            Request Post
                        </div>
                        <div class="addressTracker requestpost"></div>
                        <svg width="28" height="28" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                            <path d="M25 10L15 16.25L5 10V7.5L15 13.75L25 7.5M25 5H5C3.6125 5 2.5 6.1125 2.5 7.5V22.5C2.5 23.163 2.76339 23.7989 3.23223 24.2678C3.70107 24.7366 4.33696 25 5 25H25C25.663 25 26.2989 24.7366 26.7678 24.2678C27.2366 23.7989 27.5 23.163 27.5 22.5V7.5C27.5 6.1125 26.375 5 25 5Z" />
                        </svg>
                    </a>
                    <div class="addressTracker1">
                        <p>
                            <span> Request </span>
                            <span> Post </span>
                        </p>
                    </div>
                </li>
                <div class="sidnavLine"></div>
                <li class="lists listItems">
                    <a href="notepost.php">
                        <div class="listName">
                            Note Post
                        </div>
                        <div class="addressTracker notepost"></div>

                        <svg width="27" height="27" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.15051 7.68726V5.68726H5.15051V4.68726C5.15051 3.57726 6.05051 2.68726 7.15051 2.68726H13.1505V9.68726L15.6505 8.18726L18.1505 9.68726V2.68726H19.1505C20.2005 2.68726 21.1505 3.63726 21.1505 4.68726V20.6873C21.1505 21.7373 20.2005 22.6873 19.1505 22.6873H7.15051C6.10051 22.6873 5.15051 21.7373 5.15051 20.6873V19.6873H3.15051V17.6873H5.15051V13.6873H3.15051V11.6873H5.15051V7.68726H3.15051ZM7.15051 11.6873H5.15051V13.6873H7.15051V11.6873ZM7.15051 7.68726V5.68726H5.15051V7.68726H7.15051ZM7.15051 19.6873V17.6873H5.15051V19.6873H7.15051Z" />
                        </svg>

                    </a>
                    <div class="addressTracker1">
                        <p>
                            <span> Note </span>
                            <span> Post </span>
                        </p>
                    </div>
                </li>
                <div class="sidnavLine"></div>
                <li class="lists listItems">
                    <a href="noticepost.php">
                        <div class="listName">
                            Notice Post
                        </div>
                        <div class="addressTracker noticepost"></div>
                        <svg width="28" height="28" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.75 3.75V26.25H26.25V3.75H3.75ZM22.5 22.5H7.5V21.25H22.5V22.5ZM22.5 20H7.5V18.75H22.5V20ZM22.5 15H7.5V7.5H22.5V15Z" />
                        </svg>
                    </a>
                    <div class="addressTracker1">
                        <p>
                            <span> Notice </span>
                            <span> Post </span>
                        </p>
                    </div>
                </li>
                <div class="sidnavLine"></div>
                <li class="lists listItems">
                    <a href="users.php">
                        <div class="listName">
                            Users
                        </div>
                        <div class="addressTracker users"></div>
                        <svg width="28" height="28" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.5 21.25C7.5 18.75 12.5 17.375 15 17.375C17.5 17.375 22.5 18.75 22.5 21.25V22.5H7.5M18.75 11.25C18.75 12.2446 18.3549 13.1984 17.6517 13.9017C16.9484 14.6049 15.9946 15 15 15C14.0054 15 13.0516 14.6049 12.3483 13.9017C11.6451 13.1984 11.25 12.2446 11.25 11.25C11.25 10.2554 11.6451 9.30161 12.3483 8.59835C13.0516 7.89509 14.0054 7.5 15 7.5C15.9946 7.5 16.9484 7.89509 17.6517 8.59835C18.3549 9.30161 18.75 10.2554 18.75 11.25ZM3.75 6.25V23.75C3.75 24.413 4.01339 25.0489 4.48223 25.5178C4.95107 25.9866 5.58696 26.25 6.25 26.25H23.75C24.413 26.25 25.0489 25.9866 25.5178 25.5178C25.9866 25.0489 26.25 24.413 26.25 23.75V6.25C26.25 5.58696 25.9866 4.95107 25.5178 4.48223C25.0489 4.01339 24.413 3.75 23.75 3.75H6.25C4.8625 3.75 3.75 4.875 3.75 6.25Z" />
                        </svg>
                    </a>
                    <div class="addressTracker1">
                        <p>Users</p>
                    </div>
                </li>
                <div class="sidnavLine"></div>
            </ul>
        </div>
    </nav>
    <nav id="topnav">
        <div class="grid">
            <h2 id="logo">E-NoteBook</h2>
            <p id="greeting">

            </p>
        </div>
        <div id="searchsec">
            <form action="#">
                <input type="text" name="search" id="search" placeholder="Search..." />
                <button>
                    <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.5 3C11.2239 3 12.8772 3.68482 14.0962 4.90381C15.3152 6.12279 16 7.77609 16 9.5C16 11.11 15.41 12.59 14.44 13.73L14.71 14H15.5L20.5 19L19 20.5L14 15.5V14.71L13.73 14.44C12.59 15.41 11.11 16 9.5 16C7.77609 16 6.12279 15.3152 4.90381 14.0962C3.68482 12.8772 3 11.2239 3 9.5C3 7.77609 3.68482 6.12279 4.90381 4.90381C6.12279 3.68482 7.77609 3 9.5 3ZM9.5 5C7 5 5 7 5 9.5C5 12 7 14 9.5 14C12 14 14 12 14 9.5C14 7 12 5 9.5 5Z" fill="#3E4E59" />
                    </svg>
                </button>
            </form>
        </div>
        <div id="sideContents">
            <ul>

                <li>
                    <div id='toggleMode' class="moodAdmin">Dark</div>
                </li>
                <li class="posrel">
                    <a>
                        <svg id="notbtn" width="25" height="25" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.5 26.25H17.5C17.5 27.625 16.375 28.75 15 28.75C13.625 28.75 12.5 27.625 12.5 26.25ZM26.25 23.75V25H3.75V23.75L6.25 21.25V13.75C6.25 9.875 8.75 6.5 12.5 5.375V5C12.5 3.625 13.625 2.5 15 2.5C16.375 2.5 17.5 3.625 17.5 5V5.375C21.25 6.5 23.75 9.875 23.75 13.75V21.25L26.25 23.75ZM21.25 13.75C21.25 10.25 18.5 7.5 15 7.5C11.5 7.5 8.75 10.25 8.75 13.75V22.5H21.25V13.75Z" />
                        </svg>
                    </a>
                    <div id="notrapper">
                        <div id="notification" class="shadow">
                            <div class="contentnotification">
                                <a href="#" class="eachContent shadow">
                                    <div class="divsecNotification">
                                        <span class="divTitle">Subject Name: </span>
                                        <span class="divDis">Digital Logic</span>
                                    </div>
                                    <div class="divsecNotification">
                                        <span class="divTitle">Sem/Year: </span>
                                        <span class="divDis">1st Semm</span>
                                    </div>
                                    <div class="divsecNotification">
                                        <span class="divTitle">Note Name: </span>
                                        <span class="divDis">Chapter 1 inreoduction</span>
                                    </div>
                                </a>
                                <a href="#" class="eachContent shadow">
                                    <div class="divsecNotification">
                                        <span class="divTitle">Subject Name: </span>
                                        <span class="divDis">Digital Logic</span>
                                    </div>
                                    <div class="divsecNotification">
                                        <span class="divTitle">Sem/Year: </span>
                                        <span class="divDis">1st Semm</span>
                                    </div>
                                    <div class="divsecNotification">
                                        <span class="divTitle">Note Name: </span>
                                        <span class="divDis">Chapter 1 inreoduction</span>
                                    </div>
                                </a>
                                <a href="#" class="eachContent shadow">
                                    <div class="divsecNotification">
                                        <span class="divTitle">Subject Name: </span>
                                        <span class="divDis">Digital Logic</span>
                                    </div>
                                    <div class="divsecNotification">
                                        <span class="divTitle">Sem/Year: </span>
                                        <span class="divDis">1st Semm</span>
                                    </div>
                                    <div class="divsecNotification">
                                        <span class="divTitle">Note Name: </span>
                                        <span class="divDis">Chapter 1 inreoduction</span>
                                    </div>
                                </a>
                            </div>
                            <!-- <a href="#" class="eachContent shadow"></a>
                            <a href="#" class="eachContent shadow"></a> -->
                        </div>
                    </div>
                </li>
                <li id="adminProfilemainDiv">
                    <div id="adminProfile">
                        <svg id="adminProfile1" width="35" height="40" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.4091 17.5812C7.9091 17.5812 5.6991 16.3012 4.4091 14.3812C4.4391 12.3812 8.4091 11.2812 10.4091 11.2812C12.4091 11.2812 16.3791 12.3812 16.4091 14.3812C15.1191 16.3012 12.9091 17.5812 10.4091 17.5812ZM10.4091 3.38123C11.2048 3.38123 11.9678 3.6973 12.5304 4.25991C13.093 4.82251 13.4091 5.58558 13.4091 6.38123C13.4091 7.17688 13.093 7.93994 12.5304 8.50255C11.9678 9.06516 11.2048 9.38123 10.4091 9.38123C9.61345 9.38123 8.85039 9.06516 8.28778 8.50255C7.72517 7.93994 7.4091 7.17688 7.4091 6.38123C7.4091 5.58558 7.72517 4.82251 8.28778 4.25991C8.85039 3.6973 9.61345 3.38123 10.4091 3.38123ZM10.4091 0.381226C9.09588 0.381226 7.79552 0.639883 6.58227 1.14243C5.36901 1.64498 4.26662 2.38157 3.33804 3.31016C1.46267 5.18552 0.409103 7.72906 0.409103 10.3812C0.409103 13.0334 1.46267 15.5769 3.33804 17.4523C4.26662 18.3809 5.36901 19.1175 6.58227 19.62C7.79552 20.1226 9.09588 20.3812 10.4091 20.3812C13.0613 20.3812 15.6048 19.3277 17.4802 17.4523C19.3555 15.5769 20.4091 13.0334 20.4091 10.3812C20.4091 4.85123 15.9091 0.381226 10.4091 0.381226Z" />
                        </svg>
                    </div>
                    <div id="listItemsAdminPp" class="shadow">
                        <ul id='adminppLink'>
                            <li>
                                <a href="#">
                                    <span>Logout</span> <svg width="15" height="17" viewBox="0 0 19 21" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.2101 15.9712V12.9712H6.2101V8.97119H13.2101V5.97119L18.2101 10.9712L13.2101 15.9712ZM11.2101 0.971191C11.7405 0.971191 12.2492 1.18191 12.6243 1.55698C12.9994 1.93205 13.2101 2.44076 13.2101 2.97119V4.97119H11.2101V2.97119H2.2101V18.9712H11.2101V16.9712H13.2101V18.9712C13.2101 19.5016 12.9994 20.0103 12.6243 20.3854C12.2492 20.7605 11.7405 20.9712 11.2101 20.9712H2.2101C1.67967 20.9712 1.17096 20.7605 0.795885 20.3854C0.420812 20.0103 0.210098 19.5016 0.210098 18.9712V2.97119C0.210098 2.44076 0.420812 1.93205 0.795885 1.55698C1.17096 1.18191 1.67967 0.971191 2.2101 0.971191H11.2101Z" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="/e_notebook/index.php">
                                    <span>Home</span> <svg width="18" height="22" viewBox="0 0 20 17" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 17V11H12V17H17V9H20L10 0L0 9H3V17H8Z" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div id="notificationfull"></div>
    </nav>
</div>

<script>
    const notbtn = document.getElementById("notbtn");
    const notificationfull = document.getElementById("notificationfull");
    const notrapper = document.getElementById("notrapper");
    notbtn.addEventListener("click", () => {
        if (notrapper.style.display === "none" || notrapper.style.display === "") {
            notrapper.style.display = "block"
            notificationfull.style.display = "block"
        } else {
            notrapper.style.display = "none"
            notificationfull.style.display = "none"
        }
    });
    notificationfull.addEventListener("click", () => {
        notrapper.style.display = "none"
        notificationfull.style.display = "none"
    })
</script>