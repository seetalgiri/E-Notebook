// Grid View Logic
const flexButtonSet = document.getElementById("flexbuttonset");
const mainViewContent = document.getElementById("mainViewContent");
const gridViewButton = document.querySelector("#gridView");
const listViewButton = document.querySelector("#listView");

// Set initial view type in local storage
if (!localStorage.getItem("view")) {
  localStorage.setItem("view", "grid");
}

// Functions for list view and grid view
const switchToListView = () => {
  listViewButton.style.display = "block";
  gridViewButton.style.display = "none";
  mainViewContent.classList.add("flexContent");
  mainViewContent.classList.remove("gridContent");
};

const switchToGridView = () => {
  listViewButton.style.display = "none";
  gridViewButton.style.display = "block";
  mainViewContent.classList.remove("flexContent");
  mainViewContent.classList.add("gridContent");
};

// Local storage logic
if (localStorage.getItem("view") !== "grid") {
  switchToListView();
} else {
  switchToGridView();
}

// Button click logic
gridViewButton.addEventListener("click", () => {
  localStorage.setItem("view", "list");
  switchToListView();
});

listViewButton.addEventListener("click", () => {
  localStorage.setItem("view", "grid");
  switchToGridView();
});

// Responsive Filter Section
const filterSec = document.querySelector(".filtersec");
const filterNotes = document.querySelector(".filterNotes");
const crossSection = document.querySelector("#crosssection");
const filterSection = document.querySelector("#filterSection");

filterSec.style.left = "-350px";

const toggleSection = () => {
  filterSec.style.left = filterSec.style.left === "-350px" ? "0px" : "-350px";
  filterSection.style.display =
    filterSec.style.left === "-350px" ? "none" : "block";
};

filterNotes.addEventListener("click", () => {
  if (window.innerWidth < 940) {
    toggleSection();
  }
});

crossSection.addEventListener("click", toggleSection);
filterSection.addEventListener("click", toggleSection);

let sem = `<option>Select Semester</option>
                    <option value='1'>First Semester</option>
                    <option value='2'>Second Semester</option>
                    <option value='3'>Third Semester</option>
                    <option value='4'>Fourth Semester</option>
                    <option value='5'>Fifth Semester</option>
                    <option value='6'>Sixth Semester</option>
                    <option value='7'>Seventh Semester</option>
                    <option value='8'>Eighth Semester</option>
                    `;

let year = `<option>Select Year</option>    
                    <option value='1'>First Year</option>
                    <option value='2'>Second Year</option>
                    <option value='3'>Third Year</option>
                    <option value='4'>Fourth Year</option>
                   `;

// setting year and sem
const semyear = document.getElementById("semyearsel");
const initialval = document.querySelector("#mySelect option");

let initialvaltype = initialval.getAttribute("data_yearsem");
let HTML = Number(initialvaltype) === 1 ? year : sem;

// changing faculty value;
function myFunction() {
  var selectElement = document.getElementById("mySelect");
  var selectedOption = selectElement.options[selectElement.selectedIndex];
  let type = selectedOption.getAttribute("data_yearsem");
  if (Number(type) === 1) {
    semyear.setAttribute("name", "year");
    HTML = year;
  } else {
    semyear.setAttribute("name", "sem");
    HTML = sem;
  }
  semyear.innerHTML = HTML;
}
let type = myFunction();
