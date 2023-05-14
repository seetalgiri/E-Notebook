<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-NoteBook Note Post</title>
    <link rel="stylesheet" href="../Client/styles/globalsa.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./CSS/faculity.css">
    <style>
        select {
            padding: 10px;
            border: 1px solid #555;
            border-radius: 4px;
            outline: none;
            cursor: pointer !important;
            font-size: 17px !important;
        }

        td,
        th {
            min-width: 110px;
        }

        .twoBtn {
            min-width: 40px;
        }

        textarea {
            background-color: transparent;
            resize: none;
            outline: none;
            padding: 5px 10px;
            border-radius: 3px;
            color: var(--text-color-light);
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
            letter-spacing: 1px;
            height: 105px;
        }

        .NotePostModalContent {
            height: 500px !important;
        }

        .NotePostModalContent #sideDivForm {
            height: 510px !important;
        }

        .flexButtons {
            display: flex !important;
            flex: row !important;
            gap: 5px !important;
        }

        .fbselectStr {
            width: 50% !important;
        }

        #sideDivForm form {
            width: 90%;
        }

        #modalContent {
            width: 500px !important;
        }
    </style>
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
                <form action="./faculty.php" method="post" id="forms">
                    <h3>Add Faculty:</h3>
                    <input type="hidden" name="idnum" value="<?php echo $idnum; ?>">
                    <div id="forms" class="flex">
                        <label for="fname">Enter Post Description:</label>
                        <textarea name="" id="" cols="30" rows="10" placeholder="Enter Note Description..."></textarea>
                    </div>
                    <div class='flexButtons'>
                        <div id="forms" class="flex fbselectStr">
                            <label for="stdType">Select Stream:</label>
                            <select name="yearsem" id="stdType">
                                <option value="1">ALL</option>
                                <option value="2">BCA</option>
                                <option value="2">BBM</option>
                                <option value="2">BSW</option>
                            </select>
                        </div>
                        <div id="forms" class="flex fbselectStr">
                            <label for="stdType">Select Grade:</label>
                            <select name="yearsem" id="stdType">
                                <option value="1">First Year</option>
                                <option value="2">Second Year</option>
                                <option value="2">Third Year</option>
                                <option value="2">Fourth Year</option>
                            </select>
                        </div>
                    </div>
                    <div class='flexButtons'>
                        <div id="forms" class="flex fbselectStr">
                            <label for="stdType">Subject Name:</label>
                            <select name="yearsem" id="stdType">
                                <option value="1">CFA</option>
                                <option value="2">DL</option>
                                <option value="2">Math</option>
                                <option value="2">Social</option>
                                <option value="2">English</option>
                            </select>
                        </div>
                        <div id="forms" class="flex fbselectStr">
                            <label for="image">Select Image:</label>
                            <input type="file" name="image" id="image" accept="image">
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
        const modalContent = document.getElementById("modalContent");
        const svgbtn = document.querySelector("#sideButton svg");
        modalContent.style.right = '-475px';
        svgbtn.style.transform = '  rotateZ(180deg)';

        function modalBtnclk() {
            if (modalContent.style.right === "0px") {
                modalContent.style.right = '-475px';
                svgbtn.style.transform = 'rotateZ(180deg)';
            } else {
                modalContent.style.right = '0px';
                svgbtn.style.transform = 'rotateZ(0deg)';
            }
        }

        window.onclick = function (event) {
            const parentId = event.target.parentNode.id;
            const par = event.target;
            if (event.target.id !== "forms" && parentId !== 'sidenav' && parentId !== 'sideButton' && parentId !==
                "modalContent" && parentId !== "forms" && parentId !== "editbtn") {
                if (modalContent.style.right !== '-475px') {
                    modalContent.style.right = '-475px';
                    svgbtn.style.transform = 'rotateZ(180deg)';
                }
            }


            const parentId1 = event.target.parentNode.id;
            const parentId2 = event.target.parentNode.id;
            if (event.target.id !== 'sidenav' && event.target.id !== 'hamburger' && parentId1 !== "hamburger" &&
                parentId2 !== "sideNavLikes") {
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
            openmodal();
        }
    </script>

</body>

</html>