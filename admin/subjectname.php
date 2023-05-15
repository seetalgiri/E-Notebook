<?php
$show_notification = false;

// to conntct database
$con = mysqli_connect("localhost", "root", "", "e_notebook");
if (!$con) {
    die("Database connection failed");
}

// to show all data in frontend
$sql = "SELECT * FROM `faculty`";
$resfac = mysqli_query($con, $sql);

// for sem and year selection
$extype = 1;

// to add content
if (isset($_POST['postadd'])) {
    $year = -1;
    $sem = -1;
    $sub_name = $_POST['sub_name'];
    $fId = $_POST['facultyid'];
    if (isset($_POST['year'])) {
        $year = $_POST['year'];
    } else {
        $sem = $_POST['sem'];
    }

    $facName = "";
    if (mysqli_num_rows($resfac) > 0) {
        while ($row = mysqli_fetch_assoc($resfac)) {
            if ($row['id'] == $fId) {
                $facName = $row['faculity_name'];
            }
        }
    }


    $sql = "INSERT INTO `subname` (`name`, `facultyid`, `facname`, `year`, `sem`) VALUES ('$sub_name', '$fId', '$facName', '$year', '$sem')";
    if (mysqli_query($con, $sql)) {
        // echo "Inserted";
        $show_notification = true;
        header("Location: " . $_SERVER['PHP_SELF']);
    } else {
        // echo "Sorry";
        $show_notification = false;
    }
}

// to show all data in frontend
$sql = "SELECT * FROM `subname`";
$res = mysqli_query($con, $sql);




// for delete data 
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sqlD = "DELETE FROM `subname` WHERE id = $id";
    $resD = mysqli_query($con, $sqlD);
    if (!$resD) {
        echo "Error " . $resD;
    } else {
        header("Location: " . $_SERVER['PHP_SELF']);
    }
}

// for edit btn
// to show edting data
$name = "";
$dorder = "";
$idnum = "";
if (isset($_GET["edit"])) {
    $id = $_GET["edit"];
    $sql = "SELECT * FROM subname WHERE id = $id";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row["name"];
        $dorder = $row["facultyid"];
        $idnum = $row["id"];
    } else {
        $name = "";
        $dorder = "";
        $idnum = "";
    }
}

// to update changes
if (isset($_POST['updateadd'])) {
    $year = -1;
    $sem = -1;
    $fname = $_POST['sub_name'];
    $dOrder = $_POST['facultyid'];
    if (isset($_POST['year'])) {
        $year = $_POST['year'];
    } else {
        $sem = $_POST['sem'];
    }
    $id = $_POST['idnum'];
    $sql = "UPDATE subname SET name = '$fname',facultyid = '$dOrder', year=$year, sem=$sem WHERE id = $id";
    if (mysqli_query($con, $sql)) {
        header("Location: " . $_SERVER['PHP_SELF']);
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-NoteBook Suject Name</title>
    <link rel="stylesheet" href="../Client/styles/global.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./CSS/faculitya.css">

    <!-- for JS Logic  -->
    <script src="./logic/sideNav.js" defer></script>
    <script src="./logic/subjectname.js" defer></script>

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
                        <th>Faculty Name</th>
                        <th colspan="2">Action</th>
                    </tr>
                    <?php
                    $num = 1;
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            echo "
                    <tr>
                    <td>" . $num . "</td>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["facname"] . "</td>
                    <td class='edit' id='editbtn' name='editbtnclk' onclick='openmodal(" . $row["id"] . ")'>
                            <a name='editBtn' href=\"./subjectname.php?edit=" . $row["id"] . "\">
                            <svg id='editbtn' href=\"./subjectname.php?edit=" . $row["id"] . "\" width='17' height='17' viewBox='0 0 25 24' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M22.5 8.75V7.5L15 0H2.5C1.1125 0 0 1.1125 0 2.5V20C0 21.3875 1.125 22.5 2.5 22.5H10V20.1625L20.4875 9.675C21.0375 9.125 21.7375 8.825 22.5 8.75ZM13.75 1.875L20.625 8.75H13.75V1.875ZM24.8125 13.9875L23.5875 15.2125L21.0375 12.6625L22.2625 11.4375C22.5 11.1875 22.9125 11.1875 23.1625 11.4375L24.8125 13.0875C25.0625 13.3375 25.0625 13.75 24.8125 13.9875ZM20.1625 13.5375L22.7125 16.0875L15.05 23.75H12.5V21.2L20.1625 13.5375Z' />
                            </svg>
                            </a>
                        </td>
                        <td class='delete'>
                        <a name='deletebtn' href=\"./subjectname.php?id=" . $row["id"] . "\">
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

                <div class="pagination">
                    <a href="#" class="leftArrow">&laquo;</a>
                    <a href="#">1</a>
                    <a href="#" class="activePage">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a href="#">6</a>
                    <a href="#" class="rightArrow">&raquo;</a>
                </div>

            </div>
        </div>
        <div id="modalContent">
            <div id="sideButton" onclick="modalBtnclk()">
                <svg width="13" height="16" viewBox="0 0 8 12" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.589844 10.58L5.16984 6L0.589844 1.41L1.99984 0L7.99984 6L1.99984 12L0.589844 10.58Z" />
                </svg>
            </div>
            <div id="sideDivForm">
                <form action="./subjectname.php" method="post" id="forms">
                    <h3>Add Subject name:</h3>
                    <input type="hidden" name="idnum" value="<?php echo $idnum; ?>">
                    <div id="forms" class="flex">
                        <label for="dOrder">Choose Faculty:</label>
                        <select name="facultyid" id="mySelect" onchange="myFunction()">
                            <?php
                            if (mysqli_num_rows($resfac) > 0) {
                                while ($row = mysqli_fetch_assoc($resfac)) {
                                    echo "<option value='" . $row["id"] . "' data_yearsem=" . $row['yearsem'] . ">" . $row["faculity_name"] . "</option> ";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div id="semyear" class="flex">

                    </div>

                    <div id="forms" class="flex">
                        <label for="fname">Enter Subject name:</label>
                        <input type="text" required name="sub_name" id="fname" placeholder="Subject Name"
                            value="<?php echo $name; ?>">

                    </div>
                    <div id="forms" class="buttonformFac">
                        <?php
                        $message = (intval($idnum) >= 1) ? "<button type='submit' name='updateadd'>Update</button>" : "<button type='submit' name='postadd'>Add</button>";
                        echo $message;
                        ?>
                        <button type="reset">Reset</button>
                    </div>
                </form>

            </div>
        </div>

    </div>



</body>

</html>