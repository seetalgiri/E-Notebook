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


    $sql = "INSERT INTO `subname` (`name`, `facultyid`,  `year`, `sem`) VALUES ('$sub_name', '$fId', '$year', '$sem')";
    if (mysqli_query($con, $sql)) {
        // echo "Inserted";
        header("Location: " . $_SERVER['PHP_SELF'] . '?success=subject name added');
    } else {
        header("Location: " . $_SERVER['PHP_SELF'] . '?error=can not add subject name');
    }
}

// ================================ for pagination (start) ==========================================
$querytotalnumberROw = "SELECT COUNT(*) as total FROM subname";
$resultRowNum = mysqli_query($con, $querytotalnumberROw);
$rowNumbers = mysqli_fetch_assoc($resultRowNum);
$totalRowNumber = $rowNumbers['total'];

// for total page 
$recordsPerPage = 13;
$totalPages = ceil($totalRowNumber / $recordsPerPage);

// my current page
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($currentPage - 1) * $recordsPerPage;


// get data 
$sql = "SELECT subname.*, faculty.faculity_name AS facname
FROM subname
JOIN faculty ON faculty.id = subname.facultyid ORDER BY id DESC LIMIT $offset, $recordsPerPage";
$res = mysqli_query($con, $sql);


// for delete data 
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sqlD = "DELETE FROM `subname` WHERE id = $id";
    $resD = mysqli_query($con, $sqlD);
    if (!$resD) {
        header("Location: " . $_SERVER['PHP_SELF'] . '?error=can not delete subject name');
    } else {
        header("Location: " . $_SERVER['PHP_SELF'] . '?success=subject name deleted');
    }
}

// for edit btn
// to show edting data
$name = "";
$facultyId = "";

$idnum = "";
$semYr = "";
if (isset($_GET["edit"])) {
    $id = $_GET["edit"];
    $sql = "SELECT *
    FROM subname WHERE id = $id";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row["name"];
        $facultyId = $row["facultyid"];
        $idnum = $row["id"];
        $semYr = $row["sem"] != -1 ? $row["sem"] : $row["year"];
    } else {
        $name = "";
        $facultyId = "";
        $idnum = "";
    }
}

// to update changes
if (isset($_POST['updateadd'])) {
    $year = -1;
    $sem = -1;
    $fname = $_POST['sub_name'];
    $facultyId = $_POST['facultyid'];
    if (isset($_POST['year'])) {
        $year = $_POST['year'];
    } else {
        $sem = $_POST['sem'];
    }
    $id = $_POST['idnum'];



    $sql = "UPDATE subname SET name = '$fname', facultyid = '$facultyId', year = '$year', sem = '$sem' WHERE id = $id";
    if (mysqli_query($con, $sql)) {
        header("Location: " . $_SERVER['PHP_SELF'] . '?success=subject Name updated');
        exit();
    } else {
        header("Location: " . $_SERVER['PHP_SELF'] . '?error=can not update subject name');
    }
}



// Retrieve the search value from the GET request]
if (isset($_GET['search'])) {
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // Escape the search value to prevent SQL injection
    $search = mysqli_real_escape_string($con, $search);

    // Check if the search value is set
    if (!empty($search)) {
        // Query with the search value
        $sqlNote = "SELECT subname.*, faculty.faculity_name AS facname
        FROM subname
        JOIN faculty ON faculty.id = subname.facultyid WHERE `name` LIKE '%$search%'";
        $res = mysqli_query($con, $sqlNote);
    }
}


function getOrdinal($number)
{
    if ($number % 100 >= 11 && $number % 100 <= 13) {
        return $number . 'th';
    } else {
        switch ($number % 10) {
            case 1:
                return $number . 'st';
            case 2:
                return $number . 'nd';
            case 3:
                return $number . 'rd';
            default:
                return $number . 'th';
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
    <title>E-NoteBook Suject Name</title>
    <link rel="stylesheet" href="../Client/styles/global.css">
    <link rel="stylesheet" href="./css/stylesa.css">
    <link rel="stylesheet" href="./css/faculity.css">

    <!-- for JS Logic  -->
    <script src="./logic/sidenav.js" defer></script>
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
                        <th>Sem/Year</th>
                        <th colspan="2">Action</th>
                    </tr>
                    <?php
                    $num = 1;
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $sem = $row['sem'];
                            $year = $row['year'];
                            $semYrwh = "";
                            $sem > 0 ? $semYrwh = getOrdinal($sem) . " semester" : $semYrwh = getOrdinal($year) . " year";
                            echo "
                    <tr>
                    <td>" . $num . "</td>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["facname"] . "</td>
                    <td>" . $semYrwh . "</td>
                    <td class='edit' id='editbtn' name='editbtnclk' onclick='openmodal(" . $row["id"] . ")'>
                            <a name='editBtn' href=\"./subjectname.php?edit=" . $row["id"] . "\">
                            <svg id='editbtn' href=\"./subjectname.php?edit=" . $row["id"] . "\" width='17' height='17' viewBox='0 0 25 24' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M22.5 8.75V7.5L15 0H2.5C1.1125 0 0 1.1125 0 2.5V20C0 21.3875 1.125 22.5 2.5 22.5H10V20.1625L20.4875 9.675C21.0375 9.125 21.7375 8.825 22.5 8.75ZM13.75 1.875L20.625 8.75H13.75V1.875ZM24.8125 13.9875L23.5875 15.2125L21.0375 12.6625L22.2625 11.4375C22.5 11.1875 22.9125 11.1875 23.1625 11.4375L24.8125 13.0875C25.0625 13.3375 25.0625 13.75 24.8125 13.9875ZM20.1625 13.5375L22.7125 16.0875L15.05 23.75H12.5V21.2L20.1625 13.5375Z' />
                            </svg>
                            </a>
                        </td>
                        <td class='delete'>
                        <a name='deletebtn' onclick='deleteBtnClk(" . $row['id'] . ")'>
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
                        <label for="mySelect">Choose Faculty:</label>
                        <select name="facultyid" id="mySelect" onchange="myFunction()" required>
                            <option value="">Select Faculty</option>
                            <?php
                            if (mysqli_num_rows($resfac) > 0) {
                                while ($row = mysqli_fetch_assoc($resfac)) {
                                    $selected = ($row["id"] == $facultyId) ? "selected" : ""; // Check if faculty id matches $facultyid
                                    echo "<option value='" . $row["id"] . "' data_yearsem=" . $row['yearsem'] . " " . $selected . ">" . $row["faculity_name"] . "</option> ";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div id="forms" class="flex fbselectStr">
                        <label for="semyearsel">Select Grade:</label>
                        <select id='semyearsel' name="sem" required>
                            <option value="">Select Semester</option>
                        </select>
                    </div>

                    <div id="forms" class="flex">
                        <label for="fname">Enter Subject name:</label>
                        <input type="text" required name="sub_name" id="fname" placeholder="Subject Name"
                            value="<?php echo $name; ?>">

                    </div>
                    <div id="forms" class="buttonformFac">
                        <?php
                        echo "<button id='submitBtn' type='submit' name='" . ((intval($idnum) >= 1) ? 'updateadd' : 'postadd') . "'>" . ((intval($idnum) >= 1) ? 'Update' : 'Add') . "</button>";
                        ?>
                        <button type="reset">Reset</button>
                    </div>
                </form>

            </div>
        </div>

    </div>

    <div id="confirmModal">
        <div id="confirmModalContent">
            <div class="actualCardConfirm">
                <div class="headermodalCon">
                    <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.9443 12.9809L10.944 13.0181L10.9067 15.0178L8.90705 14.9805M9.09332 4.98225L11.093 5.01951L10.9812 11.0185L8.98156 10.9812M9.81375 19.9983C11.1267 20.0227 12.4317 19.7883 13.6541 19.3085C14.8765 18.8286 15.9924 18.1127 16.9381 17.2016C18.8481 15.3615 19.9489 12.838 19.9983 10.1863C20.0477 7.53457 19.0417 4.97185 17.2016 3.06188C16.2904 2.11616 15.202 1.35916 13.9983 0.834098C12.7946 0.30904 11.4993 0.0262068 10.1863 0.00174628C7.53457 -0.0476539 4.97185 0.958355 3.06188 2.79846C1.15191 4.63857 0.0511458 7.16204 0.0017456 9.81375C-0.0227149 11.1267 0.211676 12.4317 0.691537 13.6541C1.1714 14.8765 1.88733 15.9924 2.79846 16.9381C3.70959 17.8839 4.79807 18.6409 6.00175 19.1659C7.20544 19.691 8.50076 19.9738 9.81375 19.9983Z" />
                    </svg>
                    <h3>Confirmation</h3>
                </div>
                <p>Are you sure you want to delete this content?</p>
                <div id="confirmModalButtons">
                    <button onclick="cancelDelete()">Cancel</button>
                    <a id="deleteLink" href="#">Delete</a>
                </div>
                <div class="crossBtn" onclick="cancelDelete()">X</div>
            </div>
        </div>
    </div>


    <script>
        let semH = `<option value="1" <?php if ($semYr == "1")
            echo "selected"; ?>>First Semester</option>
                                <option value="2" <?php if ($semYr == "2")
                                    echo "selected"; ?>>Second Semester</option>
                                <option value="3" <?php if ($semYr == "3")
                                    echo "selected"; ?>>Third Semester</option>
                                <option value="4" <?php if ($semYr == "4")
                                    echo "selected"; ?>>Fourth Semester</option>
                                <option value="5" <?php if ($semYr == "5")
                                    echo "selected"; ?>>Fifth Semester</option>
                                <option value="6" <?php if ($semYr == "6")
                                    echo "selected"; ?>>Sixth Semester</option>
                                <option value="7" <?php if ($semYr == "7")
                                    echo "selected"; ?>>Seventh Semester</option>
                                <option value="8" <?php if ($semYr == "8")
                                    echo "selected"; ?>>Eighth Semester</option>
                    `;

        let yearH = ` <option value="">Select Year</option>
                    <option value="1" <?php if ($semYr == "1")
                        echo "selected"; ?>>First Year</option>
                    <option value="2" <?php if ($semYr == "2")
                        echo "selected"; ?>>Second Year</option>
                    <option value="3" <?php if ($semYr == "3")
                        echo "selected"; ?>>Third Year</option>
                    <option value="4" <?php if ($semYr == "4")
                        echo "selected"; ?>>Fourth Year</option>
                   `;

        // setting year and sem
        const initialval = document.querySelector("#mySelect option");
        const semyear = document.getElementById("semyearsel");


        let initialvaltype = initialval.getAttribute("data_yearsem");
        let HTML = Number(initialvaltype) === 1 ? yearH : semH;

        // changing faculty value;
        function myFunction() {
            var selectElement = document.getElementById("mySelect");
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            let type = selectedOption.getAttribute("data_yearsem");
            if (Number(type) === 1) {
                semyear.setAttribute("name", "year");
                HTML = yearH;
            } else {
                semyear.setAttribute("name", "sem");
                HTML = semH;
            }
            semyear.innerHTML = HTML;
        }



        // When editing get sem/year and subject name
        window.onload = function () {
            const urlParams = new URLSearchParams(window.location.search);
            const editParam = urlParams.get('edit');
            if (editParam) {
                myFunction();
            }
        };

        function getSelectedOption() {
            const selectElement = document.getElementById("mySelect");
            const selectedIndex = selectElement.selectedIndex;

            if (selectedIndex !== -1) {
                const selectedOption = selectElement.options[selectedIndex];
                const selectedValue = selectedOption.value;
                const selectedText = selectedOption.text;
            } else { }
        }
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

        // Function to cancel the deletion and hide the confirmation modal
        function cancelDelete() {
            const confirmModal = document.getElementById('confirmModal');
            confirmModal.style.display = 'none';
            window.location.reload()
        }

        const deleteBtnClk = (id) => {
            // console.log(id)
            const confirmModal = document.getElementById("confirmModal")
            const deleteLink = document.getElementById("deleteLink")
            confirmModal.style.display = "block"
            deleteLink.setAttribute("href", `./subjectname.php?id=${id}`)
        }
        document.addEventListener("click", (elm) => {
            if (elm.target.id === "confirmModalContent") {
                cancelDelete();
            }
        })
    </script>




</body>

</html>