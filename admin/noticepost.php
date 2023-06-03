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
$querytotalnumberROw = "SELECT COUNT(*) as total FROM news";
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
$sqlNoticeGet = "SELECT * FROM news LIMIT $offset, $recordsPerPage";
$resNoticeGet = mysqli_query($con, $sqlNoticeGet);




// for delete functionality 
if (isset($_GET['delete'])) {
    // Retrieve the note ID from the URL parameter
    $postId = $_GET['delete'];

    // Prepare the delete query
    $deleteQuery = "DELETE FROM news WHERE id = $postId";

    // Execute the delete query
    if (mysqli_query($con, $deleteQuery)) {
        // Redirect to the same page without the delete parameter
        header("Location: " . $_SERVER['PHP_SELF']);
        exit(); // Make sure to exit after the redirect
    } else {
        echo "Error deleting note: " . mysqli_error($con);
    }
    // Close the database connection
    mysqli_close($con);
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Notebook Notice Post</title>
    <link rel="stylesheet" href="../Client/styles/global.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/faculitys.css">
    <link rel="stylesheet" href="./CSS/noticepost.css">
    <link rel="stylesheet" href="./CSS/modal.css">



    <!-- for JS Logic  -->
    <script src="./logic/sidenav.js" defer></script>
    <script src="./logic/noticepost.js" defer></script>
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
                        <th>Image</th>
                        <th>Faculty</th>
                        <th>User</th>
                        <th colspan="2">Action</th>
                    </tr>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($resNoticeGet)) {
                        echo "
    <tr>
        <td>" . $i . "</td>
        <td>" . (strlen($row['postdes']) > 50 ? substr($row['postdes'], 0, 50) . '...' : $row['postdes']) . "</td>
        <td>";
                        if (!empty($row['image'])) {
                            echo "<img width='30' height='30' loading='lazy' alt='postImg' src='" . $row['image'] . "' style='border-radius: 50%;'/>";
                        } else {
                            echo "-";
                        }
                        echo "</td>
        <td>{$row['stream']}</td>
        <td>{$row['author']}</td>
        <td class='edit' id='editbtn'>
            
            <svg id='modalOpen' onclick='modalOpen(" . $row['id'] . ")' width='20' height='15' viewBox='0 0 23 16' xmlns='http://www.w3.org/2000/svg'>
            <path d='M11.868 5.40091C11.0724 5.40091 10.3093 5.71698 9.74671 6.27959C9.1841 6.8422 8.86803 7.60526 8.86803 8.40091C8.86803 9.19656 9.1841 9.95962 9.74671 10.5222C10.3093 11.0848 11.0724 11.4009 11.868 11.4009C12.6637 11.4009 13.4267 11.0848 13.9893 10.5222C14.552 9.95962 14.868 9.19656 14.868 8.40091C14.868 7.60526 14.552 6.8422 13.9893 6.27959C13.4267 5.71698 12.6637 5.40091 11.868 5.40091ZM11.868 13.4009C10.5419 13.4009 9.27017 12.8741 8.33249 11.9364C7.39481 10.9988 6.86803 9.72699 6.86803 8.40091C6.86803 7.07483 7.39481 5.80306 8.33249 4.86538C9.27017 3.92769 10.5419 3.40091 11.868 3.40091C13.1941 3.40091 14.4659 3.92769 15.4036 4.86538C16.3412 5.80306 16.868 7.07483 16.868 8.40091C16.868 9.72699 16.3412 10.9988 15.4036 11.9364C14.4659 12.8741 13.1941 13.4009 11.868 13.4009ZM11.868 0.900909C6.86803 0.900909 2.59803 4.01091 0.868027 8.40091C2.59803 12.7909 6.86803 15.9009 11.868 15.9009C16.868 15.9009 21.138 12.7909 22.868 8.40091C21.138 4.01091 16.868 0.900909 11.868 0.900909Z' />

            </svg>
        </td>
        <td class='delete'>
            <a name='deletebtn' href=?delete=" . $row['id'] . ">
                <svg width='17' height='17' viewBox='0 0 20 23' xmlns='http://www.w3.org/2000/svg'>
                    <path d='M6.25 0V1.25H0V3.75H1.25V20C1.25 20.663 1.51339 21.2989 1.98223 21.7678C2.45107 22.2366 3.08696 22.5 3.75 22.5H16.25C16.913 22.5 17.5489 22.2366 18.0178 21.7678C18.4866 21.2989 18.75 20.663 18.75 20V3.75H20V1.25H13.75V0H6.25ZM6.25 6.25H8.75V17.5H6.25V6.25ZM11.25 6.25H13.75V17.5H11.25V6.25Z' />
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
        <div id="modalContent">
            <div id="sideButton" onclick="modalBtnclk()">
                <svg width="13" height="16" viewBox="0 0 8 12" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.589844 10.58L5.16984 6L0.589844 1.41L1.99984 0L7.99984 6L1.99984 12L0.589844 10.58Z" />
                </svg>
            </div>
            <div id="sideDivForm" class='noticePost'>
                <form action="../Server/Home/indexback.php" method="post" id="forms" enctype="multipart/form-data">
                    <h3>Add Faculty:</h3>
                    <!-- <input type="hidden" name="idnum" value="<?php echo $idnum; ?>"> -->
                    <div id="forms" class="flex">
                        <label for="description">Enter Post Description:</label>
                        <textarea name="post" id="description" cols="30" rows="10"></textarea>
                    </div>
                    <div id="forms" class="flex">
                        <label for="mySelect">Choose Faculty:</label>
                        <select name="stream" id="mySelect">
                            <option value="all">All</option>
                            <?php
                            if (mysqli_num_rows($resfac) > 0) {
                                while ($row = mysqli_fetch_assoc($resfac)) {
                                    echo "<option value='" . $row["faculity_name"] . "' data_yearsem=" . $row['yearsem'] . ">" . $row["faculity_name"] . "</option> ";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div id="forms" class="flex">
                        <label for="image">Select Image:</label>
                        <input type="file" name="image" id="image" accept="image/png, image/jpeg, image/jpg">
                    </div>

                    <div id=" forms" class="buttonformFac">
                        <button type='submit' name='postnewsadmin'>Post</button>
                        <button type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modal">
        <div id="background">
            <div id="contentModal" style="height: 600px !important;">

                <div class="ModalHead">
                    <button id="crossModal">X</button>
                    <div class="formContent">
                        Post From <span id="reqUserName"></span>
                    </div>
                </div>
                <div id="mainCOntent">
                    <div class="itemContentmodal">
                        <div class="shadow streamsmalldiv">
                            <span class="head">Faculty:</span>
                            <span class="dis" id="reqstreamcontent">-</span>
                        </div>
                        <div class="shadow streamsmalldiv">
                            <span class="head">User Name:</span>
                            <span class="dis" id="reqSemYearContent">-</span>
                        </div>
                    </div>

                    <div class="shadow streambigdiv" style="max-height: 100px!important; overflow: hidden;">
                        <span class="head">Description:</span>
                        <span class="dis" id="reqdescriptionContent">-</span>
                    </div>
                    <div id="imageDIvforModal" style="display: flex; align-items: center; justify-content: center;">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById("modal");
        const crossModal = document.getElementById("crossModal");
        const background = document.getElementById('background');
        const params = new URLSearchParams(window.location.search);

        const modalOpen = async (id) => {
            const data = await fetchData()
            const reqUserName = document.getElementById("reqUserName");
            const imageDIvforModal = document.getElementById("imageDIvforModal");
            const reqdescriptionContent = document.getElementById("reqdescriptionContent");
            const reqSemYearContent = document.getElementById("reqSemYearContent");
            const reqstreamcontent = document.getElementById("reqstreamcontent");
            const oneData = data.filter((e) => e.id == id)

            const img = `<img src="${oneData[0].image}" loading='lazy' alt="" style="min-height: 370px; max-width: 360px; min-width: 450px; margin: 0px auto;">`

            reqUserName.innerText = oneData[0].author;
            imageDIvforModal.innerHTML = img;
            reqdescriptionContent.innerText = String(oneData[0].postdes).length > 180 ? oneData[0].postdes + "..." : oneData[0].postdes;
            reqSemYearContent.innerText = oneData[0].author;
            reqstreamcontent.innerText = oneData[0].stream;
            modal.style.display = "block";
        }
        crossModal.addEventListener('click', () => {
            modal.style.display = "none";
        });

        const fetchData = async (showType) => {
            try {
                const response = await fetch('http://localhost/e_notebook/Server/Home/indexdataget.php');
                const data = await response.json();
                let finalData = data.data.reverse()
                return finalData;
            } catch (e) {
                console.log(e)
            }
        }
    </script>

</body>

</html>