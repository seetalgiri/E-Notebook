<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Notebook Previous Questions</title>
    <!-- for global css  -->
    <link rel="stylesheet" href="./Client/styles/global.css" />

    <link rel="stylesheet" href="./Client/styles/style.css" />
    <link rel="stylesheet" href="./Client/styles/navigation.css" />

    <!-- for nav css  -->
    <link rel="stylesheet" href="./Client/styles/note.css" />
    <link rel="stylesheet" href="./Client/styles/navstyles.css" />

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
                            <div class="heading shadow">Filter Questions:</div>
                        </div>
                        <form action="#" class="FilterNotes">
                            <select name="stream" id="steram">
                                <option value="">Select Stream</option>
                                <option value="1">BCA</option>
                                <option value="2">BBM</option>
                                <option value="3">BSW</option>
                                <option value="4">MBS</option>
                            </select>
                            <select name="semYear" id="semYear">
                                <option value="">Select Year/Sem</option>
                                <option value="1">1st</option>
                                <option value="2">2nd</option>
                                <option value="3">3rd</option>
                                <option value="4">4th</option>
                            </select>
                            <select name="subject" id="subject">
                                <option value="">Select Subject</option>
                                <option value="1">BCA</option>
                                <option value="2">BBM</option>
                                <option value="3">BSW</option>
                                <option value="4">MBS</option>
                            </select>
                            <button class="filterBTn">Filter</button>
                        </form>
                        <div class="borderLines"></div>
                        <div class="headings mt-20px">
                            <div class="heading shadow">Remember:</div>
                        </div>
                        <div class="disremember">
                            For better quality previous year questions, choose stream, semester or year, and
                            subject in that order. Thank you!
                        </div>
                    </div>
                </div>

                <div id="actualNote" class="bl-thin">
                    <div class="headingsChapter">
                        <h3 class="HeadingPage">Questions Papers:</h3>
                        <div id="searchNotes">
                            <?php include './Client/Common/filterSVG.php'; ?>
                            <input type="text" name="search" id="search" placeholder="Search Previous year Questions..."
                                class="shadow" />
                            <svg width="19" height="18" viewBox="0 0 19 18" class="searchBtn"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.01221 0.316132C8.73611 0.316132 10.3894 1.00095 11.6084 2.21994C12.8274 3.43892 13.5122 5.09222 13.5122 6.81613C13.5122 8.42613 12.9222 9.90613 11.9522 11.0461L12.2222 11.3161H13.0122L18.0122 16.3161L16.5122 17.8161L11.5122 12.8161V12.0261L11.2422 11.7561C10.1022 12.7261 8.62221 13.3161 7.01221 13.3161C5.2883 13.3161 3.635 12.6313 2.41601 11.4123C1.19703 10.1933 0.512207 8.54004 0.512207 6.81613C0.512207 5.09222 1.19703 3.43892 2.41601 2.21994C3.635 1.00095 5.2883 0.316132 7.01221 0.316132ZM7.01221 2.31613C4.51221 2.31613 2.51221 4.31613 2.51221 6.81613C2.51221 9.31613 4.51221 11.3161 7.01221 11.3161C9.51221 11.3161 11.5122 9.31613 11.5122 6.81613C11.5122 4.31613 9.51221 2.31613 7.01221 2.31613Z" />
                            </svg>
                        </div>

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
                        <div class="eachBox">
                            <div class="boxcontentNote">
                                <h3>Chapter 1: Introduction to computer this is me...</h3>
                                <div class="auth">
                                    <svg width="14" height="14" viewBox="0 0 20 17" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M18.1 8.5L19.5 9.91L12.97 16.5L9.5 13L10.9 11.59L12.97 13.67L18.1 8.5ZM7 13L10 16H0V14C0 11.79 3.58 10 8 10L9.89 10.11L7 13ZM8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0Z" />
                                    </svg>

                                    <span>Author:</span> Gaurab sunar
                                </div>
                                <svg width="17" height="20" viewBox="0 0 20 21" xmlns="http://www.w3.org/2000/svg"
                                    class="bookmark">
                                    <path
                                        d="M4.82 15L9 17.28V20H2C0.89 20 0 19.11 0 18V2C0 0.9 0.89 0 2 0H3V7L5.5 5.5L8 7V0H14C15.1 0 16 0.89 16 2V10.54L14.5 9.72L4.82 15ZM20 15L14.5 12L9 15L14.5 18L20 15ZM11 17.09V19.09L14.5 21L18 19.09V17.09L14.5 19L11 17.09Z" />
                                </svg>

                                <div class="NoteAction">
                                    <div class="date"><span>Date:</span> 2023-01-01</div>
                                    <div class="svgsNote">
                                        <svg width="20" height="14" viewBox="0 0 18 12"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9 3.75C8.40326 3.75 7.83097 3.98705 7.40901 4.40901C6.98705 4.83097 6.75 5.40326 6.75 6C6.75 6.59674 6.98705 7.16903 7.40901 7.59099C7.83097 8.01295 8.40326 8.25 9 8.25C9.59674 8.25 10.169 8.01295 10.591 7.59099C11.0129 7.16903 11.25 6.59674 11.25 6C11.25 5.40326 11.0129 4.83097 10.591 4.40901C10.169 3.98705 9.59674 3.75 9 3.75ZM9 9.75C8.00544 9.75 7.05161 9.35491 6.34835 8.65165C5.64509 7.94839 5.25 6.99456 5.25 6C5.25 5.00544 5.64509 4.05161 6.34835 3.34835C7.05161 2.64509 8.00544 2.25 9 2.25C9.99456 2.25 10.9484 2.64509 11.6517 3.34835C12.3549 4.05161 12.75 5.00544 12.75 6C12.75 6.99456 12.3549 7.94839 11.6517 8.65165C10.9484 9.35491 9.99456 9.75 9 9.75ZM9 0.375C5.25 0.375 2.0475 2.7075 0.75 6C2.0475 9.2925 5.25 11.625 9 11.625C12.75 11.625 15.9525 9.2925 17.25 6C15.9525 2.7075 12.75 0.375 9 0.375Z" />
                                        </svg>
                                        <svg width="15" height="18" viewBox="0 0 13 16"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M0.958496 15.5H12.0418V13.75H0.958496M12.0418 5.875H8.87516V0.625H4.12516V5.875H0.958496L6.50016 12L12.0418 5.875Z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="filterSection"></div>
    <script>
        // for grid view logic
        // variable decletation
        const flexbuttonset = document.getElementById("flexbuttonset");
        const mainViewContent = document.getElementById("mainViewContent");
        const gridView = document.getElementById("gridView");
        const listView = document.getElementById("listView");

        // initial set view type in localstorage
        !localStorage.getItem("view") && localStorage.setItem("view", "grid");

        // actions for list view
        const listviewFun = () => {
            listView.style.display = "block";
            gridView.style.display = "none";
            mainViewContent.classList.add("flexContent");
            mainViewContent.classList.remove("gridContent");
        };
        // actions for grid view
        const gridviewFun = () => {
            listView.style.display = "none";
            gridView.style.display = "block";
            mainViewContent.classList.remove("flexContent");
            mainViewContent.classList.add("gridContent");
        };

        // localstorage logic
        if (localStorage.getItem("view") !== "grid") {
            listviewFun();
        } else {
            gridviewFun();
        }
        // button click logic
        gridView.addEventListener("click", () => {
            localStorage.setItem("view", "list");
            listviewFun();
        });
        listView.addEventListener("click", () => {
            gridviewFun();
            localStorage.setItem("view", "grid");
        });
        2;

        // for responsive filter section
        const filtersec = document.querySelector(".filtersec");
        const filterprevyrqn = document.querySelector(".filterNotes");
        const crosssection = document.querySelector("#crosssection");
        const filterSection = document.querySelector("#filterSection");
        filtersec.style.left = "-350px";
        const togglesection = () => {
            if (filtersec.style.left === "-350px") {
                filtersec.style.left = "0px";
                filterSection.style.display = "block";
            } else {
                filtersec.style.left = "-350px";
                filterSection.style.display = "none";
            }
        };
        filterprevyrqn.addEventListener("click", () => {
            if (window.innerWidth < 940) {
                togglesection();
            }
        });
        crosssection.addEventListener("click", () => {
            togglesection();
        });
        filterSection.addEventListener("click", () => {
            togglesection();
        });
    </script>
</body>

</html>