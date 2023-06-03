<?php

$show_notification = false;
include "./UserSessionData.php";

// importaing configurations 
include '../Configuration.php';

//database connection
$con = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);

if (!$con) {
    die("Database connection failed");
}


// ================================ for pagination (start) ==========================================
$querytotalnumberROw = "SELECT COUNT(*) as total FROM auth";
$resultRowNum = mysqli_query($con, $querytotalnumberROw);
$rowNumbers = mysqli_fetch_assoc($resultRowNum);
$totalRowNumber = $rowNumbers['total'];

// for total page 
$recordsPerPage = 10;
$totalPages = ceil($totalRowNumber / $recordsPerPage);

// my current page
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($currentPage - 1) * $recordsPerPage;


// get data 
$sql = "SELECT * FROM auth LIMIT $offset, $recordsPerPage";
$res = mysqli_query($con, $sql);



if (isset($_GET['add_admin'])) {
    $admin = $_GET['add_admin'];
    // Prepare the SQL statement
    if ($privilege == 0) {
        $sqlUpdate = "UPDATE `auth` SET `privilege` = 1 WHERE `id` = '$admin'";
        mysqli_query($con, $sqlUpdate);
    } else {
        echo "Access denied";
    }
    header("Location: users.php");
    exit();
}
if (isset($_GET['remove_admin'])) {
    $admin = $_GET['remove_admin'];
    // Prepare the SQL statement
    if ($privilege == 0) {
        $sqlUpdate = "UPDATE `auth` SET `privilege` = 2 WHERE `id` = '$admin'";
        mysqli_query($con, $sqlUpdate);
    } else {
        echo "Access denied";
    }
    header("Location: users.php");
    exit();
}

// delete user
if (isset($_GET['delete_user'])) {
    $user = $_GET['delete_user'];
    if ($privilege == 0) {
        // Prepare the SQL statement
        $sqlUpdate = "DELETE FROM `auth` WHERE `id` = '$user'";
        mysqli_query($con, $sqlUpdate);
    } else {
        echo "Access Denide";
    }
    header("Location: users.php");
    exit();
}


function displayUserCard($row, $user)
{
    echo '
    <div class="shadow userCard">';

    if ($user == 'sAdmin') {
        echo '
        <div class="hambar">
            <div class="hambarcontent"></div>
            <div class="hambarcontent"></div>
            <div class="hambarcontent"></div>
            <div class="hamlist shadow-lg listHambar">
                <ul class="hambarul hambarUserbtn">';

        if ($row['privilege'] == 1) {
            echo '
                    <a href="?remove_admin=' . $row['id'] . '" class="border-b" onclick="btnClicked()">
                        Remove admin
                    </a>';
        } else {
            echo '
                    <a href="?add_admin=' . $row['id'] . '" class="border-b" onclick="btnClicked()">
                        Add admin
                    </a>';
        }

        echo '
                    <a href="?delete_user=' . $row['id'] . '" onclick="btnClicked()">
                        Delete User
                    </a>
                </ul>
            </div>
        </div>';
    }

    echo '
        <div class="headProfile">
            <div class="userProfile">
                G
            </div>
            <div class="content">
                <div class="username">' . $row["name"] . '</div>
                <div class="email">' . $row["email"] . '</div>
            </div>
        </div>
        <div class="contentList">
            <div class="saperateContent">
                <span class="Title">Stream:</span> <span style="text-transform: uppercase;">' . $row["stream"] . '</span>
            </div>
            <div class="saperateContent">
                <span class="Title">Date:</span> <span>' . $row["date"] . '</span>
            </div>';

    if ($row['privilege'] < 2) {
        echo '
            <div class="isadminshow">
                <svg width="15" height="18" viewBox="0 0 19 23" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.98263 0.626892L0.982626 4.62689V10.6269C0.982626 16.1769 4.82263 21.3669 9.98263 22.6269C15.1426 21.3669 18.9826 16.1769 18.9826 10.6269V4.62689L9.98263 0.626892ZM9.98263 4.62689C10.7783 4.62689 11.5413 4.94296 12.1039 5.50557C12.6666 6.06818 12.9826 6.83124 12.9826 7.62689C12.9826 8.42254 12.6666 9.1856 12.1039 9.74821C11.5413 10.3108 10.7783 10.6269 9.98263 10.6269C9.18698 10.6269 8.42391 10.3108 7.86131 9.74821C7.2987 9.1856 6.98263 8.42254 6.98263 7.62689C6.98263 6.83124 7.2987 6.06818 7.86131 5.50557C8.42391 4.94296 9.18698 4.62689 9.98263 4.62689ZM15.1126 16.6269C13.9026 18.4769 12.0926 19.8669 9.98263 20.5469C7.87263 19.8669 6.06263 18.4769 4.85263 16.6269C4.51263 16.1269 4.22263 15.6269 3.98263 15.0969C3.98263 13.4469 6.69263 12.0969 9.98263 12.0969C13.2726 12.0969 15.9826 13.4169 15.9826 15.0969C15.7426 15.6269 15.4526 16.1269 15.1126 16.6269Z" />
                </svg>
            </div>';
    }

    echo '
        </div>
    </div>';
}


// groping admin user and superadmin
if (mysqli_num_rows($res) > 0) {
    $zeroPrivilegeUsers = [];
    $onePrivilegeUsers = [];
    $twoPrivilegeUsers = [];
    while ($row = mysqli_fetch_assoc($res)) {
        if ($row['privilege'] == 0) {
            $zeroPrivilegeUsers[] = $row;
        } else if ($row['privilege'] == 1) {
            $onePrivilegeUsers[] = $row;
        } else {
            $twoPrivilegeUsers[] = $row;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-NoteBook Users</title>
    <link rel="stylesheet" href="../Client/styles/global.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/users.css">

    <!-- for JS Logic  -->
    <script src="./logic/sidenav.js" defer></script>
    <script src="./logic/user.js" defer></script>

</head>

<body>
    <?php include "./common/sidenav.php" ?>
    <div id="adminContent">
        <div class="actualContent">
            <div class="contentDiv">
                <div id="gridItems">
                    <?php
                    if ($privilege == 0) {
                        // Display zero privilege users first
                        foreach ($zeroPrivilegeUsers as $row) {
                            displayUserCard($row, "sAdmin");
                        }

                        // Display one privilege users next
                        foreach ($onePrivilegeUsers as $row) {
                            displayUserCard($row, "sAdmin");
                        }

                        // Display two privilege users next
                        foreach ($twoPrivilegeUsers as $row) {
                            displayUserCard($row, "sAdmin");
                        }
                    } else {
                        // Display zero privilege users first
                        foreach ($zeroPrivilegeUsers as $row) {
                            displayUserCard($row, "admin");
                        }

                        // Display one privilege users next
                        foreach ($onePrivilegeUsers as $row) {
                            displayUserCard($row, "admin");
                        }

                        // Display two privilege users next
                        foreach ($twoPrivilegeUsers as $row) {
                            displayUserCard($row, "admin");
                        }
                    }
                    ?>

                    <!-- ================================= for pagination =============================== -->
                    <div class="pagination">
                        <?php
                        if ($currentPage > 1) {
                            echo '<a href="?page=' . ($currentPage - 1) . '" class="leftArrow">&laquo;</a>';
                        } else {
                            echo '<a class="leftArrow">&laquo;</a>';
                        }

                        for ($i = 1; $i <= $totalPages; $i++) {
                            $activeClass = ($currentPage == $i) ? 'activePage' : '';
                            echo '<a href="?page=' . $i . '" class="' . $activeClass . '">' . $i . '</a>';
                        }

                        if ($currentPage < $totalPages) {
                            echo '<a href="?page=' . ($currentPage + 1) . '" class="rightArrow">&raquo;</a>';
                        } else {
                            echo '<a class="rightArrow">&raquo;</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>