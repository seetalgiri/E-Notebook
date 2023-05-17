<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="./Client/images/logo.png" type="image/icon type">
    <title>E-Notebook</title>
    <!-- ==================== CSS Imported ======================== -->
    <!-- for global.css  -->
    <link rel="stylesheet" href="./Client/styles/global.css" />
    <!-- for common css  -->
    <link rel="stylesheet" href="./Client/styles/style.css" />
    <link rel="stylesheet" href="./Client/styles/navigation.css" />
    <link rel="stylesheet" href="./Client/styles/indexs.css" />
    <!-- for nav css  -->
    <link rel="stylesheet" href="./Client/styles/navstyle.css" />

    <!-- ==================== JS Imported ======================== -->
    <script src="./Client/logic/index.js" defer></script>


</head>

<body>
    <?php include "./Client/Common/Navigation.php"; ?>
    <div id="home" style="padding-bottom: 60px;">
        <div id="contentDiv">
            <div id="dynamicContent">
                <div id="post" class="shadow" onclick="modalOpen()">
                    <div id="userPost">G</div>
                    <input type="text" name="search" id="createPost" placeholder="Create Post" readonly
                        autocomplete="off">
                    <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.5 10.5L8 13.5L11.5 9L16 15H2M18 16V2C18 0.89 17.1 0 16 0H2C1.46957 0 0.960859 0.210714 0.585786 0.585786C0.210714 0.960859 0 1.46957 0 2V16C0 16.5304 0.210714 17.0391 0.585786 17.4142C0.960859 17.7893 1.46957 18 2 18H16C16.5304 18 17.0391 17.7893 17.4142 17.4142C17.7893 17.0391 18 16.5304 18 16Z" />
                    </svg>
                    <svg width="19" height="16" viewBox="0 0 19 16" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 16V10L8 8L0 6V0L19 8L0 16Z" />
                    </svg>
                </div>
                <div id="category" class="shadow">
                    <div class="streamDiv">
                        <div class="stream streamChooseDiv" id="selecterStream">
                            <li class="selectSreamradio">
                                <?php
                                $news = isset($_GET['news']) ? $_GET['news'] : 'all';
                                echo ($news == 'all') ? "<input type='radio' id='allrad' name='stream' value='all' onchange='updateURL(this.value)' checked>" : "<input type='radio' id='allrad' name='stream' value='all' onchange='updateURL(this.value)'>";
                                ?>


                                <label class="btn btn-default" for="allrad"><span>ALL</span>
                                    <svg width="14" height="15" viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z" />
                                    </svg></label>
                            </li>
                            <li class="selectSreamradio">
                                <?php
                                $news = isset($_GET['news']) ? $_GET['news'] : '';
                                echo ($news == 'bca') ? "<input type='radio' id='bcarad' name='stream' value='bca' onchange='updateURL(this.value)' checked>" : "<input type='radio' id='bcarad' name='stream' value='bca' onchange='updateURL(this.value)'>";
                                ?>


                                <label class="btn btn-default" for="bcarad"><span>BCA</span>
                                    <svg width="14" height="15" viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z" />
                                    </svg></label>
                            </li>
                            <li class="selectSreamradio">
                                <?php
                                $news = isset($_GET['news']) ? $_GET['news'] : '';
                                echo ($news == 'bbm') ? "<input type='radio' id='Bbmrad' name='stream' value='bbm' onchange='updateURL(this.value)' checked>" : "<input type='radio' id='Bbmrad' name='stream' value='bbm' onchange='updateURL(this.value)'>";
                                ?>


                                <label class="btn btn-default" for="Bbmrad"><span>BBM</span>
                                    <svg width="14" height="15" viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z" />
                                    </svg></label>
                            </li>
                            <li class="selectSreamradio">
                                <?php
                                $news = isset($_GET['news']) ? $_GET['news'] : '';
                                echo ($news == 'bbs') ? "<input type='radio' id='bbsrad' name='stream' value='bbs' onchange='updateURL(this.value)' checked>" : "<input type='radio' id='bbsrad' name='stream' value='bbs' onchange='updateURL(this.value)'>";
                                ?>

                                <label class="btn btn-default" for="bbsrad"><span>BBS</span>
                                    <svg width="14" height="15" viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z" />
                                    </svg></label>
                            </li>
                            <li class="selectSreamradio">
                                <?php
                                $news = isset($_GET['news']) ? $_GET['news'] : '';
                                echo ($news == 'bsw') ? "<input type='radio' id='bswrad' name='stream' value='bsw' onchange='updateURL(this.value)' checked>" : "<input type='radio' id='bswrad' name='stream' value='bsw' onchange='updateURL(this.value)'>";
                                ?>

                                <label class="btn btn-default" for="bswrad"><span>BSW</span>
                                    <svg width="14" height="15" viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z" />
                                    </svg></label>
                            </li>
                        </div>
                    </div>
                </div>

                <!-- for each post  -->
                <div id="eachPost" class="shadow">
                    <div id="contentdev">
                        <div id="headerDiv">
                            <div id="profilePost" class="shadow">G</div>
                            <div id="nameMore">
                                <div id="name">Gaurab Sunar</div>
                                <div id="date">
                                    <span>2021-02-02 .</span>
                                    <svg width="12" height="12" fill="#5555559f" viewBox="0 0 5 5"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3.975 3.8475C3.91 3.6475 3.7225 3.5 3.5 3.5H3.25V2.75C3.25 2.6837 3.22366 2.62011 3.17678 2.57322C3.12989 2.52634 3.0663 2.5 3 2.5H1.5V2H2C2.0663 2 2.12989 1.97366 2.17678 1.92678C2.22366 1.87989 2.25 1.8163 2.25 1.75V1.25H2.75C2.88261 1.25 3.00979 1.19732 3.10355 1.10355C3.19732 1.00979 3.25 0.882608 3.25 0.75V0.6475C3.9825 0.9425 4.5 1.66 4.5 2.5C4.5 3.02 4.3 3.4925 3.975 3.8475ZM2.25 4.4825C1.2625 4.36 0.5 3.52 0.5 2.5C0.5 2.345 0.52 2.195 0.5525 2.0525L1.75 3.25V3.5C1.75 3.63261 1.80268 3.75979 1.89645 3.85355C1.99021 3.94732 2.11739 4 2.25 4M2.5 0C2.1717 0 1.84661 0.0646644 1.54329 0.190301C1.23998 0.315938 0.96438 0.500087 0.732233 0.732233C0.263392 1.20107 0 1.83696 0 2.5C0 3.16304 0.263392 3.79893 0.732233 4.26777C0.96438 4.49991 1.23998 4.68406 1.54329 4.8097C1.84661 4.93534 2.1717 5 2.5 5C3.16304 5 3.79893 4.73661 4.26777 4.26777C4.73661 3.79893 5 3.16304 5 2.5C5 2.1717 4.93534 1.84661 4.8097 1.54329C4.68406 1.23998 4.49991 0.96438 4.26777 0.732233C4.03562 0.500087 3.76002 0.315938 3.45671 0.190301C3.15339 0.0646644 2.8283 0 2.5 0Z" />
                                    </svg>

                                </div>
                            </div>
                        </div>
                        <div id="contentDIv">
                            <div>
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nobis, neque aspernatur? Nemo
                                dolorum quasi
                                dolorem error! Suscipit consectetur id eligendi quisquam sapiente enim minima. Sed fuga
                                asperiores ipsam
                                id atque nam vel officiis, iusto, sit facilis repellat quis blanditiis, odio temporibus
                                tempora illum
                                quod dicta consequatur saepe esse non.
                            </div>
                            <img class="imagePosst"
                                src="https://images.unsplash.com/photo-1680770536739-1120e9b0d7e9?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwxMHx8fGVufDB8fHx8&auto=format&fit=crop&w=600&q=60"
                                alt="">
                        </div>
                        <div class="divline"></div>

                        <div id="actionDiv">
                            <div id="like" class="actionFlex liked">
                                <svg width="17" height="17" viewBox="0 0 10 9" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.58335 4.16663C9.58335 3.70413 9.20835 3.33329 8.75002 3.33329H6.11669L6.51669 1.42913C6.52502 1.38746 6.52919 1.34163 6.52919 1.29579C6.52919 1.12496 6.45835 0.966626 6.34585 0.854126L5.90419 0.416626L3.16252 3.15829C3.00835 3.31246 2.91669 3.52079 2.91669 3.74996V7.91663C2.91669 8.13764 3.00448 8.3496 3.16076 8.50588C3.31705 8.66216 3.52901 8.74996 3.75002 8.74996H7.50002C7.84585 8.74996 8.14169 8.54163 8.26669 8.24163L9.52502 5.30413C9.56252 5.20829 9.58335 5.10829 9.58335 4.99996V4.16663ZM0.416687 8.74996H2.08335V3.74996H0.416687V8.74996Z" />
                                </svg>
                                <span id="counterLike" class="counter">101</span>
                                <!-- <span>Likes</span> -->
                            </div>
                            <div id="comment" class="actionFlex" onclick="commentFOcusIconclk()">
                                <svg width="17" height="17" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.5 8.625C4.40054 8.625 4.30516 8.58549 4.23484 8.51517C4.16451 8.44484 4.125 8.34946 4.125 8.25V7.125H2.625C2.42609 7.125 2.23532 7.04598 2.09467 6.90533C1.95402 6.76468 1.875 6.57391 1.875 6.375V2.625C1.875 2.42609 1.95402 2.23532 2.09467 2.09467C2.23532 1.95402 2.42609 1.875 2.625 1.875H7.875C8.07391 1.875 8.26468 1.95402 8.40533 2.09467C8.54598 2.23532 8.625 2.42609 8.625 2.625V6.375C8.625 6.57391 8.54598 6.76468 8.40533 6.90533C8.26468 7.04598 8.07391 7.125 7.875 7.125H6.3375L4.95 8.51625C4.875 8.58375 4.785 8.625 4.6875 8.625H4.5ZM1.125 5.625H0.375V1.125C0.375 0.926088 0.454018 0.735322 0.59467 0.59467C0.735322 0.454018 0.926088 0.375 1.125 0.375H7.125V1.125H1.125V5.625Z" />
                                </svg>

                                <span id="counterComment" class="counter">24</span>
                                <!-- <span>Comments</span> -->
                            </div>
                            <div id="share" class="actionFlex">
                                <svg width="17" height="17" viewBox="0 0 8 7" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.75 3.00004L4.83333 0.083374V1.75004C1.91667 2.16671 0.666667 4.25004 0.25 6.33337C1.29167 4.87504 2.75 4.20837 4.83333 4.20837V5.91671L7.75 3.00004Z" />
                                </svg>

                                <!-- <span>Share</span> -->
                            </div>
                        </div>
                        <div class="divline mt-2"></div>

                        <!-- for comment pot -->
                        <div>
                            <!-- for thers comment  -->
                            <div id="commentContent">
                                <div class="eachcomment">
                                    <div class="commentcontent">
                                        <div id="cmtuserDet">
                                            <div id="userPost">G</div>
                                            <div id="userNameAndDate">
                                                <span>Gaurab sunar</span>
                                                <span>2021-21-2</span>
                                            </div>
                                        </div>
                                        <div class="commentdata">
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Numquam, quo sed.
                                            Rem vel officia, quae
                                            aliquam voluptatem possimus odio quam?
                                        </div>
                                    </div>
                                </div>
                                <div class="eachcomment">
                                    <div class="commentcontent">
                                        <div id="cmtuserDet">
                                            <div id="userPost">G</div>
                                            <div id="userNameAndDate">
                                                <span>Gaurab sunar</span>
                                                <span>2021-21-2</span>
                                            </div>
                                        </div>
                                        <div class="commentdata">
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Numquam, quo sed.
                                            Rem vel officia, quae
                                            aliquam voluptatem possimus odio quam?
                                        </div>
                                    </div>
                                </div>
                                <div class="eachcomment">
                                    <div class="commentcontent">
                                        <div id="cmtuserDet">
                                            <div id="userPost">G</div>
                                            <div id="userNameAndDate">
                                                <span>Gaurab sunar</span>
                                                <span>2021-21-2</span>
                                            </div>
                                        </div>
                                        <div class="commentdata">
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Numquam, quo sed.
                                            Rem vel officia, quae
                                            aliquam voluptatem possimus odio quam?
                                        </div>
                                    </div>
                                </div>
                                <div class="eachcomment">
                                    <div class="commentcontent">
                                        <div id="cmtuserDet">
                                            <div id="userPost">G</div>
                                            <div id="userNameAndDate">
                                                <span>Gaurab sunar</span>
                                                <span>2021-21-2</span>
                                            </div>
                                        </div>
                                        <div class="commentdata">
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Numquam, quo sed.
                                            Rem vel officia, quae
                                            aliquam voluptatem possimus odio quam?
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- for post comment  -->
                            <form action="#">
                                <div id="cmtPost" class="shadow">
                                    <div id="cmtuserPost">G</div>
                                    <input type="text" name="comment" id="cmtcreatePost"
                                        placeholder="Comment your thoughts..." autocomplete="off" style="height: 32px;">
                                    <button style="background-color: transparent;border: none;display: flex;">
                                        <svg width="20" height="17" viewBox="0 0 19 16"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 16V10L8 8L0 6V0L19 8L0 16Z" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <!-- end of each post  -->

            </div>
            <?php include './Client/Common/fixedcontent.php'; ?>
        </div>
    </div>

    <!-- post modal  -->
    <div id="postModal">
        <div id="postModalRel">
            <div id="postModalContent">
                <div class="headContent">
                    <div class="HeadCards">Create Post:</div>
                    <div class="cross" onclick="modalClose()">X</div>
                </div>
                <div class="LinedivModal"></div>
                <div id="bodyDivModal">
                    <div class="modalContents">
                        <div class="contentDiv">
                            <div class="buttonclscontent">
                                <div class="ContentChooseBtn">
                                    <div class="noteModalforHov noticeBtn" id="uploadNotice">Upload Notice</div>
                                    <div class="noteModalforHov noteBtn inactivebtnPost" id="uploadNote">Request Note
                                    </div>
                                </div>
                            </div>
                            <div id="formDiv">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function updateURL(newsValue) {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('news', newsValue);

            const newURL = window.location.pathname + '?' + urlParams.toString();
            history.replaceState(null, '', newURL);
            const cmtcreatePost = document.getElementById('cmtcreatePost');

        }

        function commentFOcusIconclk() {
            cmtcreatePost.focus()
            console.log("first")
        }
    </script>
</body>

</html>