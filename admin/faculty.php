<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-NoteBook Faculty</title>
    <!-- for CSS Style  -->
    <link rel="stylesheet" href="../Client/styles/globald.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./CSS/faculty.css">

    <!-- for JS Logic  -->
    <script src="./logic/sidenavs.js" defer></script>
    <script src="./logic/faculity.js" defer></script>
</head>

<body>
    <?php include './common/sidenav.php' ?>
    <div id="adminContent">
        <div class="actualContent">
            <div class="contentDiv">
                <table class="faculity">
                    <tr>
                        <th class="serialname">S.N</th>
                        <th class="facname">Name</th>
                        <th>Year/Semester</th>
                        <th>Display order</th>
                        <th colspan="2">Action</th>
                    </tr>
                    <tr>
                        <td class="serialname">1</td>
                        <td class="facname">Gaurab</td>
                        <td>1st sem</td>
                        <td>3</td>
                        <td style="width:100px;">
                            <svg id='editbtn' width='17' height='17' viewBox='0 0 25 24' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M22.5 8.75V7.5L15 0H2.5C1.1125 0 0 1.1125 0 2.5V20C0 21.3875 1.125 22.5 2.5 22.5H10V20.1625L20.4875 9.675C21.0375 9.125 21.7375 8.825 22.5 8.75ZM13.75 1.875L20.625 8.75H13.75V1.875ZM24.8125 13.9875L23.5875 15.2125L21.0375 12.6625L22.2625 11.4375C22.5 11.1875 22.9125 11.1875 23.1625 11.4375L24.8125 13.0875C25.0625 13.3375 25.0625 13.75 24.8125 13.9875ZM20.1625 13.5375L22.7125 16.0875L15.05 23.75H12.5V21.2L20.1625 13.5375Z' />
                            </svg>
                        </td>
                        <td style="width:100px;"><svg width='17' height='17' viewBox='0 0 20 23' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M6.25 0V1.25H0V3.75H1.25V20C1.25 20.663 1.51339 21.2989 1.98223 21.7678C2.45107 22.2366 3.08696 22.5 3.75 22.5H16.25C16.913 22.5 17.5489 22.2366 18.0178 21.7678C18.4866 21.2989 18.75 20.663 18.75 20V3.75H20V1.25H13.75V0H6.25ZM6.25 6.25H8.75V17.5H6.25V6.25ZM11.25 6.25H13.75V17.5H11.25V6.25Z' />
                            </svg></td>
                    </tr>
                    <tr>
                        <td class="serialname">1</td>
                        <td class="facname">seetal</td>
                        <td>4th sem</td>
                        <td>3</td>
                        <td style="width:100px;">
                            <svg id='editbtn' width='17' height='17' viewBox='0 0 25 24' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M22.5 8.75V7.5L15 0H2.5C1.1125 0 0 1.1125 0 2.5V20C0 21.3875 1.125 22.5 2.5 22.5H10V20.1625L20.4875 9.675C21.0375 9.125 21.7375 8.825 22.5 8.75ZM13.75 1.875L20.625 8.75H13.75V1.875ZM24.8125 13.9875L23.5875 15.2125L21.0375 12.6625L22.2625 11.4375C22.5 11.1875 22.9125 11.1875 23.1625 11.4375L24.8125 13.0875C25.0625 13.3375 25.0625 13.75 24.8125 13.9875ZM20.1625 13.5375L22.7125 16.0875L15.05 23.75H12.5V21.2L20.1625 13.5375Z' />
                            </svg>
                        </td>
                        <td style="width:100px;"><svg width='17' height='17' viewBox='0 0 20 23' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M6.25 0V1.25H0V3.75H1.25V20C1.25 20.663 1.51339 21.2989 1.98223 21.7678C2.45107 22.2366 3.08696 22.5 3.75 22.5H16.25C16.913 22.5 17.5489 22.2366 18.0178 21.7678C18.4866 21.2989 18.75 20.663 18.75 20V3.75H20V1.25H13.75V0H6.25ZM6.25 6.25H8.75V17.5H6.25V6.25ZM11.25 6.25H13.75V17.5H11.25V6.25Z' />
                            </svg>
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

        <div id="modalContent">
            <div id="sideButton" onclick="modalBtnclk()">
                <svg width="13" height="16" viewBox="0 0 8 12" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.589844 10.58L5.16984 6L0.589844 1.41L1.99984 0L7.99984 6L1.99984 12L0.589844 10.58Z" />
                </svg>
            </div>

            <div id="sideDivForm">
                <form>
                    <h3>Add Faculty name:</h3>
                    <input type="hidden">
                    <div id="forms" class="flex">
                        <label for="fname">Enter faculty name:</label>
                        <input type="text" name="fname"  id="fname" placeholder="Name"
                            value="<?php echo $name ?>">
                    </div>
                    <div id="forms" class="flex">
                        <label for="stdType">Select Year/Semester:</label>
                        <select name="yearsem" id="stdType">
                            <option value="1">Years</option>
                            <option value="2">Semester</option>
                        </select>
                    </div>

                    <div id="semyear" class="flex">

                    </div>

                    <div id="forms" class="flex">
                        <label for="dOrder">Enter Display order:</label>
                        <input type="number" name="dOrder" required id="dOrder" placeholder="Display Order"
                            value="<?php echo $dorder; ?>">
                    </div>
                    <div id="forms" class="buttonformFac">

                        <button type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>