<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>E-Notebook</title>
  <link rel="stylesheet" href="./Client/styles/style.css" />
  <link rel="stylesheet" href="./Client/styles/navigatio.css" />
  <link rel="stylesheet" href="./Client/styles/global.css" />
  <link rel="stylesheet" href="./Client/styles/index.css" />
</head>

<body>
  <?php include "./Client/nav/nav.php"; ?>
  <div id="home">
    <div id="contentDiv">
      <div id="dynamicContent">
        <div id="post" class="shadow">
          <div id="userPost">G</div>
          <input type="text" name="search" class="shadow" id="createPost" placeholder="Create Post">
          <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
            <path d="M5.5 10.5L8 13.5L11.5 9L16 15H2M18 16V2C18 0.89 17.1 0 16 0H2C1.46957 0 0.960859 0.210714 0.585786 0.585786C0.210714 0.960859 0 1.46957 0 2V16C0 16.5304 0.210714 17.0391 0.585786 17.4142C0.960859 17.7893 1.46957 18 2 18H16C16.5304 18 17.0391 17.7893 17.4142 17.4142C17.7893 17.0391 18 16.5304 18 16Z" />
          </svg>
          <svg width="19" height="16" viewBox="0 0 19 16" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 16V10L8 8L0 6V0L19 8L0 16Z" />
          </svg>
        </div>
        <div id="category" class="shadow">
          <div class="stream">
            <li><a href="#" class="activestr"><span>ALL</span> <svg width="15" height="16" viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z" />
                </svg>
              </a></li>
            <li><a href="#" class=""><span>BBM</span> <svg width="15" height="16" viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z" />
                </svg>
              </a></li>
            <li><a href="#" class=""><span>BCA</span> <svg width="15" height="16" viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z" />
                </svg>
              </a></li>
            <li><a href="#" class=""><span>BSW</span> <svg width="15" height="16" viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z" />
                </svg>
              </a></li>
            <li><a href="#" class=""><span>BBS</span> <svg width="15" height="16" viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 6C12 8.21 10.21 10 8 10C5.79 10 4 8.21 4 6L4.11 5.06L1 3.5L8 0L15 3.5V8.5H14V4L11.89 5.06L12 6ZM8 12C12.42 12 16 13.79 16 16V18H0V16C0 13.79 3.58 12 8 12Z" />
                </svg>
              </a></li>
          </div>
        </div>
        <div id="eachPost">
          <div id="headerDiv">
            
          </div>
        </div>
      </div>
      <div id="fixedContent">
        <div class="shadow">
          td
        </div>
      </div>
    </div>
  </div>
</body>
<!-- <script src="./Client/logic/script.js"></script> -->

</html>