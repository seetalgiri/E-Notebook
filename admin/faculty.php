<?php
$show_notification = false;

// to conntct database
$con = mysqli_connect("localhost", "root", "", "e_notebook");
if (!$con) {
    die("Database connection failed");
}

// to add content
if (isset($_POST['postadd'])) {
    $fname = $_POST['fname'];
    $dOrder = $_POST['dOrder'];
    $yearsem = $_POST['yearsem'];
    $sql = "INSERT INTO `faculty` (`faculity_name`, `displayorder`, `yearsem`) VALUES ('$fname', '$dOrder', '$yearsem')";
    if (mysqli_query($con, $sql)) {
        $show_notification = true;
    } else {
        $show_notification = false;
    }
}

// to so all data in frontend
$sql = "SELECT * FROM `faculty`";
$res = mysqli_query($con, $sql);


// for delete data 
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sqlD = "DELETE FROM `faculty` WHERE id = $id";
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
    $sql = "SELECT * FROM faculty WHERE id = $id";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row["faculity_name"];
        $dorder = $row["displayorder"];
        $idnum = $row["id"];
    } else {
        $name = "";
        $dorder = "";
        $idnum = "";
    }
}

// to update changes
if (isset($_POST['updateadd'])) {
    $fname = $_POST['fname'];
    $dOrder = $_POST['dOrder'];
    $id = $_POST['idnum'];
    $yearsem = $_POST['yearsem'];
    $sql = "UPDATE faculty SET faculity_name = '$fname',displayorder = '$dOrder', yearsem='$yearsem' WHERE id = $id";
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
    <title>faculty</title>
    <link rel="stylesheet" href="../Client/styles/globalsa.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./CSS/faculity.css">
    <style>
    select {
        padding: 10px;
        border: 1px solid #555;
        border-radius: 4px;
        outline: none;
        cursor: pointer !important;
        font-size: 17px !important;
    }
    </style>
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
                        <th>Display order</th>
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
                            echo "<td>" . $row["displayorder"] . "</td> <td class='edit' id='editbtn' name='editbtnclk' onclick='openmodal(" . $row["id"] . ")'>
                            <a name='editBtn' href=\"./faculty.php?edit=" . $row["id"] . "\">
                            <svg id='editbtn' href=\"./faculty.php?edit=" . $row["id"] . "\" width='17' height='17' viewBox='0 0 25 24' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M22.5 8.75V7.5L15 0H2.5C1.1125 0 0 1.1125 0 2.5V20C0 21.3875 1.125 22.5 2.5 22.5H10V20.1625L20.4875 9.675C21.0375 9.125 21.7375 8.825 22.5 8.75ZM13.75 1.875L20.625 8.75H13.75V1.875ZM24.8125 13.9875L23.5875 15.2125L21.0375 12.6625L22.2625 11.4375C22.5 11.1875 22.9125 11.1875 23.1625 11.4375L24.8125 13.0875C25.0625 13.3375 25.0625 13.75 24.8125 13.9875ZM20.1625 13.5375L22.7125 16.0875L15.05 23.75H12.5V21.2L20.1625 13.5375Z' />
                            </svg>
                            </a>
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
            </div>
        </div>
        <div id="modalContent">
            <div id="sideButton" onclick="modalBtnclk()">
                <svg width="13" height="16" viewBox="0 0 8 12" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.589844 10.58L5.16984 6L0.589844 1.41L1.99984 0L7.99984 6L1.99984 12L0.589844 10.58Z" />
                </svg>
            </div>
            <div id="sideDivForm">
                <form action="./faculty.php" method="post" id="forms">
                    <h3>Add Faculty:</h3>
                    <input type="hidden" name="idnum" value="<?php echo $idnum; ?>">
                    <div id="forms" class="flex">
                        <label for="fname">Enter faculity name:</label>
                        <input type="text" name="fname" required id="fname" placeholder="Name"
                            value=<?php echo "$name"; ?>>
                    </div>
                    <div id="forms" class="flex">
                        <label for="stdType">Select Year/Semester:</label>
                        <select name="yearsem" id="stdType">
                            <option value="1">Years</option>
                            <option value="2">Semester</option>
                        </select>
                    </div>
                    <div id="forms" class="flex">
                        <label for="dOrder">Enter Display order:</label>
                        <input type="number" name="dOrder" required id="dOrder" placeholder="Display Order"
                            value=<?php echo "$dorder"; ?>>
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

    <script>
    const modalContent = document.getElementById("modalContent");
    const svgbtn = document.querySelector("#sideButton svg");
    modalContent.style.right = '-378px';
    svgbtn.style.transform = '  rotateZ(180deg)';

    function modalBtnclk() {
        if (modalContent.style.right === "0px") {
            modalContent.style.right = '-378px';
            svgbtn.style.transform = 'rotateZ(180deg)';
        } else {
            modalContent.style.right = '0px';
            svgbtn.style.transform = 'rotateZ(0deg)';
        }
    }

    window.onclick = function(event) {
        const parentId = event.target.parentNode.id;
        const par = event.target;
        if (event.target.id !== "forms" && parentId !== 'sidenav' && parentId !== 'sideButton' && parentId !==
            "modalContent" && parentId !== "forms" && parentId !== "editbtn") {
            if (modalContent.style.right !== '-378px') {
                modalContent.style.right = '-378px';
                svgbtn.style.transform = 'rotateZ(180deg)';
            }
        }


        const parentId1 = event.target.parentNode.id;
        const parentId2 = event.target.parentNode.id;
        if (event.target.id !== 'sidenav' && event.target.id !== 'hamburger' && parentId1 !== "hamburger" &&
            parentId2 !== "sideNavLikes") {
            if (sidenav.style.width === '220px') {
                hambarclk()
            }
        }
    }

    function openmodal(id) {
        modalContent.style.right = '0px';
        svgbtn.style.transform = 'rotateZ(0deg)';
    }
    var searchParams = new URLSearchParams(window.location.search);
    var editParam = searchParams.get("edit");
    if (Number(editParam)) {
        openmodal();
    }
    </script>

</body>

</html>