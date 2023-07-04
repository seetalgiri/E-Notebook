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
if (isset($_GET['success'])) {
    echo '<div class="fullcontainerToast">
    <div class="toastifier">
        <div class="toastifierContent successToast ">
        <div class="cross" onclick="crossClk()">X</div>

        <div class="innercontent">
            <svg
            width="16"
            height="16"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
            >
            <path
                d="M10 0C4.5 0 0 4.5 0 10C0 15.5 4.5 20 10 20C15.5 20 20 15.5 20 10C20 4.5 15.5 0 10 0ZM8 15L3 10L4.41 8.59L8 12.17L15.59 4.58L17 6L8 15Z"
            />
            </svg>
            <span> ' . $_GET['success'] . '</span>
        </div>
            </div>
        </div>
    </div>';
}

// importaing configurations 
include '../Configuration.php';

//database connection
$con = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);

if (!$con) {
    die("Database connection failed");
}
if (isset($_POST['postadd'])) {
    $fname = $_POST['fname'];
    $yearsem = $_POST['yearsem'];

    // Check if faculty name already exists
    $checkQuery = "SELECT * FROM `faculty` WHERE `faculity_name` = '$fname'";
    $result = mysqli_query($con, $checkQuery);
    if (mysqli_num_rows($result) > 0) {
        // Faculty name already exists
        header("Location: " . $_SERVER['PHP_SELF'] . '?error=Faculty already exists');
    } else {
        // Faculty name doesn't exist, insert new record
        $sql = "INSERT INTO `faculty` (`faculity_name`, `yearsem`) VALUES ('$fname', '$yearsem')";
        if (mysqli_query($con, $sql)) {
            header("Location: " . $_SERVER['PHP_SELF'] . '?success=Faculty added');
        } else {
            header("Location: " . $_SERVER['PHP_SELF'] . '?error=Cannot add faculty');
        }
    }
}


// to so all data in frontend
$sql = "SELECT * FROM `faculty` ORDER BY id DESC";
$res = mysqli_query($con, $sql);


// for delete data 
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sqlD = "DELETE FROM `faculty` WHERE id = $id";
    $resD = mysqli_query($con, $sqlD);
    if (!$resD) {
        header("Location: " . $_SERVER['PHP_SELF'] . '?error=can not deleted faculty');
    } else {
        header("Location: " . $_SERVER['PHP_SELF'] . '?success=Faculty deleted');
    }
}

// to update changes
if (isset($_POST['updateadd'])) {
    $fname = $_POST['fname'];
    $id = $_POST['idnum'];
    $yearsem = $_POST['yearsem'];
    $sql = "UPDATE faculty SET faculity_name = '$fname', yearsem='$yearsem' WHERE id = $id";
    if (mysqli_query($con, $sql)) {
        header("Location: " . $_SERVER['PHP_SELF'] . '?success=faculty updated');
    } else {
        header("Location: " . $_SERVER['PHP_SELF'] . '?error=can not update faculty');
    }
}

// for searching
// Retrieve the search value from the GET request]
if (isset($_GET['search'])) {
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // Escape the search value to prevent SQL injection
    $search = mysqli_real_escape_string($con, $search);

    // Check if the search value is set
    if (!empty($search)) {
        // Query with the search value
        $sqlNote = "SELECT * FROM faculty WHERE faculity_name LIKE '%$search%'";
        $res = mysqli_query($con, $sqlNote);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-NoteBook Faculty</title>
    <!-- for CSS Style  -->
    <link rel="stylesheet" href="../Client/styles/global.css">
    <link rel="stylesheet" href="./css/stylesa.css">
    <link rel="stylesheet" href="./css/faculity.css">

    <!-- for JS Logic  -->
    <script src="./logic/sidenav.js" defer></script>
    <script src="./logic/faculityas.js" defer></script>
</head>

<body>
    <?php include "./common/sidenav.php" ?>
    <div id="adminContent">
        <div class="actualContent">
            <div class="contentDiv">
                <table class="faculity">
                    <tr>
                        <th class="serialname">S.N</th>
                        <th class="facname">Name</th>
                        <th>Year/Semester</th>
                        <th colspan="2">Action</th>
                    </tr>
                    <?php
                    $num = 1;
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            echo "
                    <tr>
                    <td>" . $num . "</td>
                    <td>" . $row["faculity_name"] . "</td>";
                            if ($row["yearsem"] == 1) {
                                echo "<td>Year</td>";
                            } else {
                                echo "<td>Semester</td>";
                            }
                            echo "<td class='edit' id='editbtn' name='editbtnclk'>
                            <svg  onclick='openmodal(" . json_encode($row) . ")' id='editbtn' width='17' height='17' viewBox='0 0 25 24' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M22.5 8.75V7.5L15 0H2.5C1.1125 0 0 1.1125 0 2.5V20C0 21.3875 1.125 22.5 2.5 22.5H10V20.1625L20.4875 9.675C21.0375 9.125 21.7375 8.825 22.5 8.75ZM13.75 1.875L20.625 8.75H13.75V1.875ZM24.8125 13.9875L23.5875 15.2125L21.0375 12.6625L22.2625 11.4375C22.5 11.1875 22.9125 11.1875 23.1625 11.4375L24.8125 13.0875C25.0625 13.3375 25.0625 13.75 24.8125 13.9875ZM20.1625 13.5375L22.7125 16.0875L15.05 23.75H12.5V21.2L20.1625 13.5375Z' />
                            </svg>
                        </td>
                        <td class='delete'>
                        <a name='deletebtn' href=\"./faculty.php?id=" . $row["id"] . "\">
                            <svg width='17' height='17' viewBox='0 0 20 23' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M6.25 0V1.25H0V3.75H1.25V20C1.25 20.663 1.51339 21.2989 1.98223 21.7678C2.45107 22.2366 3.08696 22.5 3.75 22.5H16.25C16.913 22.5 17.5489 22.2366 18.0178 21.7678C18.4866 21.2989 18.75 20.663 18.75 20V3.75H20V1.25H13.75V0H6.25ZM6.25 6.25H8.75V17.5H6.25V6.25ZM11.25 6.25H13.75V17.5H11.25V6.25Z' />
                            </svg>
                        </a>
                        </td>
                    </tr>
                    ";
                            $num = $num + 1;
                        }
                    }
                    ?>
                </table>
                <!-- <div class="pagination">
                    <a href="#" class="leftArrow">&laquo;</a>
                    <a href="#">1</a>
                    <a href="#" class="activePage">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#" class="rightArrow">&raquo;</a>
                </div> -->
            </div>
        </div>
        <div id="modalContent">
            <div id="sideButton" onclick="modalBtnclk()">
                <svg width="13" height="16" viewBox="0 0 8 12" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.589844 10.58L5.16984 6L0.589844 1.41L1.99984 0L7.99984 6L1.99984 12L0.589844 10.58Z" />
                </svg>
            </div>
            <div id="sideDivForm" style="height: 350px !important;">
                <form action="./faculty.php" method="post" id="forms">
                    <h3>Add Faculty:</h3>
                    <input type="hidden" name="idnum" id="idnum">
                    <div id="forms" class="flex">
                        <label for="fname">Enter faculity name:</label>
                        <input type="text" name="fname" required id="fname" placeholder="Name">
                    </div>
                    <div id="forms" class="flex">
                        <label for="stdType">Select Year/Semester:</label>
                        <select name="yearsem" id="stdType">
                            <option value="1">Years</option>
                            <option value="2">Semester</option>
                        </select>
                    </div>
                    <div id="forms" class="buttonformFac">
                        <button type='submit' name='postadd' id="submitBtn">Add</button>
                        <button type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const fullcontainerToast = document.querySelectorAll(".fullcontainerToast");
        setTimeout(() => {
            for (let i = 0; i < fullcontainerToast.length; i++) {
                fullcontainerToast[i].style.right = "0px";
                document.body.style.overflow = "hidden";
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
                document.body.style.overflow = "auto";
            }
        };
        if (window.location.search.includes('error') || window.location.search.includes('success')) {
            history.replaceState({}, document.title, window.location.pathname);
            document.body.style.overflow = "auto";

        }
    </script>
</body>

</html>