<?php
$show_notification = false;

// importaing configurations 
include './Configuration.php';


// importing session datas
include './admin/UserSessionData.php';


//database connection
$con = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);

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
    <link rel="stylesheet" href="./Client/styles/indexsa.css" />
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
                <?php echo $id >= 1 ? '<div id="post" class="shadow" onclick="modalOpen()">
                    <div id="userPost">' . ucfirst(substr($username, 0, 1)) . '</div>
                    <input type="text" name="search" id="createPost" placeholder="Create Post" readonly
                        autocomplete="off">
                    <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.5 10.5L8 13.5L11.5 9L16 15H2M18 16V2C18 0.89 17.1 0 16 0H2C1.46957 0 0.960859 0.210714 0.585786 0.585786C0.210714 0.960859 0 1.46957 0 2V16C0 16.5304 0.210714 17.0391 0.585786 17.4142C0.960859 17.7893 1.46957 18 2 18H16C16.5304 18 17.0391 17.7893 17.4142 17.4142C17.7893 17.0391 18 16.5304 18 16Z" />
                    </svg>
                    <svg width="19" height="16" viewBox="0 0 19 16" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 16V10L8 8L0 6V0L19 8L0 16Z" />
                    </svg>
                </div>' : ''; ?>

                <?php
                if (!isset($_GET['id'])) {
                    echo '
        <div id="category" class="shadow">
            <div class="streamDiv">
                <div class="stream streamChooseDiv" id="selecterStream">';
                    if (mysqli_num_rows($resfac) > 0) {
                        echo '<li class="selectSreamradio">';
                        $news = isset($_GET['news']) ? $_GET['news'] : 'all';
                        echo ($news == 'all') ? "<input type='radio' id='allrad' name='stream' value='all' onchange='updateURL(this.value)' checked>" : "<input type='radio' id='allrad' name='stream' value='all' onchange='updateURL(this.value)'>";
                        echo "<label class='btn btn-default' for='allrad'><span>ALL</span>
        <svg width='14' height='15' viewBox='0 0 16 18' xmlns='http://www.w3.org/2000/svg'>
        <path d='M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z' />
        </svg></label>";
                        echo '</li>';

                        while ($row = mysqli_fetch_assoc($resfac)) {
                            $news = isset($_GET['news']) ? $_GET['news'] : '';
                            $streamValue = $row['faculity_name'];
                            $streamId = $row['faculity_name'] . 'rad';

                            echo '<li class="selectSreamradio">';
                            echo ($news == $streamValue) ? "<input type='radio' id='$streamId' name='stream' value='$streamValue' onchange='updateURL(this.value)' checked>" : "<input type='radio' id='$streamId' name='stream' value='$streamValue' onchange='updateURL(this.value)'>";
                            echo "<label class='btn btn-default' for='$streamId'><span>" . $row['faculity_name'] . "</span>
            <svg width='14' height='15' viewBox='0 0 16 18' xmlns='http://www.w3.org/2000/svg'>
            <path d='M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z' />
            </svg></label>";
                            echo '</li>';
                        }
                    }

                    echo '
                </div>
            </div>
        </div>';
                }
                ?>

                <div id="allDynamicPostContent">
                    <!-- for each post  -->
                </div>
                <div id="ShowMoreData" style="display:none;">
                    <div class="SeeMoreLetterLines">
                        <span class="lines"></span>
                        <span class="letter" onclick="SeemoreClk()">See more</span>
                        <span class="lines linesRight"></span>
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
        const HTMLContent = (data) => {
            const postHTML = ` <div id="eachPost" class="shadow">
                        <div id="contentdev">
                            <div id="headerDiv">
                                <div id="profilePost" class="shadow Capitalize">${data.author[0]}</div>
                                <div id="nameMore">
                                    <div id="name" class="Capitalize">${data.author}</div>
                                    <div id="date">
                                        <span>${data.date} </span>
                                        ${data.stream.toLowerCase() === "all" ? `
                                            <span>.</span>
                                            <svg width="12" height="12" viewBox="0 0 5 5" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.975 3.8475C3.91 3.6475 3.7225 3.5 3.5 3.5H3.25V2.75C3.25 2.6837 3.22366 2.62011 3.17678 2.57322C3.12989 2.52634 3.0663 2.5 3 2.5H1.5V2H2C2.0663 2 2.12989 1.97366 2.17678 1.92678C2.22366 1.87989 2.25 1.8163 2.25 1.75V1.25H2.75C2.88261 1.25 3.00979 1.19732 3.10355 1.10355C3.19732 1.00979 3.25 0.882608 3.25 0.75V0.6475C3.9825 0.9425 4.5 1.66 4.5 2.5C4.5 3.02 4.3 3.4925 3.975 3.8475ZM2.25 4.4825C1.2625 4.36 0.5 3.52 0.5 2.5C0.5 2.345 0.52 2.195 0.5525 2.0525L1.75 3.25V3.5C1.75 3.63261 1.80268 3.75979 1.89645 3.85355C1.99021 3.94732 2.11739 4 2.25 4M2.5 0C2.1717 0 1.84661 0.0646644 1.54329 0.190301C1.23998 0.315938 0.96438 0.500087 0.732233 0.732233C0.263392 1.20107 0 1.83696 0 2.5C0 3.16304 0.263392 3.79893 0.732233 4.26777C0.96438 4.49991 1.23998 4.68406 1.54329 4.8097C1.84661 4.93534 2.1717 5 2.5 5C3.16304 5 3.79893 4.73661 4.26777 4.26777C4.73661 3.79893 5 3.16304 5 2.5C5 2.1717 4.93534 1.84661 4.8097 1.54329C4.68406 1.23998 4.49991 0.96438 4.26777 0.732233C4.03562 0.500087 3.76002 0.315938 3.45671 0.190301C3.15339 0.0646644 2.8283 0 2.5 0Z" />
                                            </svg>`: `<span>.</span>
                                            <svg width="14" height="14" viewBox="0 0 22 18"  xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 0L0 6L11 12L20 7.09V14H22V6M4 10.18V14.18L11 18L18 14.18V10.18L11 14L4 10.18Z" />
                                            </svg>`}
                                    </div>
                                </div>
                            </div>
                            <div id="contentDIv">
                                <div class="capitalize-first-letter" id="DisDataPost">
                                ${data.postdes.trim().replace(/\n/g, "<br>")}
                                </div>
                                <img id="imageUrl${data.id}" class="imagePosst" src="${data.image}" loading="lazy">
                            </div>
                            <div class="divline"></div>

                            <div id="actionDiv">
                                <div id="like${data.id}" class="actionFlex ${data.post_like.includes(<?php echo $id ?>) && 'liked'}" onclick="likeBtnclk(${data.id}, <?php echo $id ?>)">
                                    <svg width="17" height="17" viewBox="0 0 10 9" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.58335 4.16663C9.58335 3.70413 9.20835 3.33329 8.75002 3.33329H6.11669L6.51669 1.42913C6.52502 1.38746 6.52919 1.34163 6.52919 1.29579C6.52919 1.12496 6.45835 0.966626 6.34585 0.854126L5.90419 0.416626L3.16252 3.15829C3.00835 3.31246 2.91669 3.52079 2.91669 3.74996V7.91663C2.91669 8.13764 3.00448 8.3496 3.16076 8.50588C3.31705 8.66216 3.52901 8.74996 3.75002 8.74996H7.50002C7.84585 8.74996 8.14169 8.54163 8.26669 8.24163L9.52502 5.30413C9.56252 5.20829 9.58335 5.10829 9.58335 4.99996V4.16663ZM0.416687 8.74996H2.08335V3.74996H0.416687V8.74996Z" />
                                    </svg>
                                    <span id="counterLike${data.id}" class="counter">${data.post_like.length}</span>
                                    <!-- <span>Likes</span> -->
                                </div>
                                <div id="comment" class="actionFlex" onclick="commentFOcusIconclk(${data.id}, <?php echo $id ?>)">
                                    <svg width="17" height="17" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.5 8.625C4.40054 8.625 4.30516 8.58549 4.23484 8.51517C4.16451 8.44484 4.125 8.34946 4.125 8.25V7.125H2.625C2.42609 7.125 2.23532 7.04598 2.09467 6.90533C1.95402 6.76468 1.875 6.57391 1.875 6.375V2.625C1.875 2.42609 1.95402 2.23532 2.09467 2.09467C2.23532 1.95402 2.42609 1.875 2.625 1.875H7.875C8.07391 1.875 8.26468 1.95402 8.40533 2.09467C8.54598 2.23532 8.625 2.42609 8.625 2.625V6.375C8.625 6.57391 8.54598 6.76468 8.40533 6.90533C8.26468 7.04598 8.07391 7.125 7.875 7.125H6.3375L4.95 8.51625C4.875 8.58375 4.785 8.625 4.6875 8.625H4.5ZM1.125 5.625H0.375V1.125C0.375 0.926088 0.454018 0.735322 0.59467 0.59467C0.735322 0.454018 0.926088 0.375 1.125 0.375H7.125V1.125H1.125V5.625Z" />
                                    </svg>

                                    <span id="counterComment${data.id}" class="counter">${data.comment.length}</span>
                                    <!-- <span>Comments</span> -->
                                </div>
                                <div id="share${data.id}" class="actionFlex iconProperty shareIconContainer" onclick="shareIconClk(event, ${data.id})">
                                    <svg width="17" class="iconProperty" height="17" viewBox="0 0 8 7" xmlns="http://www.w3.org/2000/svg">
                                        <path class="iconProperty" d="M7.75 3.00004L4.83333 0.083374V1.75004C1.91667 2.16671 0.666667 4.25004 0.25 6.33337C1.29167 4.87504 2.75 4.20837 4.83333 4.20837V5.91671L7.75 3.00004Z" />
                                    </svg>
                                    <div class="SharehiddenBlockContainer iconProperty">
                                        <div class="shareDataBigContainer iconProperty shadow-lg">
                                            <div class="shareData iconProperty">
                                                <div class="shareIcon iconProperty">
                                                    <a href="https://www.facebook.com/share.php?u=${window.location.href}?id=${data.id}" class="facebook iconProperty" target="blank">
                                                        <svg class="iconProperty" width="22" height="21" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
                                                        <path class="iconProperty" d="M20.8784 14.4805C20.8784 18.1205 18.7084 20.2905 15.0684 20.2905H13.8784C13.3284 20.2905 12.8784 19.8405 12.8784 19.2905V13.5205C12.8784 13.2505 13.0984 13.0205 13.3684 13.0205L15.1284 12.9905C15.2684 12.9805 15.3884 12.8805 15.4184 12.7405L15.7684 10.8305C15.7984 10.6505 15.6584 10.4805 15.4684 10.4805L13.3384 10.5105C13.0584 10.5105 12.8384 10.2905 12.8284 10.0205L12.7884 7.57053C12.7884 7.41053 12.9184 7.27054 13.0884 7.27054L15.4884 7.23053C15.6584 7.23053 15.7884 7.10054 15.7884 6.93054L15.7484 4.53052C15.7484 4.36052 15.6184 4.23053 15.4484 4.23053L12.7484 4.27054C11.0884 4.30054 9.76842 5.66053 9.79842 7.32053L9.84842 10.0705C9.85842 10.3505 9.63842 10.5705 9.35842 10.5805L8.15842 10.6005C7.98842 10.6005 7.85843 10.7305 7.85843 10.9005L7.88843 12.8005C7.88843 12.9705 8.01842 13.1005 8.18842 13.1005L9.38842 13.0805C9.66842 13.0805 9.88842 13.3005 9.89842 13.5705L9.98842 19.2705C9.99842 19.8305 9.54842 20.2905 8.98842 20.2905H6.68842C3.04842 20.2905 0.878418 18.1205 0.878418 14.4705V6.10053C0.878418 2.46053 3.04842 0.290527 6.68842 0.290527H15.0684C18.7084 0.290527 20.8784 2.46053 20.8784 6.10053V14.4805Z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="shareIcon iconProperty">
                                                    <a target="blank" href="http://www.pinterest.com/pin/create/button/?url=${window.location.href}?id=${data.id}">
                                                        <svg class="iconProperty" height="22" width="21" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                            viewBox="0 0 504 504" xml:space="preserve">
                                                        <g class="iconProperty">
                                                            <g class="iconProperty">
                                                                <path class="iconProperty" d="M377.6,0H126C56.8,0,0,56.8,0,126.4V378c0,69.2,56.8,126,126,126h251.6c69.6,0,126.4-56.8,126.4-126.4V126.4
                                                                    C504,56.8,447.2,0,377.6,0z M277.2,322c-20,0-39.2-10.4-45.6-22.4c0,0-10.8,41.6-13.2,49.6c-8,28.4-32,56.8-33.6,59.2
                                                                    c-1.2,1.6-4,1.2-4.4-1.2c-0.4-3.6-6.4-39.6,0.4-68.8c3.6-14.8,24-98.4,24-98.4s-6-11.6-6-28.4c0-26.8,16-46.8,36-46.8
                                                                    c16.8,0,25.2,12.4,25.2,27.2c0,16.4-10.8,41.2-16.4,64c-4.8,19.2,10,34.8,29.6,34.8c35.2,0,59.2-44,59.2-96
                                                                    c0-39.6-27.6-69.2-77.6-69.2c-56.4,0-92,40.8-92,86.4c0,15.6,4.8,26.8,12.4,35.6c3.6,4,4,5.6,2.8,10c-0.8,3.2-2.8,11.2-4,14.4
                                                                    c-1.2,4.4-5.2,6.4-9.2,4.4c-26-10.4-38-38-38-69.2c0-51.2,44.8-112.8,133.2-112.8c71.2,0,118,50,118,103.6
                                                                    C377.6,269.2,337.2,322,277.2,322z"/>
                                                            </g>
                                                        </g>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="shareIcon iconProperty">
                                                    <a href="https://twitter.com/share?text=${data.postdes}&url=${window.location.href}?id=${data.id}" class="twitter iconProperty" target="blank">
                                                        <svg class="iconProperty" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                            <path class="iconProperty" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-.139 9.237c.209 4.617-3.234 9.765-9.33 9.765-1.854 0-3.579-.543-5.032-1.475 1.742.205 3.48-.278 4.86-1.359-1.437-.027-2.649-.976-3.066-2.28.515.098 1.021.069 1.482-.056-1.579-.317-2.668-1.739-2.633-3.26.442.246.949.394 1.486.411-1.461-.977-1.875-2.907-1.016-4.383 1.619 1.986 4.038 3.293 6.766 3.43-.479-2.053 1.08-4.03 3.199-4.03.943 0 1.797.398 2.395 1.037.748-.147 1.451-.42 2.086-.796-.246.767-.766 1.41-1.443 1.816.664-.08 1.297-.256 1.885-.517-.439.656-.996 1.234-1.639 1.697z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="shareIcon iconProperty">
                                                    <a class="iconProperty" target="blank" href="https://www.linkedin.com/sharing/share-offsite/?url=${window.location.href}?id=${data.id}" >
                                                        <svg class="iconProperty" width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                                            <path class="iconProperty" d="M16 0C16.5304 0 17.0391 0.210714 17.4142 0.585786C17.7893 0.960859 18 1.46957 18 2V16C18 16.5304 17.7893 17.0391 17.4142 17.4142C17.0391 17.7893 16.5304 18 16 18H2C1.46957 18 0.960859 17.7893 0.585786 17.4142C0.210714 17.0391 0 16.5304 0 16V2C0 1.46957 0.210714 0.960859 0.585786 0.585786C0.960859 0.210714 1.46957 0 2 0H16ZM15.5 15.5V10.2C15.5 9.33539 15.1565 8.5062 14.5452 7.89483C13.9338 7.28346 13.1046 6.94 12.24 6.94C11.39 6.94 10.4 7.46 9.92 8.24V7.13H7.13V15.5H9.92V10.57C9.92 9.8 10.54 9.17 11.31 9.17C11.6813 9.17 12.0374 9.3175 12.2999 9.58005C12.5625 9.8426 12.71 10.1987 12.71 10.57V15.5H15.5ZM3.88 5.56C4.32556 5.56 4.75288 5.383 5.06794 5.06794C5.383 4.75288 5.56 4.32556 5.56 3.88C5.56 2.95 4.81 2.19 3.88 2.19C3.43178 2.19 3.00193 2.36805 2.68499 2.68499C2.36805 3.00193 2.19 3.43178 2.19 3.88C2.19 4.81 2.95 5.56 3.88 5.56ZM5.27 15.5V7.13H2.5V15.5H5.27Z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="socialIcon copyLinkContainer iconProperty">
                                                <p class="copyLink iconProperty">Copy link</p>
                                                <div class="copystatus">
                                                <svg onclick="copiedLink(event, ${data.id})" class="iconProperty copyLinkSVG" width="17" height="17" viewBox="0 0 19 22" xmlns="http://www.w3.org/2000/svg">
                                                        <path class="iconProperty" d="M17 20H6V6H17M17 4H6C5.46957 4 4.96086 4.21071 4.58579 4.58579C4.21071 4.96086 4 5.46957 4 6V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H17C17.5304 22 18.0391 21.7893 18.4142 21.4142C18.7893 21.0391 19 20.5304 19 20V6C19 5.46957 18.7893 4.96086 18.4142 4.58579C18.0391 4.21071 17.5304 4 17 4ZM14 0H2C1.46957 0 0.960859 0.210714 0.585786 0.585786C0.210714 0.960859 0 1.46957 0 2V16H2V2H14V0Z"/>
                                                        </svg>
                                                </div>
                                            </div>
                                        </div> 

                                    </div>
                                </div>
                            </div>
                            <div class="divline mt-2"></div>

                            <!-- for comment pot -->
                            <div>
                                <!-- for thers comment  -->
                                <div id="commentContent" class="commentContent${data.id}">
                                </div>

                                <!-- for post comment  -->
                                <?php echo $id >= 1 ? '<form action="#" method="post" onsubmit="event.preventDefault(); submitCommentAsync(event, ${data.id}, ' . $id . ', \'' . $username . '\' )">
                                    <div id="cmtPost" class="shadow">
                                        <div id="cmtuserPost">' . ucfirst(substr($username, 0, 1)) . '</div>
                                        <input type="text" name="comment" id="cmtcreatePost" class="comentFld${data.id} cmtcreatePost${data.id} allCommentfld" placeholder="Comment your thoughts..." autocomplete="off" style="height: 32px;">
                                        <button style="background-color: transparent;border: none;display: flex;">
                                        <svg width="20" height="17" viewBox="0 0 19 16" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 16V10L8 8L0 6V0L19 8L0 16Z" />
                                        </svg>
                                        </button>
                                    </div>
                                </form>' : ''; ?>
                            </div>
                        </div>
                    </div>
                    
`
            return postHTML;
        }
        const copysuccessSVG = `
            <svg class="iconProperty" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path class="iconProperty fillTransparent" d="M22 11.1V6.9C22 3.4 20.6 2 17.1 2H12.9C9.4 2 8 3.4 8 6.9V8H11.1C14.6 8 16 9.4 16 12.9V16H17.1C20.6 16 22 14.6 22 11.1Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path class="iconProperty fillTransparent" d="M16 17.1V12.9C16 9.4 14.6 8 11.1 8H6.9C3.4 8 2 9.4 2 12.9V17.1C2 20.6 3.4 22 6.9 22H11.1C14.6 22 16 20.6 16 17.1Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path class="iconProperty fillTransparent" d="M6.08008 15L8.03008 16.95L11.9201 13.05" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>`

        const copiedLink = (e, id) => {
            const copyLinkSVG = `<svg onclick="copiedLink(event, ${id})" class="iconProperty copyLinkSVG" width="17" height="17" viewBox="0 0 19 22" xmlns="http://www.w3.org/2000/svg">
            <path class="iconProperty" d="M17 20H6V6H17M17 4H6C5.46957 4 4.96086 4.21071 4.58579 4.58579C4.21071 4.96086 4 5.46957 4 6V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H17C17.5304 22 18.0391 21.7893 18.4142 21.4142C18.7893 21.0391 19 20.5304 19 20V6C19 5.46957 18.7893 4.96086 18.4142 4.58579C18.0391 4.21071 17.5304 4 17 4ZM14 0H2C1.46957 0 0.960859 0.210714 0.585786 0.585786C0.210714 0.960859 0 1.46957 0 2V16H2V2H14V0Z"/></svg>`
            if (id !== undefined && id !== null && id !== "") {
                const url = `${window.location.origin}${window.location.pathname}`;
                navigator.clipboard.writeText(`${url}?id=${id}`).then(() => {
                    const copystatus = e.target.parentNode;
                    copystatus.innerHTML = copysuccessSVG;
                    setTimeout(() => {
                        copystatus.innerHTML = copyLinkSVG;
                    }, 3000);
                })
            }

        };

        const recentPostMethod = (data) => {
            const recentPost = `<div class="firstBox" >
            ${data && data.image && data.image.trim().length > 1 ? `<img src="${data.image}" style="object-fit:cover;" alt="" onclick="recentPostClk()">` : ''
                }
                            <div id="ing">
                                <div class="content" onclick="recentPostClk()">
                                    <p>${data&&data.postdes.length > 50 ? data&&data.postdes.slice(0, 50) + "..." : data&&data.postdes}</p>
                                    <div id="dateRec">
                                        ${data&&data.date}
                                    </div>
                                </div>
                                <div class="clearRec" id="recentClear" onclick="recentClearClk()">
                                    Clear
                                </div>
                            </div>
                        </div>`
            return recentPost;
        }

        const commentData = (data) => {
            let eachCmt = `<div class="eachcomment">
                    <div class="commentcontent">
                        <div id="cmtuserDet">
                            <div id="userPost">${data.author[0].toUpperCase()}</div>
                            <div id="userNameAndDate">
                                <span>${data.author}</span>
                                <span>${data.date}</span>
                            </div>
                        </div>
                        <div class="commentdata">${data.cmt_des}</div>
                    </div>
                </div>`;
            return eachCmt;
        };

        let showLimit = 5;
        const SeemoreClk = () => {
            showLimit = showLimit + 5;
            fetchData(params())
        }

        const fetchData = async (showType) => {
            try {
                const urlParams = new URLSearchParams(window.location.search);
                const idParam = urlParams.get('id');

                const response = await fetch('http://localhost/e_notebook/Server/Home/indexdataget.php');
                const data = await response.json();
                let finalData = data.data.reverse();

                // Filter data based on ID parameter if it exists
                if (idParam) {
                    finalData = finalData.filter(e => e.id === idParam);
                } else if (showType !== 'all') {
                    finalData = finalData.filter(e => e.stream === showType);
                }

                let recentImage = finalData[0];

                // Convert post_like string to array and remove values less than 1
                finalData.forEach(e => {
                    e.post_like = e.post_like.split(',').map(Number).filter(value => value >= 1);
                    e.comment = e.comment.split(',').map(Number).filter(value => value >= 1);
                });

                const fragment = document.createDocumentFragment();
                const allDynamicPostContent = document.getElementById("allDynamicPostContent");

                if (finalData.length <= showLimit) {
                    document.getElementById("ShowMoreData").style.display = "none";
                } else {
                    document.getElementById("ShowMoreData").style.display = "block";
                }

                finalData.slice(0, showLimit).forEach(e => {
                    const eachPost = HTMLContent(e);
                    const div = document.createElement('div');
                    div.innerHTML = eachPost;
                    fragment.appendChild(div);

                    // Fetch comments for each post
                    fetchComments(e.id)
                        .then(comments => {
                            const commentsContainer = document.querySelector(`.commentContent${e.id}`);
                            comments.forEach(comment => {
                                const commentHtml = commentData(comment);
                                const commentDiv = document.createElement('div');
                                commentDiv.innerHTML = commentHtml;
                                commentsContainer.appendChild(commentDiv);
                            });
                        })
                        .catch(error => console.error(error));
                });

                allDynamicPostContent.innerHTML = '';
                allDynamicPostContent.appendChild(fragment);

                // ================================= for comment in post ===================================
                const eachcomment = document.getElementById("eachcomment");

                // for recent post
                const recentPostdata = document.getElementById("recentPostdata");
                recentPostdata != null ? recentPostdata.innerHTML = recentPostMethod(recentImage) : '';

                if (finalData.length < 1) {
                    allDynamicPostContent.innerHTML = "<h3 id='NotFoundNews'>Sorry! News Not Found</h3>";
                }
                hideShareIcon();
            } catch (error) {
                console.error(error);
            }
            disData();
        };




        const recentPostContentFulldiv = document.getElementById("recentPostContentFulldiv")

        const recentClearClk = () => {
            recentPostContentFulldiv.style.display = "none";
        }
        const recentPostClk = () => {
            window.scrollTo(0, 0);
        }


        const disData = () => {
            const DisDataPost = document.getElementById("DisDataPost")
            // console.log(DisDataPost.innerHTML.trim().replace(/\n/g, "<br>"));
        }

        function updateURL(newsValue) {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('news', newsValue);

            const newURL = window.location.pathname + '?' + urlParams.toString();
            history.replaceState(null, '', newURL);
            const cmtcreatePost = document.getElementById('cmtcreatePost');

        }

        function commentFOcusIconclk(postId, userId) {
            if (userId > 0) {
                const comentFld = document.querySelector(`.comentFld${postId}`)
                comentFld.focus()
            } else {
                window.location.href = 'http://localhost/e_notebook/auth/login.php';
            }
        }
        // sending data into backend for like post
        const likeBtnclk = async (postId, userId) => {
            if (userId < 1) {
                window.location.href = 'http://localhost/e_notebook/auth/login.php';
            } else {
                const like = document.getElementById(`like${postId}`);
                if (like.classList.contains('liked')) {
                    like.classList.remove('liked');
                } else {
                    like.classList.add('liked');
                }

                try {
                    const response = await fetch('./server/Home/indexlikeupdate.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            postId: postId,
                            userId: userId,
                        }),
                    });

                    const data = await response.json();
                    if (data.success) {
                        let counterLike = document.getElementById(`counterLike${data.postId}`)
                        counterLike.innerText = data.likeCount
                    }

                } catch (error) {
                    console.error('Error:', error);
                }
            }
        };


        // ================================ for commnet logic -=================================
        // JavaScript code for commnet post logic
        async function submitCommentAsync(event, postId, userId, userName) {
            event.preventDefault();

            const commentInput = document.querySelector(`.cmtcreatePost${postId}`);
            const comment = commentInput.value.trim();

            if (comment !== "") {
                const allCommentfld = document.getElementsByClassName("allCommentfld");
                for (let i = 0; i < allCommentfld.length; i++) {
                    allCommentfld[i].value = "";
                }
                const commentDataLocal = {
                    postId,
                    userId,
                    comment,
                    userName
                };

                try {
                    const response = await fetch('http://localhost/e_notebook/Server/Home/comment.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(commentDataLocal)
                    });

                    const data = await response.json();

                    if (data.status === 'success') {
                        // Create a new comment element
                        const commentElement = document.createElement('div');
                        commentElement.innerHTML = commentData(data.comment);

                        // Append the new comment to the comments container
                        const commentsContainer = document.querySelector(`.commentContent${postId}`);
                        commentsContainer.appendChild(commentElement);
                        const counterLike = document.getElementById(`counterComment${postId}`);
                        let likeNum = Number(counterLike.innerText) + 1;
                        counterLike.innerText = likeNum

                    } else {
                        console.error(data.message);
                    }
                } catch (error) {
                    console.error(error);
                }
            }
        }


        // Function to fetch comments based on post ID
        const fetchComments = async (postId) => {
            try {
                const response = await fetch(`http://localhost/e_notebook/Server/Home/getcomment.php?postId=${postId}`, {
                    method: 'GET'
                });
                const comments = await response.json();
                return comments;
            } catch (error) {
                console.error(error);
                return [];
            }
        };


        const params = () => {
            // Get the current URL
            var url = new URL(window.location.href);
            // Get the value of the "news" parameter
            var newsParam = url.searchParams.get("news");
            // Log the value of the "news" parameter
            return newsParam !== null ? newsParam.toLocaleLowerCase() : "all"
        }

        // =========================== get url parameter =========================
        const selectSreamradio = document.getElementsByClassName("selectSreamradio");
        for (let i = 0; i < selectSreamradio.length; i++) {
            selectSreamradio[i].addEventListener('change', (event) => {
                fetchData(params());
            });
        };

        window.onload = function() {
            fetchData(params());
        }

        const hideShareIcon = () => {
            const allSharehiddenBlockContainers = document.querySelectorAll('.SharehiddenBlockContainer');
            allSharehiddenBlockContainers.forEach(container => {
                container.classList.add('hidden');
            });
        };
        window.addEventListener("click", (event) => {
            const clickedElement = event.target;
            if (
                !clickedElement.classList.contains("iconProperty")
            ) {
                hideShareIcon();
            }
        })

        const shareIconClk = (event, id) => {
            hideShareIcon();
            const share = document.querySelector(`#share${id} .SharehiddenBlockContainer`);
            share.classList.remove('hidden');
        };
    </script>
</body>

</html>