<?php
$show_notification = false;

<<<<<<< HEAD
if (isset($_GET['error'])) {
    echo '<div class="fullcontainerToast">
    <div class="toastifier">
        <div class="toastifierContent errorToast ">
        <div class="cross" onclick="crossClk()">X</div>

        <div class="innercontent">
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


=======
>>>>>>> 630326700dad90d9b2eafaa435850f2fe7beb352
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

<<<<<<< HEAD


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


$sqlNoticeGet = "SELECT news.*, auth.name as author FROM `news` JOIN `auth` ON auth.id = news.authid ORDER BY news.id DESC LIMIT $offset, $recordsPerPage";
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
        // header("Location: " . $_SERVER['PHP_SELF']);
        header("Location: " . $_SERVER['PHP_SELF'] . '?success=Notice deleted');
        exit(); // Make sure to exit after the redirect
    } else {
        header("Location: " . $_SERVER['PHP_SELF'] . '?error=can not delete Notice');
        // echo "Error deleting note: " . mysqli_error($con);
    }
    // Close the database connection
    mysqli_close($con);
}


// Retrieve the search value from the GET request]
if (isset($_GET['search'])) {
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // Escape the search value to prevent SQL injection
    $search = mysqli_real_escape_string($con, $search);

    // Check if the search value is set
    if (!empty($search)) {
        // Query with the search value
        $sqlNote = "SELECT news.*, auth.name as author
        FROM `news`
        JOIN `auth` ON auth.id = news.authid
        WHERE `postdes` LIKE '%$search%'
        ORDER BY news.date DESC
        ";
    } else {
        // Query without the search value
        $sqlNote = "SELECT news.*, auth.name as author FROM `news` JOIN `auth` ON auth.id = news.authid ORDER BY news.date DESC";
    }

    $resNoticeGet = mysqli_query($con, $sqlNote);

}



?>


=======
?>
>>>>>>> 630326700dad90d9b2eafaa435850f2fe7beb352
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Notebook Notice Post</title>
    <link rel="stylesheet" href="../Client/styles/global.css">
<<<<<<< HEAD
    <link rel="stylesheet" href="./css/stylesa.css">
    <link rel="stylesheet" href="./css/faculity.css">
    <link rel="stylesheet" href="./CSS/noticepost.css">
    <link rel="stylesheet" href="./CSS/modal.css">



    <!-- for JS Logic  -->
    <script src="./logic/sidenav.js" defer></script>
=======
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/faculity.css">
    <link rel="stylesheet" href="./CSS/noticepost.css">


    <!-- for JS Logic  -->
    <script src="./logic/sidenavs.js" defer></script>
>>>>>>> 630326700dad90d9b2eafaa435850f2fe7beb352
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
<<<<<<< HEAD
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
            <a name='deletebtn' onclick='deleteBtnClk(" . $row['id'] . ")'> 
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
=======
                        <th colspan="2">Action</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>THis is me gaurab sunar</td>
                        <td>Year</td>
                        <td>BCA</td>
                        <td class='edit' id='editbtn'>
                            <svg id='editbtn' width='17' height='17' viewBox='0 0 25 24'
                                xmlns='http://www.w3.org/2000/svg'>
                                <path
                                    d='M22.5 8.75V7.5L15 0H2.5C1.1125 0 0 1.1125 0 2.5V20C0 21.3875 1.125 22.5 2.5 22.5H10V20.1625L20.4875 9.675C21.0375 9.125 21.7375 8.825 22.5 8.75ZM13.75 1.875L20.625 8.75H13.75V1.875ZM24.8125 13.9875L23.5875 15.2125L21.0375 12.6625L22.2625 11.4375C22.5 11.1875 22.9125 11.1875 23.1625 11.4375L24.8125 13.0875C25.0625 13.3375 25.0625 13.75 24.8125 13.9875ZM20.1625 13.5375L22.7125 16.0875L15.05 23.75H12.5V21.2L20.1625 13.5375Z' />
                            </svg>
                        </td>
                        <td class='delete'>
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
>>>>>>> 630326700dad90d9b2eafaa435850f2fe7beb352
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
<<<<<<< HEAD
                <form action="../Server/Home/indexback.php" method="post" id="forms" enctype="multipart/form-data">
=======
                <form action="#" method="get" id="forms">
>>>>>>> 630326700dad90d9b2eafaa435850f2fe7beb352
                    <h3>Add Faculty:</h3>
                    <!-- <input type="hidden" name="idnum" value="<?php echo $idnum; ?>"> -->
                    <div id="forms" class="flex">
                        <label for="description">Enter Post Description:</label>
<<<<<<< HEAD
                        <textarea name="post" id="description" cols="30" rows="10" required></textarea>
                    </div>
                    <div id="forms" class="flex">
                        <label for="mySelect">Choose Faculty:</label>
                        <select name="stream" id="mySelect" required>
                            <option value="all">All</option>
                            <?php
                            if (mysqli_num_rows($resfac) > 0) {
                                while ($row = mysqli_fetch_assoc($resfac)) {
                                    echo "<option value='" . $row["faculity_name"] . "' data_yearsem=" . $row['yearsem'] . ">" . $row["faculity_name"] . "</option> ";
=======
                        <textarea name="description" id="description" cols="30" rows="10"></textarea>
                    </div>
                    <div id="forms" class="flex">
                        <label for="mySelect">Choose Faculty:</label>
                        <select name="facultyid" id="mySelect">
                            <?php
                            if (mysqli_num_rows($resfac) > 0) {
                                while ($row = mysqli_fetch_assoc($resfac)) {
                                    echo "<option value='" . $row["id"] . "' data_yearsem=" . $row['yearsem'] . ">" . $row["faculity_name"] . "</option> ";
>>>>>>> 630326700dad90d9b2eafaa435850f2fe7beb352
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
<<<<<<< HEAD
                        <button type='submit' name='postnewsadmin'>Post</button>
=======
                        <button type='submit' name='updateadd'>Post</button>
>>>>>>> 630326700dad90d9b2eafaa435850f2fe7beb352
                        <button type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<<<<<<< HEAD
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
            } catch (e) { }
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
                // document.body.style.overflowY = "auto";
            }
        };
        if (window.location.search.includes('error') || window.location.search.includes('success')) {
            history.replaceState({}, document.title, window.location.pathname);
            // document.body.style.overflowY = "auto";

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
            deleteLink.setAttribute("href", `./noticepost.php?delete=${id}`)
        }
        document.addEventListener("click", (elm) => {
            if (elm.target.id === "confirmModalContent") {
                cancelDelete();
            }
        })
    </script>

=======
>>>>>>> 630326700dad90d9b2eafaa435850f2fe7beb352
</body>

</html>