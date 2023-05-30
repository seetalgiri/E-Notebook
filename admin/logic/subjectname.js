const modalContent = document.getElementById("modalContent");
const svgbtn = document.querySelector("#sideButton svg");
modalContent.style.right = "-378px";
svgbtn.style.transform = "  rotateZ(180deg)";

function modalBtnclk() {
  if (modalContent.style.right === "0px") {
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
    event.target.id !== "semyearsel" &&
    event.target.id !== "semyear" &&
    parentId !== "sidenav" &&
    parentId !== "sideButton" &&
    parentId !== "modalContent" &&
    parentId !== "forms" &&
    parentId !== "editbtn"
  ) {
    if (modalContent.style.right !== "-378px") {
      modalContent.style.right = "-378px";
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

// to select semester and year
// value of sem and year
let sem = `<label id="semyear" for="semyeard">Choose Semester:</label>
                    <select name='sem' id='semyearsel'>              
                    <option value='1'>First Semester</option>
                    <option value='2'>Second Semester</option>
                    <option value='3'>Third Semester</option>
                    <option value='4'>Fourth Semester</option>
                    <option value='5'>Fifth Semester</option>
                    <option value='6'>Sixth Semester</option>
                    <option value='7'>Seventh Semester</option>
                    <option value='8'>Eighth Semester</option>
                    </select>`;

let year = `<label id="semyear" for="semyeard">Choose Year:</label>
                    <select name='year' id='semyearsel'>
                    <option value='1'>First Year</option>
                    <option value='2'>Second Year</option>
                    <option value='3'>Third Year</option>
                    <option value='4'>Fourth Year</option>
                    </select>`;

// setting year and sem
const semyear = document.getElementById("semyear");
const initialval = document.querySelector("#mySelect option");

let initialvaltype = initialval.getAttribute("data_yearsem");
let HTML = Number(initialvaltype) === 1 ? year : sem;

// changing faculty value;
function myFunction() {
  var selectElement = document.getElementById("mySelect");
  var selectedOption = selectElement.options[selectElement.selectedIndex];
  let type = selectedOption.getAttribute("data_yearsem");
  if (Number(type) === 1) {
    HTML = year;
  } else {
    HTML = sem;
  }
  semyear.innerHTML = HTML;
}
let type = myFunction();
console.log(type);
