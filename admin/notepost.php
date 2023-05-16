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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-NoteBook Note Post</title>
    <!-- for CSS Style  -->
    <link rel="stylesheet" href="../Client/styles/global.css">
    <link rel="stylesheet" href="./css/stylesa.css">
    <link rel="stylesheet" href="./CSS/faculitya.css">
    <link rel="stylesheet" href="./CSS/notepost.css">

    <!-- for JS Logic  -->
    <script src="./logic/sidenavs.js" defer></script>
    <script src="./logic/notepost.js" defer></script>
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
                    <tr>
                        <td>1</td>
                        <td>My name is gaurab</td>
                        <td>BCA</td>
                        <td>1st sem</td>
                        <td>Digital Logic</td>
                        <td>Chapter 1: Introduction this lorem </td>
                        <td class='edit twoBtn' id='editbtn'>
                            <svg id='editbtn' width='17' height='17' viewBox='0 0 25 24'
                                xmlns='http://www.w3.org/2000/svg'>
                                <path
                                    d='M22.5 8.75V7.5L15 0H2.5C1.1125 0 0 1.1125 0 2.5V20C0 21.3875 1.125 22.5 2.5 22.5H10V20.1625L20.4875 9.675C21.0375 9.125 21.7375 8.825 22.5 8.75ZM13.75 1.875L20.625 8.75H13.75V1.875ZM24.8125 13.9875L23.5875 15.2125L21.0375 12.6625L22.2625 11.4375C22.5 11.1875 22.9125 11.1875 23.1625 11.4375L24.8125 13.0875C25.0625 13.3375 25.0625 13.75 24.8125 13.9875ZM20.1625 13.5375L22.7125 16.0875L15.05 23.75H12.5V21.2L20.1625 13.5375Z' />
                            </svg>
                        </td>
                        <td class='delete twoBtn'>
                            <a name='deletebtn' $row[" id"] . "\">
                                <svg width='17' height='17' viewBox='0 0 20 23' xmlns='http://www.w3.org/2000/svg'>
                                    <path
                                        d='M6.25 0V1.25H0V3.75H1.25V20C1.25 20.663 1.51339 21.2989 1.98223 21.7678C2.45107 22.2366 3.08696 22.5 3.75 22.5H16.25C16.913 22.5 17.5489 22.2366 18.0178 21.7678C18.4866 21.2989 18.75 20.663 18.75 20V3.75H20V1.25H13.75V0H6.25ZM6.25 6.25H8.75V17.5H6.25V6.25ZM11.25 6.25H13.75V17.5H11.25V6.25Z' />
                                </svg>
                            </a>
                        </td>
                    </tr>
                </table>

                <div class="pagination">
                    <a href="#" class="leftArrow">&laquo;</a>
                    <a href="#">1</a>
                    <a href="#" class="activePage">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#" class="rightArrow">&raquo;</a>
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
                <form action="#" method="get" id="forms">
                    <h3>Add Faculty:</h3>
                    <!-- <input type="hidden" name="idnum" value="<?php echo $idnum; ?>"> -->
                    <div id="forms" class="flex">
                        <label for="fname">Enter Post Description:</label>
                        <textarea name="description" id="" cols="30" rows="10"
                            placeholder="Enter Note Description..."></textarea>
                    </div>
                    <div class='flexButtons'>

                        <div id="forms" class="flex fbselectStr">
                            <label for="stdType">Select Stream:</label>
                            <select name="facultyid" id="mySelect" onchange="myFunction()"
                                style="padding: 11px; border-radius: 3px">
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
                        <div id="forms" class="flex fbselectStr">
                            <label for="stdType">Select Grade:</label>
                            <select id='semyearsel'>
                                <option>Select Semester</option>
                            </select>
                        </div>



                    </div>
                    <div class='flexButtons'>
                        <div id="forms" class="flex fbselectStr">
                            <label for="stdType">Subject Name:</label>
                            <select name="subject" id="subject">
                                <option value="">Select Subject</option>
                            </select>
                        </div>
                        <div id="forms" class="flex fbselectStr">
                            <label for="image">Select Image:</label>
                            <input type="file" name="image" id="image" accept="application/pdf">

                        </div>
                    </div>
                    <div id="forms" class="flex">
                        <label for="noteName">Enter Note Name:</label>
                        <input type="text" name="noteName" id="noteName" placeholder="Enter Note Name">
                    </div>
                    <div id=" forms" class="buttonformFac">
                        <button type='submit' name='updateadd'>Post</button>
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
        xhr.onreadystatechange = function () {
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

        let sem = `<option>Select Semester</option>
                    <option value='1'>First Semester</option>
                    <option value='2'>Second Semester</option>
                    <option value='3'>Third Semester</option>
                    <option value='4'>Fourth Semester</option>
                    <option value='5'>Fifth Semester</option>
                    <option value='6'>Sixth Semester</option>
                    <option value='7'>Seventh Semester</option>
                    <option value='8'>Eighth Semester</option>
                    `;

        let year = `<option>Select Year</option>    
                    <option value='1'>First Year</option>
                    <option value='2'>Second Year</option>
                    <option value='3'>Third Year</option>
                    <option value='4'>Fourth Year</option>
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
    // let type = myFunction();
    </script>

</body>

</html>