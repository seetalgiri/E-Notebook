<?php
$show_notification = false;
$con = mysqli_connect("localhost", "root", "", "e_notebook");
if (!$con) {
    die("Database connection failed");
}
if (isset($_POST['postadd'])) {
    $fname = $_POST['fname'];
    $dOrder = $_POST['dOrder'];
    $sql = "INSERT INTO `faculty` (`faculity_name`, `displayorder`) VALUES ('$fname', '$dOrder')";
    if (mysqli_query($con, $sql)) {
        // echo "Inserted";
        $show_notification = true;
    } else {
        // echo "Sorry";
        $show_notification = false;
    }
}

// fetch from db
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
if (isset($_GET["edit"])) {
    $id = $_GET["edit"];
    echo "<h1>" . $id . "</h1>";
}
$name = "";
$dorder = "";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>faculty</title>
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/faculity.css">
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
                        <th>Display order</th>
                        <th colspan="2">Action</th>
                    </tr>
                    <?php
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            echo "
                    <tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["faculity_name"] . "</td>
                        <td>" . $row["displayorder"] . "</td>s
                        <td class='edit' id='editbtn' name='editbtnclk' onclick='openmodal(" . $row["id"] . ")'>
                            <svg id='editbtn' href=\"./faculty.php?edit=" . $row["id"] . "\" width='17' height='17' viewBox='0 0 25 24' xmlns='http://www.w3.org/2000/svg'>
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
                    <div id="forms" class="flex">
                        <label for="fname">Enter faclity name:</label>
                        <input type="text" name="fname" id="fname" value=<?php echo "$name"; ?>>
                    </div>
                    <div id="forms" class="flex">
                        <label for="dOrder">Enter Display order:</label>
                        <input type="number" name="dOrder" id="dOrder" value=<?php echo "$dorder"; ?>>
                    </div>
                    <div id="forms" class="buttonformFac">
                        <button type="submit" name="postadd">Add</button>
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
        svgbtn.style.transform = 'rotateZ(180deg)';

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
            if (event.target.id !== "forms" && parentId !== 'sidenav' && parentId !== 'sideButton' && parentId !== "modalContent" && parentId !== "forms" && parentId !== "editbtn") {
                if (modalContent.style.right !== '-378px') {
                    modalContent.style.right = '-378px';
                    svgbtn.style.transform = 'rotateZ(180deg)';
                }
            }


            const parentId1 = event.target.parentNode.id;
            const parentId2 = event.target.parentNode.id;
            if (event.target.id !== 'sidenav' && event.target.id !== 'hamburger' && parentId1 !== "hamburger" && parentId2 !== "sideNavLikes") {
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
            console.log("i a good")
            openmodal();
        }
    </script>

</body>

</html>