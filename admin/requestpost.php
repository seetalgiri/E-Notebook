<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-NoteBook Request Post</title>
    <link rel="stylesheet" href="../Client/styles/global.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/faculity.css">
    <link rel="stylesheet" href="./CSS/requestpost.css">
    <link rel="stylesheet" href="./CSS/modal.css">

    <!-- for JS Logic  -->
    <script src="./logic/sidenavs.js" defer></script>
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
                            <svg id="modalOpen" width='20' height='15' viewBox='0 0 23 16' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M11.868 5.40091C11.0724 5.40091 10.3093 5.71698 9.74671 6.27959C9.1841 6.8422 8.86803 7.60526 8.86803 8.40091C8.86803 9.19656 9.1841 9.95962 9.74671 10.5222C10.3093 11.0848 11.0724 11.4009 11.868 11.4009C12.6637 11.4009 13.4267 11.0848 13.9893 10.5222C14.552 9.95962 14.868 9.19656 14.868 8.40091C14.868 7.60526 14.552 6.8422 13.9893 6.27959C13.4267 5.71698 12.6637 5.40091 11.868 5.40091ZM11.868 13.4009C10.5419 13.4009 9.27017 12.8741 8.33249 11.9364C7.39481 10.9988 6.86803 9.72699 6.86803 8.40091C6.86803 7.07483 7.39481 5.80306 8.33249 4.86538C9.27017 3.92769 10.5419 3.40091 11.868 3.40091C13.1941 3.40091 14.4659 3.92769 15.4036 4.86538C16.3412 5.80306 16.868 7.07483 16.868 8.40091C16.868 9.72699 16.3412 10.9988 15.4036 11.9364C14.4659 12.8741 13.1941 13.4009 11.868 13.4009ZM11.868 0.900909C6.86803 0.900909 2.59803 4.01091 0.868027 8.40091C2.59803 12.7909 6.86803 15.9009 11.868 15.9009C16.868 15.9009 21.138 12.7909 22.868 8.40091C21.138 4.01091 16.868 0.900909 11.868 0.900909Z' />
                            </svg>
                        </td>
                        <td class='delete twoBtn'>
                            <a name='deletebtn' $row[" id"] . "\">
                                <svg width='17' height='17' viewBox='0 0 20 23' xmlns='http://www.w3.org/2000/svg'>
                                    <path d='M6.25 0V1.25H0V3.75H1.25V20C1.25 20.663 1.51339 21.2989 1.98223 21.7678C2.45107 22.2366 3.08696 22.5 3.75 22.5H16.25C16.913 22.5 17.5489 22.2366 18.0178 21.7678C18.4866 21.2989 18.75 20.663 18.75 20V3.75H20V1.25H13.75V0H6.25ZM6.25 6.25H8.75V17.5H6.25V6.25ZM11.25 6.25H13.75V17.5H11.25V6.25Z' />
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

    </div>
    <div id="modal">
        <div id="background">
            <div id="contentModal">

                <div class="ModalHead">
                    <button id="crossModal">X</button>
                    <div class="formContent">
                        Post Request From <span id="reqUserName">Gaurab sunar</span>
                    </div>
                </div>
                <div id="mainCOntent">
                    <div class="itemContentmodal">
                        <div class="shadow streamsmalldiv">
                            <span class="head">Stream:</span>
                            <span class="dis" id="reqstreamcontent">BCA</span>
                        </div>
                        <div class="shadow streamsmalldiv">
                            <span class="head">Sem/Year:</span>
                            <span class="dis" id="reqSemYearContent">1st Sem</span>
                        </div>
                    </div>
                    <div class="itemContentmodal">
                        <div class="shadow streamsmalldiv">
                            <span class="head">Sub Name:</span>
                            <span class="dis" id="reqsubnameContent">CFA </span>
                        </div>
                        <div class="shadow streamsmalldiv">
                            <span class="head">Note Name:</span>
                            <span class="dis" id="reqnoteNameContent">Chapter1: Intorduction </span>
                        </div>
                    </div>
                    <div class="shadow streamsmalldiv filesizeshow">
                        <span class="head">File:</span>
                        <span class="dis">Chapter1: Intorduction </span>

                        <div id="downloadstreamfile">
                            <svg width="15" height="18" viewBox="0 0 15 18" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.250732 17.4755H14.2507V15.4755H0.250732M14.2507 6.47546H10.2507V0.475464H4.25073V6.47546H0.250732L7.25073 13.4755L14.2507 6.47546Z" />
                            </svg>

                        </div>
                    </div>
                    <div class="shadow streambigdiv">
                        <span class="head">Description:</span>
                        <span class="dis" id="reqdescriptionContent">Lorem ipsum dolor sit amet consectetur, adipisicing
                            elit. Deserunt a,
                            consectetur reprehenderit tempore eligendi aliquam libero dolorem corporis. Quis,
                            distinctio. </span>
                    </div>
                    <div class="itemContentmodal">
                        <div class="shadow streamsmalldiv buttonsModal rejectreq"><button>Rejected</button></div>
                        <div class="shadow streamsmalldiv buttonsModal" onclick="AcceptBtnClk()">
                            <button>Accepted</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const modal = document.getElementById("modal");
        const modalOpen = document.getElementById("modalOpen");
        const crossModal = document.getElementById("crossModal");
        const background = document.getElementById('background');
        const params = new URLSearchParams(window.location.search);
        modalOpen.addEventListener("click", () => {
            modal.style.display = "block";
        })
        // background.addEventListener('click', () => {
        //     modal.style.display = "none";
        // });
        crossModal.addEventListener('click', () => {
            modal.style.display = "none";
        });

        function AcceptBtnClk() {
            var currentUrl = window.location.href;
            var url = new URL(currentUrl);
            url.pathname = url.pathname.replace("requestpost.php", "notepost.php");
            let reqstreamcontent = document.getElementById('reqstreamcontent').innerText;
            let reqSemYearContent = document.getElementById('reqSemYearContent').innerText;
            let reqsubnameContent = document.getElementById('reqsubnameContent').innerText;
            let reqnoteNameContent = document.getElementById('reqnoteNameContent').innerText;
            let reqdescriptionContent = document.getElementById('reqdescriptionContent').innerText;
            let reqUserName = document.getElementById('reqUserName').innerText;

            // Add additional parameters
            url.searchParams.set("description", reqdescriptionContent);
            url.searchParams.set("stream", reqstreamcontent);
            url.searchParams.set("sem_year", reqSemYearContent);
            url.searchParams.set("subname", reqsubnameContent);
            url.searchParams.set("username", reqUserName);
            url.searchParams.set("chaptername", reqnoteNameContent);
            var newUrl = url.href;
            history.pushState(null, null, newUrl);
            location.reload();
        }
    </script>
</body>

</html>