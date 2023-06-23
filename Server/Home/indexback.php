<?php
// Importing session datas
include '../../admin/UserSessionData.php';

// Importing configurations 
include '../../Configuration.php';

// Database connection
$conn = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);

if (!$conn) {
    die("Could not connect to the database");
}

// Check if the form is submitted
if (isset($_POST['postnews']) || isset($_POST['postnewsadmin'])) {
    if (intval($id) > 0) {
        $postdes = $_POST['post'];
        $stream = strtolower($_POST['stream']);
        $author = $username;
        $authorId =  $id;
        $like = "";
        $comment = "";

        // Check if an image is uploaded
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $image = $_FILES['image'];

            // Image upload logic
            $fileName = $image['name'];
            $fileTmp = $image['tmp_name'];
            $fileSize = $image['size'];
            $fileError = $image['error'];

            // File extension
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            // Allowed file extensions
            $allowedExtensions = ['jpg', 'jpeg', 'png'];

            // Check if the file has a valid extension
            if (in_array($fileExt, $allowedExtensions)) {
                // Generate a unique name for the file
                $newFileName = uniqid('', true) . '.' . $fileExt;

                // Set the destination path to store the uploaded image
                $destination = '../uploads/images/' . $newFileName;

                // Move the uploaded file to the destination
                if (move_uploaded_file($fileTmp, $destination)) {
                    // Construct the SQL statement with image data
                    $imagePath =  $uploadFIleFront . 'images/' . $newFileName;
                    $sql = "INSERT INTO `news` (`postdes`, `image`, `stream`, `author`, `authid`, `post_like`, `comment`) VALUES ('$postdes', '$imagePath', '$stream', '$author', '$authorId', '$like', '$comment')";
                } else {
                    echo 'Error uploading file.';
                    exit;
                }
            } else {
                echo 'Invalid file extension.';
                exit;
            }
        } else {
            // Construct the SQL statement without image data
            $sql = "INSERT INTO `news` (`postdes`, `stream`, `author`, `post_like`, `comment`, `authid`) VALUES ('$postdes', '$stream', '$author', '$like', '$comment', '$authorId')";
        }

        // Execute the SQL statement
        if (mysqli_query($conn, $sql)) {
            if (isset($_POST['postnewsadmin'])) {
                header("Location: ../../admin/noticepost.php");
            } else {
                header("Location: ../../index.php");
            }
            exit;
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    } else {
        header("Location: ../../auth/login.php");
    }
}

// Close the database connection
mysqli_close($conn);
