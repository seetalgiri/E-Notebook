const modalContent = document.getElementById("modalContent");
const svgbtn = document.querySelector("#sideButton svg");
modalContent.style.right = "-475px";
svgbtn.style.transform = "  rotateZ(180deg)";

function modalBtnclk() {
  if (modalContent.style.right === "0px") {
    modalContent.style.right = "-475px";
    svgbtn.style.transform = "rotateZ(180deg)";
    removeParams();
  } else {
    modalContent.style.right = "0px";
    svgbtn.style.transform = "rotateZ(0deg)";
  }
}
// when url have chaptername and description modal open
var urlParams = new URLSearchParams(window.location.search);
var chaptername = urlParams.get("chaptername");
var description = urlParams.get("description");
var username = urlParams.get("username");
var subname = urlParams.get("subname");
var stream = urlParams.get("stream");
var sem_year = urlParams.get("sem_year");
const PostDesctiption = document.getElementById("PostDesctiption");
const noteName = document.getElementById("noteName");

if (chaptername && description) {
  modalContent.style.right = "0px";
  svgbtn.style.transform = "rotateZ(0deg)";
  var discontent = `${description}\nStream: ${stream}\nSem/year: ${sem_year}\nSubject Name: ${subname}\nUsername: ${username}`;
  PostDesctiption.value = discontent;
  noteName.value = chaptername;
}

const removeParams = () => {
  var url = new URL(window.location.href);
  url.search = ""; // Remove all parameters

  var newUrl = url.href;

  history.pushState(null, null, newUrl);
};
window.onclick = function (event) {
  const parentId = event.target.parentNode.id;
  const par = event.target;
  if (
    event.target.id !== "forms" &&
    parentId !== "sidenav" &&
    parentId !== "sideButton" &&
    parentId !== "modalContent" &&
    parentId !== "forms" &&
    parentId !== "editbtn"
  ) {
    if (modalContent.style.right !== "-475px") {
      modalContent.style.right = "-475px";
      svgbtn.style.transform = "rotateZ(180deg)";
    }
  }

  const parentId1 = event.target.parentNode.id;
  const parentId2 = event.target.parentNode.id;
  if (
    event.target.id !== "sidenav" &&
    event.target.id !== "hamburger" &&
    parentId1 !== "hamburger" &&
    parentId2 !== "sideNavLikes"
  ) {
    if (sidenav.style.width === "220px") {
      hambarclk();
    }
  }

  if (
    event.target.id !== "adminProfile1" &&
    event.target.id !== "adminppLink" &&
    parentId !== "adminppLink" &&
    parentId !== "adminProfile1"
  ) {
    listItemsAdminPp.style.display = "none";
  }
};

function openmodal(id) {
  modalContent.style.right = "0px";
  svgbtn.style.transform = "rotateZ(0deg)";
}
var searchParams = new URLSearchParams(window.location.search);
var editParam = searchParams.get("edit");
if (Number(editParam)) {
  openmodal();
}
