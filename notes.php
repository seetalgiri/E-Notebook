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
$sqlNote = "SELECT * FROM notes LIMIT $offset, $recordsPerPage";
$resultNotes = mysqli_query($con, $sqlNote);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./Client/images/logo.png" type="image/icon type">
    <title>E-Notebook Notes</title>
    <!-- ==================== CSS Imported ======================== -->
    <!-- for globala.css  -->
    <link rel="stylesheet" href="./Client/styles/globala.css" />
    <!-- common css  -->
    <link rel="stylesheet" href="./Client/styles/style.css" />
    <link rel="stylesheet" href="./Client/styles/navigation.css" />
    <!-- for nav css  -->
    <link rel="stylesheet" href="./Client/styles/navstyle.css" />
    <link rel="stylesheet" href="./Client/styles/notea.css" />

    <!-- ==================== JS Imported ======================== -->
    <script src="./Client/logic/notes.js" defer></script>


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
                            <div class="topics"><span>Stream:</span> <span>BCA</span></div>
                            <div class="topics">
                                <span>Semester/Year:</span> <span>1st Semester</span>
                            </div>
                            <div class="topics">
                                <span>Subject:</span><span> CFA (Computer fundamental and application)</span>
                            </div>
                        </div>
                        <div class="borderLines"></div>
                        <div class="headings mt-20px">
                            <div class="heading shadow">Filter Notes:</div>
                        </div>
                        <form action="#" class="FilterNotes">
                            <div id="forms" class="flex">
                                <select name="facultyid" id="mySelect" onchange="myFunction()">
                                    <option value="">Select Stream</option>
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
                                <select id='semyearsel'>
                                </select>
                            </div>

                            <select name="subject" id="subject">
                                <option value="">Select Subject</option>
                            </select>
                            <button class="filterBTn">Filter</button>
                        </form>
                        <div class="borderLines"></div>
                        <div class="headings mt-20px">
                            <div class="heading shadow">Remember:</div>
                        </div>
                        <div class="disremember">
                            For better quality notes, choose stream, semester or year, and
                            subject in that order. Thank you!
                        </div>
                    </div>
                </div>

                <div id="actualNote" class="bl-thin">
                    <div class="headingsChapter">
                        <h3 class="HeadingPage">Notes:</h3>
                        <form id="searchNotes" class="shadow">
                            <?php include './Client/Common/filterSVG.php'; ?>
                            <input type="text" name="search" id="search" placeholder="Search Notes..." />
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
                    </div>
                    <div class="linecontentNote"></div>
                    <!-- <div class="flexContent"> -->
                    <div id="mainViewContent" class="gridContent">
                        <?php
                        while ($row = mysqli_fetch_assoc($resultNotes)) {
                            $postDes = $row['post_des'] != "" ? $row['post_des'] : "-";
                            $noteName = $row['note_name'] != "" ? $row['note_name'] : "-";
                            $noteId = $row['id'];
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
                                        <div class="likecontent">
                                            <svg width="17" height="15" viewBox="0 0 20 21" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 18.35L8.55 17.03C3.4 12.36 0 9.27 0 5.5C0 2.41 2.42 0 5.5 0C7.24 0 8.91 0.81 10 2.08C11.09 0.81 12.76 0 14.5 0C17.58 0 20 2.41 20 5.5C20 9.27 16.6 12.36 11.45 17.03L10 18.35Z" />
                                            </svg>
                                            <span class="likecount">101</span>
                                        </div>
                                        <a href=' . $row['note_file'] . ' target="blank">
                                        <svg width="20" height="14" viewBox="0 0 18 12" style="margin-right:6px;" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 3.75C8.40326 3.75 7.83097 3.98705 7.40901 4.40901C6.98705 4.83097 6.75 5.40326 6.75 6C6.75 6.59674 6.98705 7.16903 7.40901 7.59099C7.83097 8.01295 8.40326 8.25 9 8.25C9.59674 8.25 10.169 8.01295 10.591 7.59099C11.0129 7.16903 11.25 6.59674 11.25 6C11.25 5.40326 11.0129 4.83097 10.591 4.40901C10.169 3.98705 9.59674 3.75 9 3.75ZM9 9.75C8.00544 9.75 7.05161 9.35491 6.34835 8.65165C5.64509 7.94839 5.25 6.99456 5.25 6C5.25 5.00544 5.64509 4.05161 6.34835 3.34835C7.05161 2.64509 8.00544 2.25 9 2.25C9.99456 2.25 10.9484 2.64509 11.6517 3.34835C12.3549 4.05161 12.75 5.00544 12.75 6C12.75 6.99456 12.3549 7.94839 11.6517 8.65165C10.9484 9.35491 9.99456 9.75 9 9.75ZM9 0.375C5.25 0.375 2.0475 2.7075 0.75 6C2.0475 9.2925 5.25 11.625 9 11.625C12.75 11.625 15.9525 9.2925 17.25 6C15.9525 2.7075 12.75 0.375 9 0.375Z" />
                                        </svg>
                                        </a>
                                         <a href=' . $row['note_file'] . ' download=' . $row['note_name'] . ".pdf" . '>
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

    <script>
        let data = [];
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "./Server/subjectName.php", true);
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
    </script>
</body>

</html>