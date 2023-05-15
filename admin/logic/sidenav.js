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
const currentPage = currentUrl.substr(currentUrl.lastIndexOf("/") + 1);
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
