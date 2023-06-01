// Get the current year
const date = new Date();
const year = date.getFullYear();

// Set the current year in the footer
const currentYearSpan = document.getElementById("currentYear");
currentYearSpan.textContent = year;

function modalClose() {
  document.getElementById("postModal").style.display = "none";
  document.body.style.overflow = "auto";
}

function modalOpen() {
  document.getElementById("postModal").style.display = "block";
  document.body.style.overflow = "hidden";
  let inputField = document.getElementById("postContentMod");
  inputField.focus();
}

document.addEventListener("click", (e) => {
  if (e.target.id === "postModalRel") {
    modalClose();
  }
});

const NotesInnterHtml = ` <form action="" id="filerequestModal">
<div class="buttonclscontentPlc buttonclscontentPlcreq">
  <div class="buttontextAreadiv requestNotice">
    <textarea
      name="requestDis"
      id="postContentMod"
      placeholder="What do you want to request?"
    ></textarea>
  </div>
</div>
<div class="buttonclscontent maincontentfotChoose">
  <div class="streamDiv">
    <div class="stream streamChooseDiv" id="selecterStream">
     
      <li class="selectSreamradio">
        <input type="radio" id="bca" value="bca" name="stream" />
        <label class="btn btn-default" for="bca"
          ><span>BCA</span>
          <svg
            width="14"
            height="15"
            viewBox="0 0 16 18"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z"
            /></svg
        ></label>
      </li>
      <li class="selectSreamradio">
        <input type="radio" id="bbm" value="bbm" name="stream" />
        <label class="btn btn-default" for="bbm"
          ><span>BBM</span>
          <svg
            width="14"
            height="15"
            viewBox="0 0 16 18"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z"
            /></svg
        ></label>
      </li>
      <li class="selectSreamradio">
        <input type="radio" id="bbs" value="bbs" name="stream" />
        <label class="btn btn-default" for="bbs"
          ><span>BBS</span>
          <svg
            width="14"
            height="15"
            viewBox="0 0 16 18"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z"
            /></svg
        ></label>
      </li>
      <li class="selectSreamradio">
        <input type="radio" id="bsw" value="bsw" name="stream" />
        <label class="btn btn-default" for="bsw"
          ><span>BSW</span>
          <svg
            width="14"
            height="15"
            viewBox="0 0 16 18"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z"
            /></svg
        ></label>
      </li>
      <li class="selectSreamradio">
        <input type="radio" id="mbs" value="mbs" name="stream" />
        <label class="btn btn-default" for="mbs"
          ><span>MBS</span>
          <svg
            width="14"
            height="15"
            viewBox="0 0 16 18"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z"
            /></svg
        ></label>
      </li>
    </div>
  </div>
</div>
<div class="saperations"></div>
<div class="buttonclscontent">
  <div class="streamDiv">
    <div class="stream streamChooseDiv semdivision">
      <div id="selectFiles">
        <input
          type="file"
          id="pdfupload"
          name="file"
          accept=".pdf"
          style="display: none"
        />
        <div class="buttonclscontent maincontentfotChoose">
          <div class="filechoose">
            <svg
              width="10"
              id="uploadbtn"
              height="10"
              viewBox="0 0 20 19"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M12.381 4C10.2762 4 8.57143 5.79 8.57143 8V16H1.90476C0.857143 16 0 15.11 0 14V2C0 0.89 0.847619 0 1.90476 0H7.61905L9.52381 2H17.1429C18.1905 2 19.0476 2.89 19.0476 4V6.17L17.5333 4.59L16.981 4H12.381ZM20 10V17C20 18.11 19.1524 19 18.0952 19H12.381C11.3333 19 10.4762 18.11 10.4762 17V8C10.4762 6.9 11.3333 6 12.381 6H16.1905L20 10ZM18.0952 10.83L15.4 8H15.2381V11H18.0952V10.83Z"
              />
            </svg>
            <div id="fileLabel">Upload PDF</div>
          </div>
        </div>
      </div>
      <div id="secYrName">
        <input
          type="text"
          name="semYr"
          id="semYr"
          placeholder="Enter Sem/Year"
        />
      </div>
    </div>
  </div>
</div>
<div class="buttonclscontent flex justify-between">
  <input
    type="text"
    class="subname border inputFldsSendreq"
    placeholder="Enter Subject Name"
    name="subname"
  />
  <input
    type="text"
    class="note border inputFldsSendreq"
    placeholder="Enter Note Name"
    name="notename"
  />
</div>
<div class="buttonclscontent border postBtn">
  <button>REQUEST</button>
</div>
</form>`;

const NoticeInnerHtml = `<form action="./Server/Home/indexback.php" enctype="multipart/form-data" method="post">
            <div class="buttonclscontentPlc">
              <div class="buttontextAreadiv">
                <textarea name="post" id="postContentMod" placeholder="What is on your mind?"></textarea>
              </div>
            </div>
            <input type="file" id="pdfuploadnote" name="image" accept="image/png, image/jpeg, image/jpg" style="display: none;"> 
            <div class="buttonclscontent maincontentfotChoose">
              <div class="filechoose">
                <svg width="19" id="uploadbtnnote" height="19" viewBox="0 0 19 19" xmlns="http://www.w3.org/2000/svg">
                  <path d="M6.47876 10.9471L8.97876 13.9471L12.4788 9.44706L16.9788 15.4471H2.97876M18.9788 16.4471V2.44706C18.9788 1.33706 18.0788 0.447063 16.9788 0.447063H2.97876C2.44833 0.447063 1.93962 0.657777 1.56455 1.03285C1.18947 1.40792 0.97876 1.91663 0.97876 2.44706V16.4471C0.97876 16.9775 1.18947 17.4862 1.56455 17.8613C1.93962 18.2363 2.44833 18.4471 2.97876 18.4471H16.9788C17.5092 18.4471 18.0179 18.2363 18.393 17.8613C18.768 17.4862 18.9788 16.9775 18.9788 16.4471Z" />
                </svg>
              </div>
              <div class="Divisionsection"></div>
              <div class="streamDiv">
                <div class="stream streamChooseDiv" id="selecterStream">
              <li class="selectSreamradio">
                <input type="radio" id="a25" name="stream" value="ALL" checked/>
                <label class="btn btn-default" for="a25"
                  ><span>ALL</span>
                  <svg
                    width="14"
                    height="15"
                    viewBox="0 0 16 18"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z"
                    /></svg
                ></label>
              </li>
                <li class="selectSreamradio">
                <input type="radio" id="BcaRad" name="stream" value="BCA"/>
                <label class="btn btn-default" for="BcaRad"
                  ><span>BCA</span>
                  <svg
                    width="14"
                    height="15"
                    viewBox="0 0 16 18"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z"
                    /></svg
                ></label>
              </li>
                <li class="selectSreamradio">
                <input type="radio" id="Bbmrad" name="stream" value="BBM"/>
                <label class="btn btn-default" for="Bbmrad"
                  ><span>BBM</span>
                  <svg
                    width="14"
                    height="15"
                    viewBox="0 0 16 18"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z"
                    /></svg
                ></label>
              </li>
                <li class="selectSreamradio">
                <input type="radio" id="BBsRad" name="stream" value="BBS"/>
                <label class="btn btn-default" for="BBsRad"
                  ><span>BBS</span>
                  <svg
                    width="14"
                    height="15"
                    viewBox="0 0 16 18"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z"
                    /></svg
                ></label>
              </li>
                <li class="selectSreamradio">
                <input type="radio" id="BswRad" name="stream" value="BSW"/>
                <label class="btn btn-default" for="BswRad"
                  ><span>BSW</span>
                  <svg
                    width="14"
                    height="15"
                    viewBox="0 0 16 18"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z"
                    /></svg
                ></label>
              </li>
                  <li class="dropdown">
                    <div class="dotLine"></div>
                    <div class="dotLine"></div>
                    <div class="dotLine"></div>
                  </li>
                </div>
              </div>
              </div>
            </div>
            <div class="buttonclscontent border postBtn">
              <button name="postnews">POST</button>
            </div>
          </form>`;

// for notice modal
// Get the necessary elements from the DOM
const uploadNotice = document.getElementById("uploadNotice");
const uploadNote = document.getElementById("uploadNote");
const formDiv = document.getElementById("formDiv");

// Set the initial form content
formDiv.innerHTML = NoticeInnerHtml;

// Get the upload button and file input for the notice form
const uploadBtnNote = document.getElementById("uploadbtnnote");
const fileInputNote = document.getElementById("pdfuploadnote");

// Add event listeners to trigger file input when upload button is clicked
uploadBtnNote.addEventListener("click", () => {
  fileInputNote.click();
});

// Handle the uploaded file when the file input changes
fileInputNote.addEventListener("change", () => {
  const file = fileInputNote.files[0];
  console.log("Uploaded file:", file);
});

// Function to handle file upload
function handleFileUpload(fileInput) {
  const file = fileInput.files[0];
  console.log("Uploaded file:", file);
}

// Function to set the upload button functionality
function setUploadButton(uploadBtn, fileInput) {
  uploadBtn.addEventListener("click", () => {
    fileInput.click();
  });
}

// Function to set focus on an input field
function setFocus(inputField) {
  inputField.focus();
}

// Event handler for the upload notice button
function uploadNoticeHandler() {
  // Update the form content to notice form
  formDiv.innerHTML = NoticeInnerHtml;

  // Update the button styles
  uploadNotice.classList.remove("inactivebtnPost");
  uploadNote.classList.add("inactivebtnPost");

  // Get the file input for the notice form
  const fileInput = document.getElementById("pdfuploadnote");

  // Handle the uploaded file when the file input changes
  fileInput.addEventListener("change", () => {
    handleFileUpload(fileInput);
  });

  // Set the upload button functionality
  setUploadButton(document.getElementById("uploadbtnnote"), fileInput);

  // Set focus on a specific input field
  setFocus(document.getElementById("postContentMod"));
}

// Event handler for the upload note button
function uploadNoteHandler() {
  // Update the form content to note form
  formDiv.innerHTML = NotesInnterHtml;

  // Update the button styles
  uploadNote.classList.remove("inactivebtnPost");
  uploadNotice.classList.add("inactivebtnPost");

  // Get the file input for the note form
  const fileInput = document.getElementById("pdfupload");

  // Handle the uploaded file when the file input changes
  fileInput.addEventListener("change", () => {
    handleFileUpload(fileInput);
  });

  // Set the upload button functionality
  setUploadButton(document.getElementById("uploadbtn"), fileInput);

  // Set focus on a specific input field
  setFocus(document.getElementById("postContentMod"));

  var selectFiles = document.getElementById("selectFiles");
  selectFiles.addEventListener("click", function () {
    var pdfInput = document.getElementById("pdfupload");
    pdfInput.click();
  });

  var pdfInput = document.getElementById("pdfupload");
  pdfInput.addEventListener("change", displayFileName);
  pdfInput.addEventListener("click", function (event) {
    // Prevent the click event from propagating to the upload button
    event.stopPropagation();
  });
}

// Add event listeners to the upload notice and upload note buttons
uploadNotice.addEventListener("click", uploadNoticeHandler);
uploadNote.addEventListener("click", uploadNoteHandler);

// for upload file ============================
function displayFileName() {
  var fileInput = document.getElementById("pdfupload");
  var fileLabel = document.getElementById("fileLabel");

  if (fileInput.files.length > 0) {
    fileLabel.textContent =
      String(fileInput.files[0].name).length > 18
        ? String(fileInput.files[0].name).slice(0, 18) + "..."
        : String(fileInput.files[0].name);
  } else {
    fileLabel.textContent = "Upload PDF";
  }
}
