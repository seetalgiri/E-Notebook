const modalContent = document.getElementById("modalContent");
const svgbtn = document.querySelector("#sideButton svg");
const fname = document.getElementById("fname");
const stdType = document.querySelectorAll("#stdType option");
const yrType = Array.from(stdType);
const idnum = document.getElementById("idnum");
const submitBtn = document.getElementById("submitBtn");
modalContent.style.right = "-378px";
svgbtn.style.transform = "  rotateZ(180deg)";

const reloadPage = () => {
  const currentURL = window.location.href;
  const newURL = currentURL.split("?")[0];
  history.replaceState(null, null, newURL);
  location.reload();
};

function modalBtnclk() {
  if (modalContent.style.right === "0px") {
    fname.value = "";
    yrType[1].removeAttribute("selected");
    yrType[0].removeAttribute("selected");
    modalContent.style.right = "-378px";
    svgbtn.style.transform = "rotateZ(180deg)";
  } else {
    modalContent.style.right = "0px";
    svgbtn.style.transform = "rotateZ(0deg)";
  }
}

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
    if (modalContent.style.right !== "-378px") {
      fname.value = "";
      yrType[1].removeAttribute("selected");
      yrType[0].removeAttribute("selected");
      modalContent.style.right = "-378px";
      svgbtn.style.transform = "rotateZ(180deg)";
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
};
// yearsem

function openmodal(data) {
  modalContent.style.right = "0px";
  svgbtn.style.transform = "rotateZ(0deg)";
  fname.value = data.faculity_name;
  if (Number(data.yearsem) == 1) {
    yrType[0].setAttribute("selected", "selected");
    yrType[1].removeAttribute("selected");
  } else {
    yrType[0].removeAttribute("selected");
    yrType[1].setAttribute("selected", "selected");
  }
  idnum.value = data.id;
  submitBtn.setAttribute("name", "updateadd");
  submitBtn.innerText = "Update";
  console.log("Exc");
}
var searchParams = new URLSearchParams(window.location.search);
var editParam = searchParams.get("edit");
if (Number(editParam)) {
  openmodal();
}
