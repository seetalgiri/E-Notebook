// Get all hambar elements
const hambarElements = document.getElementsByClassName("hambar");
const hambarArr = Array.from(hambarElements);

// Get all hamlist elements
const hamlistElements = document.getElementsByClassName("hamlist");
const hamlistArr = Array.from(hamlistElements);

// Function to hide all hamlist elements
const hideAllHamlist = () => {
  hamlistArr.forEach((hamlistElement) => {
    hamlistElement.style.display = "none";
  });
};

// Function to toggle the display of a hamlist element
const toggleHamlist = (hamlistElement) => {
  if (
    hamlistElement.style.display === "none" ||
    hamlistElement.style.display === ""
  ) {
    hideAllHamlist();
    hamlistElement.style.display = "block";
  } else {
    hamlistElement.style.display = "none";
  }
};

// Hide all hamlist elements initially
hideAllHamlist();

// Add click event listener to each hambar element
hambarArr.forEach((hambarElement) => {
  hambarElement.addEventListener("click", (event) => {
    event.stopPropagation();
    const parentHambar = hambarElement.closest(".hambar");
    const hamlistElement = parentHambar.querySelector(".hamlist");
    toggleHamlist(hamlistElement);
  });
});

// Global click event listener to hide hamlist elements when clicking outside
window.addEventListener("click", (event) => {
  let parentId = event.target.clickedElement.parentNode;
  const clickedElement = event.target;
  if (
    !clickedElement.classList.contains("hambar") &&
    !clickedElement.classList.contains("hambarul") &&
    !clickedElement.parentNode.classList.contains("hambar") &&
    !clickedElement.parentNode.classList.contains("hambarul")
  ) {
    hideAllHamlist();
  }

  if (
    event.target.id !== "adminProfile1" &&
    event.target.id !== "adminppLink" &&
    parentId !== "adminppLink" &&
    parentId !== "adminProfile1"
  ) {
    listItemsAdminPp.style.display = "none";
  }
});

// Function called when a hambar list item is clicked
const btnClicked = () => {
  console.log("Clicked");
};
