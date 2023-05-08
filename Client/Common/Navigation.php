<nav class="shadow" id="navigation">
    <div id="logo">
        <a href="#">
            <img src="./Client/images/logo.png" alt="" />
        </a>
    </div>
    <div class="navsectionLink">
        <ul id="MainNav">
            <li class="navLinks index active"><a href="./index.php">News</a></li>
            <li class="navLinks notes"><a href="./notes.php">Notes</a></li>
            <li class="navLinks syllabus">
                <a href="./syllabus.php">Syllabus</a>
            </li>
            <li class="navLinks previousquestions">
                <a href="./previousquestions.php">Question Papers</a>
            </li>
        </ul>
        <div id="user" class="login">
            <a href="./auth/register.php">
                <button class="shadow-lg">
                    <span> Login </span>
                    <svg width="15" height="18" viewBox="0 0 16 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8 15.2381C8.53043 15.2381 9.03914 15.0374 9.41421 14.6802C9.78929 14.323 10 13.8385 10 13.3333C10 12.2762 9.1 11.4286 8 11.4286C7.46957 11.4286 6.96086 11.6293 6.58579 11.9865C6.21071 12.3437 6 12.8282 6 13.3333C6 13.8385 6.21071 14.323 6.58579 14.6802C6.96086 15.0374 7.46957 15.2381 8 15.2381ZM14 6.66667C14.5304 6.66667 15.0391 6.86735 15.4142 7.22456C15.7893 7.58177 16 8.06625 16 8.57143V18.0952C16 18.6004 15.7893 19.0849 15.4142 19.4421C15.0391 19.7993 14.5304 20 14 20H2C1.46957 20 0.960859 19.7993 0.585786 19.4421C0.210714 19.0849 0 18.6004 0 18.0952V8.57143C0 7.51429 0.9 6.66667 2 6.66667H3V4.7619C3 3.49897 3.52678 2.28776 4.46447 1.39473C5.40215 0.501699 6.67392 0 8 0C8.65661 0 9.30679 0.12317 9.91342 0.362478C10.52 0.601787 11.0712 0.952546 11.5355 1.39473C11.9998 1.83691 12.3681 2.36186 12.6194 2.9396C12.8707 3.51734 13 4.13656 13 4.7619V6.66667H14ZM8 1.90476C7.20435 1.90476 6.44129 2.20578 5.87868 2.7416C5.31607 3.27742 5 4.00414 5 4.7619V6.66667H11V4.7619C11 4.00414 10.6839 3.27742 10.1213 2.7416C9.55871 2.20578 8.79565 1.90476 8 1.90476Z" />
                    </svg>
                </button>
            </a>
        </div>
    </div>
    <div id="hamburgerNav">
        <div class="LinesNav"></div>
        <div class="LinesNav"></div>
        <div class="LinesNav"></div>
    </div>
    <div class="navCloseDIv"></div>
</nav>
<script>
var navLinks = document.getElementsByTagName("a");
const currentUrl = window.location.href;
const currentPage = currentUrl.substr(currentUrl.lastIndexOf('/') + 1);
const clsPage = currentPage.split(".")[0]


const classes = document.querySelectorAll(".navLinks");
classes[0].classList.add("active");
if (clsPage.length > 1) {
    for (let i = 0; i < classes.length; i++) {
        if (classes[i].classList.contains(clsPage)) {
            classes[i].classList.add("active");
        } else {
            classes[i].classList.remove("active");
        }
    }
}

const hamburgerNav = document.getElementById("hamburgerNav");
const navsectionLink = document.querySelector(".navsectionLink");
const navCloseDIv = document.querySelector(".navCloseDIv");
navsectionLink.style.right = "-120%";
const navToggleFuction = () => {
    if (navsectionLink.style.right === "-120%") {
        navsectionLink.style.right = "-12px";
        hamburgerNav.classList.add("crossNav");
        navCloseDIv.style.display = "block";
    } else {
        navsectionLink.style.right = "-120%";
        hamburgerNav.classList.remove("crossNav");
        navCloseDIv.style.display = "none";
    }
};

hamburgerNav.addEventListener("click", () => {
    navToggleFuction();
});

navCloseDIv.addEventListener("click", () => {
    navToggleFuction();
});
</script>