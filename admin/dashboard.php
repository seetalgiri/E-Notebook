<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Notebook Dashboard</title>
    <!-- for CSS Style  -->
    <link rel="stylesheet" href="../Client/styles/global.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/dashboard.css">

    <!-- for JS Logic  -->
    <script src="./logic/sidenavs.js" defer></script>
</head>

<body>
    <?php include "./common/sidenav.php" ?>
    <div id="adminContent">
        <div class="actualContent">
            <div class="contentDiv">

                <div class="contentDivmain">
                    <div id="contentDiv" class="boxes">
                        <h1>E-NoteBook</h1>
                        <p>
                            Unlock Knowledge, Ace Your Journey: eNotebook - Your Gateway to Comprehensive Notes and
                            Study
                            Material.
                        </p>
                        <p>enotebook@gmail.com</p>
                        <div class="socialmedia">
                            <div class="bigline"></div>
                            <div id="Facebook" class="icons">
                                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20 14.19C20 17.83 17.83 20 14.19 20H13C12.45 20 12 19.55 12 19V13.23C12 12.96 12.22 12.73 12.49 12.73L14.25 12.7C14.39 12.69 14.51 12.59 14.54 12.45L14.89 10.54C14.8968 10.4967 14.8941 10.4525 14.8822 10.4103C14.8702 10.3681 14.8492 10.3291 14.8207 10.2958C14.7922 10.2625 14.7568 10.2358 14.717 10.2176C14.6771 10.1993 14.6338 10.1899 14.59 10.19L12.46 10.22C12.18 10.22 11.96 10 11.95 9.73L11.91 7.28C11.91 7.12 12.04 6.98 12.21 6.98L14.61 6.94C14.78 6.94 14.91 6.81 14.91 6.64L14.87 4.24C14.87 4.07 14.74 3.94 14.57 3.94L11.87 3.98C11.4759 3.98599 11.0868 4.06969 10.725 4.22632C10.3633 4.38295 10.0361 4.60942 9.76201 4.89276C9.48796 5.1761 9.27252 5.51073 9.12803 5.87748C8.98354 6.24422 8.91285 6.63588 8.92 7.03L8.97 9.78C8.98 10.06 8.76 10.28 8.48 10.29L7.28 10.31C7.11 10.31 6.98 10.44 6.98 10.61L7.01 12.51C7.01 12.68 7.14 12.81 7.31 12.81L8.51 12.79C8.79 12.79 9.01 13.01 9.02 13.28L9.11 18.98C9.12 19.54 8.67 20 8.11 20H5.81C2.17 20 0 17.83 0 14.18V5.81C0 2.17 2.17 0 5.81 0H14.19C17.83 0 20 2.17 20 5.81V14.19Z" />
                                </svg>
                            </div>
                            <div class="smallline"></div>
                            <div id="Email" class="icons">
                                <svg width="20" height="20" viewBox="0 0 20 16" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M18 4L10 9L2 4V2L10 7L18 2M18 0H2C0.89 0 0 0.89 0 2V14C0 14.5304 0.210714 15.0391 0.585786 15.4142C0.960859 15.7893 1.46957 16 2 16H18C18.5304 16 19.0391 15.7893 19.4142 15.4142C19.7893 15.0391 20 14.5304 20 14V2C20 0.89 19.1 0 18 0Z" />
                                </svg>
                            </div>
                            <div class="smallline"></div>
                            <div id="Linkedin" class="icons">
                                <svg width="20" height="20" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16 0C16.5304 0 17.0391 0.210714 17.4142 0.585786C17.7893 0.960859 18 1.46957 18 2V16C18 16.5304 17.7893 17.0391 17.4142 17.4142C17.0391 17.7893 16.5304 18 16 18H2C1.46957 18 0.960859 17.7893 0.585786 17.4142C0.210714 17.0391 0 16.5304 0 16V2C0 1.46957 0.210714 0.960859 0.585786 0.585786C0.960859 0.210714 1.46957 0 2 0H16ZM15.5 15.5V10.2C15.5 9.33539 15.1565 8.5062 14.5452 7.89483C13.9338 7.28346 13.1046 6.94 12.24 6.94C11.39 6.94 10.4 7.46 9.92 8.24V7.13H7.13V15.5H9.92V10.57C9.92 9.8 10.54 9.17 11.31 9.17C11.6813 9.17 12.0374 9.3175 12.2999 9.58005C12.5625 9.8426 12.71 10.1987 12.71 10.57V15.5H15.5ZM3.88 5.56C4.32556 5.56 4.75288 5.383 5.06794 5.06794C5.383 4.75288 5.56 4.32556 5.56 3.88C5.56 2.95 4.81 2.19 3.88 2.19C3.43178 2.19 3.00193 2.36805 2.68499 2.68499C2.36805 3.00193 2.19 3.43178 2.19 3.88C2.19 4.81 2.95 5.56 3.88 5.56ZM5.27 15.5V7.13H2.5V15.5H5.27Z" />
                                </svg>
                            </div>
                            <div class="smallline"></div>
                            <div id="Instagram" class="icons">
                                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M14.19 0H5.81C2.17 0 0 2.17 0 5.81V14.18C0 17.83 2.17 20 5.81 20H14.18C17.82 20 19.99 17.83 19.99 14.19V5.81C20 2.17 17.83 0 14.19 0ZM10 13.88C7.86 13.88 6.12 12.14 6.12 10C6.12 7.86 7.86 6.12 10 6.12C12.14 6.12 13.88 7.86 13.88 10C13.88 12.14 12.14 13.88 10 13.88ZM15.92 4.88C15.87 5 15.8 5.11 15.71 5.21C15.61 5.3 15.5 5.37 15.38 5.42C15.198 5.49725 14.9971 5.51853 14.803 5.48113C14.6089 5.44372 14.4303 5.34933 14.29 5.21C14.2 5.11 14.13 5 14.08 4.88C14.0286 4.75982 14.0015 4.63069 14 4.5C14 4.37 14.03 4.24 14.08 4.12C14.13 3.99 14.2 3.89 14.29 3.79C14.52 3.56 14.87 3.45 15.19 3.52C15.26 3.53 15.32 3.55 15.38 3.58C15.44 3.6 15.5 3.63 15.56 3.67C15.61 3.7 15.66 3.75 15.71 3.79C15.8 3.89 15.87 3.99 15.92 4.12C15.97 4.24 16 4.37 16 4.5C16 4.63 15.97 4.76 15.92 4.88Z" />
                                </svg>
                            </div>
                            <div class="bigline"></div>
                        </div>
                    </div>
                    <div id="noteBookSVG" class="boxes">
                        <?php include "./common/enotebook.php" ?>
                    </div>
                </div>
                <footer>
                    E-NoteBook © 2023 | All rights reserved
                </footer>
            </div>

        </div>
    </div>
</body>

</html>