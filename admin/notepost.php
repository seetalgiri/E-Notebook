<?php
$show_notification = false;

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



// ================================ for pagination (start) ==========================================
$querytotalnumberROw = "SELECT COUNT(*) as total FROM notes";
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
$sqlNote = "SELECT * FROM notes ORDER BY id DESC LIMIT $offset, $recordsPerPage";
$resultNotes = mysqli_query($con, $sqlNote);




if (!$resultNotes) {
    die("Error fetching data: " . mysqli_error($con));
}



// for delete functionality 
if (isset($_GET['deletenote'])) {
    // Retrieve the note ID from the URL parameter
    $noteId = $_GET['deletenote'];

    // Prepare the delete query
    $deleteQuery = "DELETE FROM notes WHERE id = $noteId";

    // Execute the delete query
    if (mysqli_query($con, $deleteQuery)) {
        // Redirect to the same page without the deletenote parameter
        header("Location: " . $_SERVER['PHP_SELF']);
        exit(); // Make sure to exit after the redirect
    } else {
        echo "Error deleting note: " . mysqli_error($con);
    }
    // Close the database connection
    mysqli_close($con);
}


$note = "";
$post_des = "";
$stream_id = "";
$sem = "";
$year = "";
$sub_name = "";
$sub_id = "";
$note_file = "";
$note_name = "";
$author = "E-NoteBook";
$note_category = "";
$stream_na = "";
$note_like = "";

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edoitsql = "SELECT * FROM `notes` WHERE `id` = $id ";
    $editres = mysqli_query($con, $edoitsql);
    if (!$editres) {
        echo "Note not found";
    } else {
        $note = mysqli_fetch_array($editres);
        $post_des = $note['post_des'];
        $stream_id = $note['stream_id'];
        $sem = $note['sem'];
        $year = $note['year'];
        $sub_name = $note['sub_name'];
        $sub_id = $note['sub_id'];
        $note_file = $note['note_file'];
        $note_name = $note['note_name'];
        $author = $note['author'];
        $note_category = $note['note_category'];
        $stream_name = $note['stream_name'];
        $note_like = $note['note_like'];
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
        $sqlNote = "SELECT * FROM `notes` WHERE `note_name` LIKE '%$search%' OR `post_des` LIKE '%$search%'";
        $resultNotes = mysqli_query($con, $sqlNote);
    } else {
        // Query without the search value
        $sqlNote = "SELECT * FROM `notes`";
        $resultNotes = mysqli_query($con, $sqlNote);
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
    <title>E-NoteBook Note Post</title>
    <!-- for CSS Style  -->
    <link rel="stylesheet" href="../Client/styles/globalas.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/faculity.css">
    <link rel="stylesheet" href="./CSS/noteposts.css">

    <!-- for JS Logic  -->
    <script src="./logic/sidenav.js" defer></script>
    <script src="./logic/noteposts.js" defer></script>
</head>

<body>
    <?php include "./common/sidenav.php" ?>
    <div id="adminContent">
        <div class="actualContent">
            <div class="contentDiv">
                <table class="faculity">
                    <tr>
                        <th class="serialname">S.N</th>
                        <th class="facname">Description</th>
                        <th>Stream</th>
                        <th>Sem/Year</th>
                        <th>Subject Name</th>
                        <th>Note Name</th>
                        <th colspan="2">Action</th>
                    </tr>
                    <?php
                    $i = 1;
                    // Displaying data rows
                    while ($row = mysqli_fetch_assoc($resultNotes)) {
                        $postDes = $row['post_des'] != "" ? $row['post_des'] : "-";
                        $noteName = $row['note_name'] != "" ? $row['note_name'] : "-";
                        $noteId = $row['id'];
                        $sem = $row['sem'];
                        $year = $row['year'];
                        $semYr = "";
                        $sem > 0 ? $semYr =  getOrdinal($sem) . " semester" : $semYr =  getOrdinal($year)  . " year";
                        echo "<tr>
                        <td>{$i}</td>
                        <td>{$postDes}</td>
                        <td>{$row['stream_name']}</td>
                        <td>{$semYr}</td>
                        <td>{$row['sub_name']}</td>
                        <td>{$noteName}</td>
                        <td class='edit twoBtn' id='editbtn'>
            <a href='?edit={$noteId}'>
                <svg id='editbtn' width='17' height='17' viewBox='0 0 25 24' xmlns='http://www.w3.org/2000/svg'>
                <path d='M22.5 8.75V7.5L15 0H2.5C1.1125 0 0 1.1125 0 2.5V20C0 21.3875 1.125 22.5 2.5 22.5H10V20.1625L20.4875 9.675C21.0375 9.125 21.7375 8.825 22.5 8.75ZM13.75 1.875L20.625 8.75H13.75V1.875ZM24.8125 13.9875L23.5875 15.2125L21.0375 12.6625L22.2625 11.4375C22.5 11.1875 22.9125 11.1875 23.1625 11.4375L24.8125 13.0875C25.0625 13.3375 25.0625 13.75 24.8125 13.9875ZM20.1625 13.5375L22.7125 16.0875L15.05 23.75H12.5V21.2L20.1625 13.5375Z' />
                </svg>
            </a>

        </td>
        <td class='delete twoBtn'>
            <a href='?deletenote={$noteId}'>
                    <svg width='17' height='17' viewBox='0 0 20 23' xmlns='http://www.w3.org/2000/svg'>
                        <path d='M6.25 0V1.25H0V3.75H1.25V20C1.25 20.663 1.51339 21.2989 1.98223 21.7678C2.45107 22.2366 3.08696 22.5 3.75 22.5H16.25C16.913 22.5 17.5489 22.2366 18.0178 21.7678C18.4866 21.2989 18.75 20.663 18.75 20V3.75H20V1.25H13.75V0H6.25ZM6.25 6.25H8.75V17.5H6.25V6.25ZM11.25 6.25H13.75V17.5H11.25V6.25Z'/>
                    </svg>
                </a>
            </td>
        </tr>";
                        $i++;
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
        <div id="modalContent" class='NotePostModalContent'>
            <div id="sideButton" onclick="modalBtnclk()">
                <svg width="13" height="16" viewBox="0 0 8 12" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.589844 10.58L5.16984 6L0.589844 1.41L1.99984 0L7.99984 6L1.99984 12L0.589844 10.58Z" />
                </svg>
            </div>
            <div id="sideDivForm" class='noticePost'>
                <form action="../Server/Notes/uploadnote.php" method="post" id="forms" enctype="multipart/form-data">
                    <h3>Add Faculty:</h3>
                    <div id="forms" class="flex">
                        <label for="PostDesctiption">Enter Post Description:</label>
                        <textarea name="description" id="PostDesctiption" cols="30" rows="5" placeholder="Enter Note Description..."><?php echo $post_des; ?></textarea>
                    </div>
                    <div id="forms" class="flex">
                        <label for="author">Enter Author:</label>
                        <input type="text" name="author" id="author" placeholder="Enter Note Name" style="padding: 10px 8px;" value="<?php echo $author; ?>">
                    </div>
                    <div class='flexButtons'>
                        <div id="forms" class="flex fbselectStr">
                            <label for="mySelect">Select Stream:</label>
                            <select name="facultyid" id="mySelect" onchange="myFunction()" style="padding: 11px; border-radius: 3px">
                                <option value="">Select Stream</option>
                                <?php
                                if (mysqli_num_rows($resfac) > 0) {
                                    while ($row = mysqli_fetch_assoc($resfac)) {
                                        $selected = ($row['id'] == $stream_id) ? 'selected' : '';
                                        echo "<option value='" . $row["id"] . "' data_yearsem=" . $row['yearsem'] . " $selected>" . $row["faculity_name"] . "</option> ";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div id="forms" class="flex fbselectStr">
                            <label for="semyearsel">Select Grade:</label>
                            <select id='semyearsel'>
                                <option value="">Select Semester</option>
                            </select>
                        </div>
                    </div>
                    <div class='flexButtons'>
                        <div id="forms" class="flex fbselectStr">
                            <label for="subject">Subject Name:</label>
                            <select name="subject" id="subject">
                                <option value="">Select Subject</option>
                            </select>
                        </div>
                        <div id="forms" class="flex fbselectStr">
                            <label for="image">Select Image:</label>
                            <input type="file" name="note" id="image" accept="application/pdf">
                        </div>
                    </div>
                    <div class='flexButtons'>
                        <div id="forms" class="flex fbselectStr">
                            <label for="section">Select File Section:</label>
                            <select name="section" id="section">
                                <option value="">Select Section</option>
                                <option value="note" <?php echo ($note_category == 'note') ? 'selected' : ''; ?>>Note</option>
                                <option value="prevqn" <?php echo ($note_category == 'prevqn') ? 'selected' : ''; ?>>Prev Question</option>
                                <option value="syllabus" <?php echo ($note_category == 'syllabus') ? 'selected' : ''; ?>>Syllabus</option>
                            </select>
                        </div>
                        <div id="forms" class="flex" style="width: 50%;">
                            <label for="noteName">Enter Note Name:</label>
                            <input type="text" name="noteName" id="noteName" placeholder="Enter Note Name" style="padding: 10px 8px;" value="<?php echo $note_name; ?>">
                        </div>
                    </div>
                    <?php echo isset($_GET['edit']) ? '<input type="hidden" name="update" id="" value="' . $_GET['edit'] . '">' : ''; ?>
                    <div id=" forms" class="buttonformFac">
                        <button type='submit' name=<?php echo isset($_GET['edit']) ? 'noteUpdateUpload' : 'notePostUpload'; ?>><?php echo isset($_GET['edit']) ? 'Update' : 'Post'; ?></button>
                        <button type="reset">Reset</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



    <script>
        let data = [];
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../Server/subjectName.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var jsonData = JSON.parse(xhr.responseText);
                data = jsonData
            }
        };
        xhr.send();
        var streamDropdown = document.getElementById('mySelect');
        var semYearDropdown = document.getElementById('semyearsel');
        var subjectDropdown = document.getElementById('subject');

        streamDropdown.addEventListener('change', handleSubjectChange);
        semYearDropdown.addEventListener('change', handlesemSubjectChange);

        let totalcontent = '';
        let filterdcontent = [];

        function handleSubjectChange() {
            let stream = streamDropdown.value;
            let streamfiltered = data.filter(e => e.facultyid === stream);
            filterdcontent = streamfiltered;
            subjectDropdown.innerHTML = "";
            subjectDropdown.innerHTML = '<option value="">Select Subject</option>';
            let option = "";
            totalcontent = '';

            streamfiltered.forEach((e) => {
                if (!option.includes(`value="${e.id}"`)) {
                    option = `<option value="${e.id}">${e.name}</option>`;
                    totalcontent += option;
                }
            });

            subjectDropdown.innerHTML = totalcontent !== '' ? totalcontent : '<option value="">Not Found</option>';
        }



        function handlesemSubjectChange() {
            let grade = semYearDropdown.value;
            let streamfiltered = [];
            subjectDropdown.innerHTML = "";
            subjectDropdown.innerHTML = '<option value="">Select Subject</option>';

            const allDataset = () => {
                let option = "";
                totalcontent = '';

                streamfiltered.forEach((e) => {
                    if (!option.includes(`value="${e.id}"`)) {
                        option = `<option value="${e.id}">${e.name}</option>`;
                        totalcontent += option;
                    }
                });

                subjectDropdown.innerHTML = totalcontent !== '' ? totalcontent : '<option value="">Not Found</option>';
            }

            if (filterdcontent.length <= 0) {
                if (semYearDropdown.children.length > 7) {
                    streamfiltered = data.filter(e => e.sem === grade);
                    allDataset()
                } else {
                    streamfiltered = data.filter(e => e.year === grade);
                    allDataset()
                }
            } else {
                if (semYearDropdown.children.length > 7) {
                    streamfiltered = filterdcontent.filter(e => e.sem === grade);
                    allDataset()
                } else {
                    streamfiltered = filterdcontent.filter(e => e.year === grade);
                    allDataset()
                }
            }


        }



        // crossSection.addEventListener("click", toggleSection);
        // filterSection.addEventListener("click", toggleSection);

        let sem = `<option value="1" <?php if ($sem == "1") echo "selected"; ?>>First Semester</option>
                                <option value="2" <?php if ($sem == "2") echo "selected"; ?>>Second Semester</option>
                                <option value="3" <?php if ($sem == "3") echo "selected"; ?>>Third Semester</option>
                                <option value="4" <?php if ($sem == "4") echo "selected"; ?>>Fourth Semester</option>
                                <option value="5" <?php if ($sem == "5") echo "selected"; ?>>Fifth Semester</option>
                                <option value="6" <?php if ($sem == "6") echo "selected"; ?>>Sixth Semester</option>
                                <option value="7" <?php if ($sem == "7") echo "selected"; ?>>Seventh Semester</option>
                                <option value="8" <?php if ($sem == "8") echo "selected"; ?>>Eighth Semester</option>
                    `;

        let year = ` <option value="">Select Year</option>
                    <option value="1" <?php if ($year == "1") echo "selected"; ?>>First Year</option>
                    <option value="2" <?php if ($year == "2") echo "selected"; ?>>Second Year</option>
                    <option value="3" <?php if ($year == "3") echo "selected"; ?>>Third Year</option>
                    <option value="4" <?php if ($year == "4") echo "selected"; ?>>Fourth Year</option>
                   `;

        // setting year and sem
        const initialval = document.querySelector("#mySelect option");
        const semyear = document.getElementById("semyearsel");


        let initialvaltype = initialval.getAttribute("data_yearsem");
        let HTML = Number(initialvaltype) === 1 ? year : sem;

        // changing faculty value;
        function myFunction() {
            var selectElement = document.getElementById("mySelect");
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            let type = selectedOption.getAttribute("data_yearsem");
            if (Number(type) === 1) {
                semyear.setAttribute("name", "year");
                HTML = year;
            } else {
                semyear.setAttribute("name", "sem");
                HTML = sem;
            }
            semyear.innerHTML = HTML;
        }



        // When editing get sem/year and subject name
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const editParam = urlParams.get('edit');
            if (editParam) {
                myFunction();
                handleSubjectChange()
                setTimeout(() => {
                    handleSubjectChange();
                    handlesemSubjectChange()
                }, 100);
                // handlesemSubjectChange();
            }
        };
    </script>

</body>

</html>