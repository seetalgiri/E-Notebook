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

$facNameFilter = "-";
$semYearFilter = "-";
$subNameFilter = "-";

// // one faculty name 
if (isset($_GET['facultyid'])) {
    $resfacFilter = mysqli_query($con, $sql);
    if (mysqli_num_rows($resfacFilter) > 0) {
        while ($rowFilter = mysqli_fetch_array($resfacFilter)) {
            if ($rowFilter['id'] == $_GET['facultyid']) {
                $facNameFilter = $rowFilter['faculity_name'];
                break;
            }
        }
    }
}

if ((isset($_GET['sem']) && $_GET['sem'])) {
    $semYearFilter = getOrdinal($_GET['sem']) . " Semester";
}

if ((isset($_GET['year']) && $_GET['year'])) {
    $semYearFilter = getOrdinal($_GET['year']) . " Year";
}

if ((isset($_GET['subject']) && $_GET['subject'])) {
    $subId = $_GET['subject'];
    $sqlquery = "SELECT * FROM `subname` WHERE `id` = '$subId'";
    $resSub = mysqli_query($con, $sqlquery);
    if (mysqli_num_rows($resSub) > 0) {
        $row = mysqli_fetch_array($resSub);
        $subNameFilter = $row['name'];
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

// ================================ for pagination (start) ==========================================
$querytotalnumberROw = "SELECT COUNT(*) as total FROM notes WHERE note_category = 'syllabus'";
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
$sqlNote = "SELECT * FROM notes WHERE note_category = 'syllabus' LIMIT $offset, $recordsPerPage";
$resultNotes = mysqli_query($con, $sqlNote);
if (isset($_GET['facultyid'], $_GET['subject']) && (isset($_GET['sem']) || isset($_GET['year']))) {
    $sem = "";
    $year = "";
    $facultyId = $_GET['facultyid'];
    $subjectId = $_GET['subject'];
    if (strlen($facultyId) > 0) {


        $sqlNote = "SELECT * FROM notes WHERE note_category = 'syllabus'";

        if (strlen($facultyId) > 0) {
            $sqlNote .= " AND stream_id = '$facultyId'";
        }

        // Add filters based on the available parameters
        if (isset($_GET['sem'])) {
            $sem = $_GET['sem'];
            if (strlen($sem) > 0) {
                $sqlNote .= " AND sem = '$sem'";
            }
        } elseif (isset($_GET['year'])) {
            $year = $_GET['year'];
            if (strlen($year) > 0) {
                $sqlNote .= " AND year = '$year'";
            }
        }


        if (strlen($subjectId) > 0) {
            $sqlNote .= " AND sub_id = '$subjectId'";
        }

        $sqlNote .= " LIMIT $offset, $recordsPerPage";

        $resultNotes = mysqli_query($con, $sqlNote);
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
        $sqlNote = "SELECT * FROM notes WHERE note_category = 'syllabus' AND note_name LIKE '%$search%' LIMIT $offset, $recordsPerPage";
        $resultNotes = mysqli_query($con, $sqlNote);
    } else {
        // Query without the search value
        $sqlNote = "SELECT * FROM notes WHERE note_category = 'syllabus' LIMIT $offset, $recordsPerPage";
        $resultNotes = mysqli_query($con, $sqlNote);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./Client/images/logo.png" type="image/icon type">
    <title>E-Notebook Syllabus</title>
    <!-- ==================== CSS Imported ======================== -->
    <!-- for globalas.css  -->
    <link rel="stylesheet" href="./Client/styles/globalas.css" />
    <!-- common css  -->
    <link rel="stylesheet" href="./Client/styles/style.css" />
    <link rel="stylesheet" href="./Client/styles/navigation.css" />
    <!-- for nav css  -->
    <link rel="stylesheet" href="./Client/styles/navstyles.css" />
    <link rel="stylesheet" href="./Client/styles/note.css" />
    <!-- ==================== JS Imported ======================== -->
    <!-- <script src="./Client/logic/note.js" defer></script> -->


</head>

<body>
    <?php include "./Client/Common/Navigation.php"; ?>

    <div id="mainnoteSec">
        <div class="actualCOntent">
            <div id="notessection" class="flex">
                <div class="filtersec shadow">
                    <div id="crosssection">X</div>
                    <div class="filerContentfixed">
                        <div class="headings">
                            <div class="heading shadow">Currently In:</div>
                        </div>
                        <div class="headingTopicse">
                            <div class="topics"><span>Stream:</span> <span><?php echo $facNameFilter ?></span></div>
                            <div class="topics">
                                <span>Semester/Year:</span> <span><?php echo $semYearFilter ?></span>
                            </div>
                            <div class="topics">
                                <span>Subject:</span><span><?php echo $subNameFilter ?></span>
                            </div>
                        </div>
                        <div class="borderLines"></div>
                        <div class="headings mt-20px">
                            <div class="heading shadow">Filter Syllabus:</div>
                        </div>
                        <form action="#" class="FilterNotes">
                            <div id="forms" class="flex">
                                <select name="facultyid" id="mySelect" onchange="myFunction()">
                                    <option value="" data-yearsem="2">Select Stream</option>
                                    <?php
                                    if (mysqli_num_rows($resfac) > 0) {
                                        while ($row = mysqli_fetch_assoc($resfac)) {
                                            $selected = (isset($_GET['facultyid']) && $_GET['facultyid'] == $row["id"]) ? "selected" : "";
                                            echo "<option value='" . $row["id"] . "' data-yearsem='" . $row['yearsem'] . "' $selected>" . $row["faculity_name"] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div id="semyear" class="flex">
                                <select id='semyearsel'>
                                </select>
                            </div>

                            <select name="subject" id="subject">
                                <option value="">Select Subject</option>
                            </select>
                            <button class="filterBTn" onclick="return filterCLk()">Filter</button>
                        </form>
                        <div class="borderLines"></div>
                        <div class="headings mt-20px">
                            <div class="heading shadow">Remember:</div>
                        </div>
                        <div class="disremember">
                            For better quality Syllabus, choose stream, semester or year, and
                            subject in that order. Thank you!
                        </div>
                    </div>
                </div>

                <div id="actualNote" class="bl-thin">
                    <div class="headingsChapter">
                        <h3 class="HeadingPage">Syllabus:</h3>
                        <form id="searchNotes" class="shadow">
                            <?php include './Client/Common/filterSVG.php'; ?>
                            <input type="text" name="search" id="search" placeholder="Search Syllabus..." autocomplete="off" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" />
                            <button id="searchName">
                                <svg width="19" height="18" viewBox="0 0 19 18" class="searchBtn" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.01221 0.316132C8.73611 0.316132 10.3894 1.00095 11.6084 2.21994C12.8274 3.43892 13.5122 5.09222 13.5122 6.81613C13.5122 8.42613 12.9222 9.90613 11.9522 11.0461L12.2222 11.3161H13.0122L18.0122 16.3161L16.5122 17.8161L11.5122 12.8161V12.0261L11.2422 11.7561C10.1022 12.7261 8.62221 13.3161 7.01221 13.3161C5.2883 13.3161 3.635 12.6313 2.41601 11.4123C1.19703 10.1933 0.512207 8.54004 0.512207 6.81613C0.512207 5.09222 1.19703 3.43892 2.41601 2.21994C3.635 1.00095 5.2883 0.316132 7.01221 0.316132ZM7.01221 2.31613C4.51221 2.31613 2.51221 4.31613 2.51221 6.81613C2.51221 9.31613 4.51221 11.3161 7.01221 11.3161C9.51221 11.3161 11.5122 9.31613 11.5122 6.81613C11.5122 4.31613 9.51221 2.31613 7.01221 2.31613Z" />
                                </svg>
                            </button>
                        </form>

                        <div class="flexbuttonset">
                            <div id="gridView">
                                <button id="toggleViweline" class="activeView lineview">
                                    <div class="linegr"></div>
                                    <div class="linegr"></div>
                                    <div class="linegr"></div>
                                </button>
                            </div>
                            <div id="listView">
                                <button id="toggleViwegrid" class="activeView gridview">
                                    <div class="box"></div>
                                    <div class="box"></div>
                                    <div class="box"></div>
                                    <div class="box"></div>
                                </button>
                            </div>
                        </div>
                        <div id="mainBroomDiv">
                            <div id="broom">
                                <svg onclick="pageLoad()" width="25" height="25" viewBox="0 0 19 19" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.1084 0.161499L18.5284 1.5815L12.8084 7.2915C13.8784 8.8315 14.0284 10.6815 13.1284 11.8815L6.80839 5.5615C8.00839 4.6615 9.85839 4.8115 11.3984 5.8815L17.1084 0.161499ZM3.67839 15.0115C1.66839 13.0015 0.438389 10.6015 0.0983887 8.3615L4.97839 6.2715L12.4184 13.7115L10.3284 18.5915C8.08839 18.2515 5.68839 17.0215 3.67839 15.0115Z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="linecontentNote"></div>
                    <!-- <div class="flexContent"> -->
                    <div id="mainViewContent" class="gridContent">
                        <?php
                        if (mysqli_num_rows($resultNotes) > 0) {

                            while ($row = mysqli_fetch_assoc($resultNotes)) {
                                $postDes = $row['post_des'] != "" ? $row['post_des'] : "-";
                                $noteName = $row['note_name'] != "" ? $row['note_name'] : "-";
                                $noteId = $row['id'];
                                $string = $row['note_like'] != null ? $row['note_like'] : '';
                                $likes = ($string !== '') ? explode(",", $string) : [];
                                echo '
    <div class="eachBox">
        <div class="boxcontentNote">
            <h3>' . $noteName . '</h3>
            <div class="auth">
                <svg width="14" height="14" viewBox="0 0 20 17" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.1 8.5L19.5 9.91L12.97 16.5L9.5 13L10.9 11.59L12.97 13.67L18.1 8.5ZM7 13L10 16H0V14C0 11.79 3.58 10 8 10L9.89 10.11L7 13ZM8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0Z" />
                </svg>
                <span>Author:</span> Gaurab sunar
            </div>
            <div class="NoteAction">
                <div class="date"><span>Date:</span> ' . $row['date'] . '</div>
                <div class="svgsNote">
                <div id="like' . $noteId . '" class="likecontent actionFlex ' . (in_array($id, $likes) ? "liked" : "") . '" onclick="likeBtnclk(' . $noteId . ', ' . $id . ')">
                        <svg width="17" height="15" viewBox="0 0 20 21" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 18.35L8.55 17.03C3.4 12.36 0 9.27 0 5.5C0 2.41 2.42 0 5.5 0C7.24 0 8.91 0.81 10 2.08C11.09 0.81 12.76 0 14.5 0C17.58 0 20 2.41 20 5.5C20 9.27 16.6 12.36 11.45 17.03L10 18.35Z" />
                        
                        </svg>
                        <span class="likecount" id="counterLike' . $noteId . '">' . count($likes) . '</span>
                    </div>
                    <a onclick="viewIconClick(\'' . $row['note_file'] . '\', \'' . $row['post_des'] . '\', \'' . $row['note_name'] . '\', \'' . $row['date'] . '\', \'' . $row['stream_name'] . '\')">
                    <svg width="20" height="14" viewBox="0 0 18 12" style="margin-right:6px;" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 3.75C8.40326 3.75 7.83097 3.98705 7.40901 4.40901C6.98705 4.83097 6.75 5.40326 6.75 6C6.75 6.59674 6.98705 7.16903 7.40901 7.59099C7.83097 8.01295 8.40326 8.25 9 8.25C9.59674 8.25 10.169 8.01295 10.591 7.59099C11.0129 7.16903 11.25 6.59674 11.25 6C11.25 5.40326 11.0129 4.83097 10.591 4.40901C10.169 3.98705 9.59674 3.75 9 3.75ZM9 9.75C8.00544 9.75 7.05161 9.35491 6.34835 8.65165C5.64509 7.94839 5.25 6.99456 5.25 6C5.25 5.00544 5.64509 4.05161 6.34835 3.34835C7.05161 2.64509 8.00544 2.25 9 2.25C9.99456 2.25 10.9484 2.64509 11.6517 3.34835C12.3549 4.05161 12.75 5.00544 12.75 6C12.75 6.99456 12.3549 7.94839 11.6517 8.65165C10.9484 9.35491 9.99456 9.75 9 9.75ZM9 0.375C5.25 0.375 2.0475 2.7075 0.75 6C2.0475 9.2925 5.25 11.625 9 11.625C12.75 11.625 15.9525 9.2925 17.25 6C15.9525 2.7075 12.75 0.375 9 0.375Z" />
                    </a>

                    
                    </svg>
                    <a href="' . $row['note_file'] . '" download="' . $row['note_name'] . '.pdf' . '">
                        <svg width="15" height="18" viewBox="0 0 13 16" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.958496 15.5H12.0418V13.75H0.958496M12.0418 5.875H8.87516V0.625H4.12516V5.875H0.958496L6.50016 12L12.0418 5.875Z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    ';
                            }
                        } else {
                            echo "<div id='notFound'>
                            <h1 class='noteNotFound'>Sorry, Syllabus Not Available!!!</h1>
                            <svg onclick='pageLoad()' width='27' height='24' viewBox='0 0 27 24' xmlns='http://www.w3.org/2000/svg'>
                            <path d='M0.5 12C0.5 18.2125 5.5375 23.25 11.75 23.25C14.7375 23.25 17.6 22.075 19.75 20L17.875 18.125C16.2875 19.8125 14.075 20.75 11.75 20.75C3.95 20.75 0.0500004 11.325 5.5625 5.8125C11.075 0.3 20.5 4.2125 20.5 12H16.75L21.75 17H21.875L26.75 12H23C23 5.7875 17.9625 0.75 11.75 0.75C5.5375 0.75 0.5 5.7875 0.5 12Z' />
                            </svg>
                            <p>Load page</p>
                            </div>";
                        }

                        ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div id="filterSection"></div>
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


    <!-- ========================== for view icon ============================= -->
    <div id="pdfModalContent">
        <div id="pdfModalContentmini">
            <div id="pdfModal" class="modal">
                <div id="actualContet">
                    <span class="close">&times;</span>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 id="heading" style="text-transform: uppercase; letter-spacing: 2px; margin-left: -3px;">Quick View</h2>
                            <p>Name: <span id="noteName"></span></p>
                            <p>Author: <span id="author"></span></p>
                            <p>Stream: <span id="stream"></span></p>
                            <p>Date: <span id="date"></span></p>
                            <div id="desdata">
                                <p>Description:</p>
                                <p class="paragraph" style="min-height: 170px;" id="des"></p>
                            </div>
                            <button class="downScroll">
                                <span>Quick View</span>
                                <img src="./images/mouse.gif" alt="" onclick="viewDownPDF()">
                            </button>
                        </div>
                        <div class="modal-body">
                            <iframe id="pdfViewer" src="" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ========================== for view icon ============================= -->


    <script>
        const filterCLk = () => {
            const facultyId = document.getElementById("mySelect").value;
            const semyearsel = document.getElementById("semyearsel").value;
            const subject = document.getElementById("subject").value;

            if (facultyId === "" && semyearsel === "" && subject === "") {
                return false;
            } else {
                return true;
            }
        };
        let data = [];
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "./Server/subjectName.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var jsonData = JSON.parse(xhr.responseText);
                data = jsonData;
                handleSubjectChange();
                handlesemSubjectChange();
                myFunction();
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

            totalcontent = `<option value="">Select Subject</option>` + totalcontent;

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

                const urlParams = new URLSearchParams(window.location.search);
                const selectedSubject = urlParams.get('subject') == null ? "" : urlParams.get('subject');

                streamfiltered.forEach((e) => {
                    let selected = (e.id == selectedSubject) ? 'selected' : '';
                    let option = `<option value="${e.id}" ${selected}>${e.name}</option>`;
                    totalcontent += option;
                });

                totalcontent = `<option value="">Select Subject</option>` + totalcontent;

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

        window.onload = () => {
            myFunction();
            handlesemSubjectChange();
            setTimeout(() => {
                handleSubjectChange()
                handlesemSubjectChange()
            }, 200);
        }



        // Grid View Logic
        const flexButtonSet = document.getElementById("flexbuttonset");
        const mainViewContent = document.getElementById("mainViewContent");
        const gridViewButton = document.querySelector("#gridView");
        const listViewButton = document.querySelector("#listView");

        // Set initial view type in local storage
        if (!localStorage.getItem("view")) {
            localStorage.setItem("view", "grid");
        }

        // Functions for list view and grid view
        const switchToListView = () => {
            listViewButton.style.display = "block";
            gridViewButton.style.display = "none";
            mainViewContent.classList.add("flexContent");
            mainViewContent.classList.remove("gridContent");
        };

        const switchToGridView = () => {
            listViewButton.style.display = "none";
            gridViewButton.style.display = "block";
            mainViewContent.classList.remove("flexContent");
            mainViewContent.classList.add("gridContent");
        };

        // Local storage logic
        if (localStorage.getItem("view") !== "grid") {
            switchToListView();
        } else {
            switchToGridView();
        }

        // Button click logic
        gridViewButton.addEventListener("click", () => {
            localStorage.setItem("view", "list");
            switchToListView();
        });

        listViewButton.addEventListener("click", () => {
            localStorage.setItem("view", "grid");
            switchToGridView();
        });

        // Responsive Filter Section
        const filterSec = document.querySelector(".filtersec");
        const filterNotes = document.querySelector(".filterNotes");
        const crossSection = document.querySelector("#crosssection");
        const filterSection = document.querySelector("#filterSection");

        filterSec.style.left = "-350px";

        const toggleSection = () => {
            filterSec.style.left = filterSec.style.left === "-350px" ? "0px" : "-350px";
            filterSection.style.display =
                filterSec.style.left === "-350px" ? "none" : "block";
        };

        filterNotes.addEventListener("click", () => {
            if (window.innerWidth < 940) {
                toggleSection();
            }
        });

        crossSection.addEventListener("click", toggleSection);
        filterSection.addEventListener("click", toggleSection);

        let sem = `<option value="">Select Semester</option>
            <option value='1' <?php echo (isset($_GET['sem']) && $_GET['sem'] == 1) ? 'selected' : ''; ?> >First Semester</option>
            <option value='2' <?php echo (isset($_GET['sem']) && $_GET['sem'] == 2) ? 'selected' : ''; ?> >Second Semester</option>
            <option value='3' <?php echo (isset($_GET['sem']) && $_GET['sem'] == 3) ? 'selected' : ''; ?> >Third Semester</option>
            <option value='4' <?php echo (isset($_GET['sem']) && $_GET['sem'] == 4) ? 'selected' : ''; ?> >Fourth Semester</option>
            <option value='5' <?php echo (isset($_GET['sem']) && $_GET['sem'] == 5) ? 'selected' : ''; ?> >Fifth Semester</option>
            <option value='6' <?php echo (isset($_GET['sem']) && $_GET['sem'] == 6) ? 'selected' : ''; ?> >Sixth Semester</option>
            <option value='7' <?php echo (isset($_GET['sem']) && $_GET['sem'] == 7) ? 'selected' : ''; ?> >Seventh Semester</option>
            <option value='8' <?php echo (isset($_GET['sem']) && $_GET['sem'] == 8) ? 'selected' : ''; ?> >Eighth Semester</option>
                    `;

        let year = `<option value="">Select Year</option>    
        <option value='1' <?php echo (isset($_GET['year']) && $_GET['year'] == 1) ? 'selected' : ''; ?>>First Year</option>
        <option value='2' <?php echo (isset($_GET['year']) && $_GET['year'] == 2) ? 'selected' : ''; ?>>Second Year</option>
        <option value='3' <?php echo (isset($_GET['year']) && $_GET['year'] == 3) ? 'selected' : ''; ?>>Third Year</option>
        <option value='4' <?php echo (isset($_GET['year']) && $_GET['year'] == 4) ? 'selected' : ''; ?>>Fourth Year</option>

                   `;

        // setting year and sem
        const semyear = document.getElementById("semyearsel");
        const initialval = document.querySelector("#mySelect option");

        let initialvaltype = initialval.getAttribute("data-yearsem");
        let HTML = Number(initialvaltype) === 1 ? year : sem;

        // changing faculty value;
        function myFunction() {
            var selectElement = document.getElementById("mySelect");
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            let type = selectedOption.getAttribute("data-yearsem");
            if (Number(type) === 1) {
                semyear.setAttribute("name", "year");
                HTML = year;
            } else {
                semyear.setAttribute("name", "sem");
                HTML = sem;
            }
            semyear.innerHTML = HTML;
        }





        // =======================================================================
        var pdfModal = document.getElementById("pdfModalContent");
        var pdfViewer = document.getElementById("pdfViewer");
        var closeBtn = document.getElementsByClassName("close")[0];

        const viewIconClick = (url, postDes, noteName, date, streamName) => {
            const noteNameHTML = document.getElementById("noteName");
            const author = document.getElementById("author");
            const dateHTML = document.getElementById("date");
            const des = document.getElementById("des");
            const stream = document.getElementById("stream");
            const desdata = document.getElementById("desdata");


            var pdfUrl = url;
            pdfViewer.src = pdfUrl;
            pdfModal.style.display = "block";
            des.innerText = postDes[0].toUpperCase() + postDes.slice(1);
            noteNameHTML.innerText = noteName[0].toUpperCase() + noteName.slice(1);
            author.innerText = "Gaurab";
            dateHTML.innerText = date;
            stream.innerText = streamName[0].toUpperCase() + streamName.slice(1);;


            desdata.style.display = "flex";
            if (postDes.length > 40) {
                desdata.style.flexDirection = "column";
            } else {
                desdata.style.flexDirection = "row";
            }
            desdata.style.gap = "5px";
        }


        closeBtn.addEventListener("click", function() {
            pdfModal.style.display = "none";
        });




        // ======================== for like implementation =================
        // sending data into backend for like post
        const likeBtnclk = async (postId, userId) => {
            if (userId < 1) {
                window.location.href = 'http://localhost/e_notebook/auth/login.php';
            } else {
                const like = document.getElementById(`like${postId}`);
                if (like.classList.contains('liked')) {
                    like.classList.remove('liked');
                } else {
                    like.classList.add('liked');
                }

                try {
                    const response = await fetch('./server/Notes/filelikeupdate.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            postId: postId,
                            userId: userId,
                        }),
                    });

                    const data = await response.json();
                    if (data.success) {
                        let counterLike = document.getElementById(`counterLike${data.postId}`)
                        counterLike.innerText = data.likeCount
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            }
        };



        // ========================= for scroll down to view pdf ========================

        const viewDownPDF = () => {
            const modalContent = document.querySelector(".modal-content");
            modalContent.scrollBy(0, 600);
        };

        const pageLoad = () => {
            var url = window.location.href;

            // Remove all parameters
            var cleanURL = url.split('?')[0];

            // Update the URL
            window.history.replaceState({}, document.title, cleanURL);
            window.location.reload()
        }


        // Get the current URL
        const currentUrlForBroom = window.location.href;

        // Check if the URL has parameters
        const hasParamsForB = currentUrlForBroom.includes('?');

        if (hasParamsForB) {
            document.getElementById("mainBroomDiv").style.display = "block";
            document.getElementById("searchNotes").style.width = "91%";
        } else {
            document.getElementById("mainBroomDiv").style.display = "none";
            document.getElementById("searchNotes").style.width = "95%";
        }
    </script>
</body>

</html>