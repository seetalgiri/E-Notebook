let date = new Date();
let hour = date.getHours();
let greet = "";

if (hour >= 5 && hour < 12) {
  greet = "Good morning, Admin!";
} else if (hour >= 12 && hour < 18) {
  greet = "Good afternoon, Admin!";
} else {
  greet = "Good evening, Admin!";
}
let greetingParagraph = document.getElementById("greeting");
greetingParagraph.textContent = greet;
const sidenav = document.getElementById("sidenav");
const div1 = document.querySelector(".div1");
const div2 = document.querySelector(".div2");
const div3 = document.querySelector(".div3");
const currentUrl = window.location.href;
const currentPage = currentUrl
  .split("?")[0]
  .substr(currentUrl.lastIndexOf("/") + 1);
sidenav.style.width = "90px";
const lists = document.getElementsByClassName("lists");
const listName = document.getElementsByClassName("listName");
const borderDesign = document.querySelectorAll(".lists a");
const addressTracker = document.querySelectorAll(".addressTracker");

for (let i = 0; i < addressTracker.length; i++) {
  if (addressTracker[i].classList.contains(currentPage.slice(0, -4))) {
    addressTracker[i].classList.add("active");
  } else {
    addressTracker[i].classList.remove("active");
  }
}

const hambarclk = () => {
  const width = sidenav.style.width;
  if (width === "90px") {
    sidenav.style.width = "220px";
    div3.classList.add("crossDiv3");
    div2.classList.add("crossDiv2");
    div1.style.display = "none";
    for (let i = 0; i < lists.length; i++) {
      lists[i].classList.remove("listItems");
      borderDesign[i].style.border =
        "1px solid var(--light-border-clor-opacity2)";
    }
    for (let i = 0; i < listName.length; i++) {
      listName[i].style.display = "block";
    }
  } else {
    sidenav.style.width = "90px";
    div3.classList.remove("crossDiv3");
    div2.classList.remove("crossDiv2");
    div1.style.display = "block";
    for (let i = 0; i < lists.length; i++) {
      lists[i].classList.add("listItems");
      borderDesign[i].style.border = "none";
    }
    for (let i = 0; i < listName.length; i++) {
      listName[i].style.display = "none";
    }
  }
};

const bodyMode = document.getElementsByTagName("body")[0];

if (localStorage.getItem("mode") === "dark") {
  bodyMode.classList.add("Darkmode");
} else {
  bodyMode.classList.remove("Darkmode");
}
const adminProfile = document.getElementById("adminProfile");
const listItemsAdminPp = document.getElementById("listItemsAdminPp");
listItemsAdminPp.style.display = "none";
adminProfile.addEventListener("click", () => {
  if (listItemsAdminPp.style.display === "none") {
    listItemsAdminPp.style.display = "block";
  } else {
    listItemsAdminPp.style.display = "none";
  }
});
window.onclick = function (event) {
  const parentId = event.target.parentNode.id;
  const parentId2 = event.target.parentNode.id;
  if (
    event.target.id !== "adminProfile1" &&
    event.target.id !== "adminppLink" &&
    parentId !== "adminppLink" &&
    parentId !== "adminProfile1"
  ) {
    listItemsAdminPp.style.display = "none";
  }
  if (
    event.target.id !== "sidenav" &&
    event.target.id !== "hamburger" &&
    parentId !== "hamburger" &&
    parentId2 !== "sideNavLikes"
  ) {
    if (sidenav.style.width === "220px") {
      hambarclk();
    }
  }
};

const toggleMode = document.getElementById("toggleMode");

const LightHTML = `<div id='eachModeLight' class="light eachmode">
            <svg onclick="modeClick()" width="22" height="22" viewBox="0 0 22 22" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M2.55 18.09L3.96 19.5L5.76 17.71L4.34 16.29M11 5C7.69 5 5 7.69 5 11C5 14.31 7.69 17 11 17C14.31 17 17 14.31 17 11C17 7.68 14.31 5 11 5ZM19 12H22V10H19M16.24 17.71L18.04 19.5L19.45 18.09L17.66 16.29M19.45 4L18.04 2.6L16.24 4.39L17.66 5.81M12 0H10V3H12M5.76 4.39L3.96 2.6L2.55 4L4.34 5.81L5.76 4.39ZM0 12H3V10H0M12 19H10V22H12"
                    fill="orange" />
            </svg>
            <div class="hoverMode">Light Mode</div>
        </div>`;
const DarkHTML = `<div id='eachModeDark' class="dark eachmode">
        <svg onclick="modeClick()" width="20" height="22" viewBox="0 0 20 22" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M16.3608 3.64627L13.8308 5.58627L14.7408 8.64627L12.1108 6.83627L9.48079 8.64627L10.3908 5.58627L7.86079 3.64627L11.0508 3.55627L12.1108 0.556274L13.1708 3.55627L16.3608 3.64627ZM19.8608 10.5563L18.2208 11.8063L18.8108 13.7863L17.1108 12.6163L15.4108 13.7863L16.0008 11.8063L14.3608 10.5563L16.4208 10.5063L17.1108 8.55627L17.8008 10.5063L19.8608 10.5563ZM17.5808 15.5063C18.4108 15.4263 19.3008 16.6063 18.7708 17.3563C18.4508 17.8063 18.1108 18.2263 17.6908 18.6263C13.7808 22.5563 7.45079 22.5563 3.55079 18.6263C-0.359214 14.7263 -0.359214 8.38627 3.55079 4.48627C3.95079 4.08627 4.37079 3.72627 4.82079 3.40627C5.57079 2.87627 6.75079 3.76627 6.67079 4.59627C6.40079 7.45627 7.36079 10.4263 9.56079 12.6163C11.7508 14.8163 14.7108 15.7763 17.5808 15.5063ZM15.9408 17.5263C13.1108 17.3663 10.3108 16.1963 8.14079 14.0563C5.97079 11.8663 4.81079 9.05627 4.65079 6.23627C1.84079 9.37627 1.95079 14.1963 4.96079 17.2163C7.98079 20.2263 12.8008 20.3363 15.9408 17.5263Z"
                fill="#000b32d4" />
        </svg>
        <div class="hoverMode">Dark Mode</div>
    </div>`;

if (localStorage.getItem("mode") === "dark") {
  bodyMode.classList.add("Darkmode");
  toggleMode.innerHTML = LightHTML;
} else {
  bodyMode.classList.remove("Darkmode");
  toggleMode.innerHTML = DarkHTML;
}
// for dark and light mode
const modeClick = () => {
  if (localStorage.getItem("mode") === "dark") {
    toggleMode.innerHTML = DarkHTML;
    bodyMode.classList.remove("Darkmode");
    localStorage.setItem("mode", "light");
  } else {
    toggleMode.innerHTML = LightHTML;
    bodyMode.classList.add("Darkmode");
    localStorage.setItem("mode", "dark");
  }
};
window.addEventListener("scroll", function () {
  let scrollY = Math.ceil(window.scrollY || window.pageYOffset);
  if (scrollY > 140) {
    toggleMode.style.right = "-100px";
    toggleMode.style.opacity = "0";
  } else {
    toggleMode.style.right = "0px";
    toggleMode.style.opacity = "1";
  }
});
