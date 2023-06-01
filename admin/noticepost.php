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

$sqlNoticeGet = "SELECT * FROM `news`";
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
    <link rel="stylesheet" href="./css/faculity.css">
    <link rel="stylesheet" href="./CSS/noticepost.css">
    <link rel="stylesheet" href="./CSS/modal.css">



    <!-- for JS Logic  -->
    <script src="./logic/sidenavs.js" defer></script>
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
                            echo "<img width='30' height='30' alt='postImg' src='" . $row['image'] . "' style='border-radius: 50%;'/>";
                        } else {
                            echo "-";
                        }
                        echo "</td>
        <td>{$row['stream']}</td>
        <td>{$row['author']}</td>
        <td class='edit' id='editbtn'>
            <svg id='modalOpen' onclick='modalOpen(" . $row['id'] . ")'  width='17' height='17' viewBox='0 0 25 24' xmlns='http://www.w3.org/2000/svg'>
                <path d='M22.5 8.75V7.5L15 0H2.5C1.1125 0 0 1.1125 0 2.5V20C0 21.3875 1.125 22.5 2.5 22.5H10V20.1625L20.4875 9.675C21.0375 9.125 21.7375 8.825 22.5 8.75ZM13.75 1.875L20.625 8.75H13.75V1.875ZM24.8125 13.9875L23.5875 15.2125L21.0375 12.6625L22.2625 11.4375C22.5 11.1875 22.9125 11.1875 23.1625 11.4375L24.8125 13.0875C25.0625 13.3375 25.0625 13.75 24.8125 13.9875ZM20.1625 13.5375L22.7125 16.0875L15.05 23.75H12.5V21.2L20.1625 13.5375Z' />
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

            const img = `<img src="${oneData[0].image}" alt="" style="min-height: 370px; max-width: 360px; min-width: 450px; margin: 0px auto;">`

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