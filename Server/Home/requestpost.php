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
if (isset($_POST['requestDis']) && isset($_POST['stream']) && isset($_FILES['file']) && isset($_POST['semYr']) && isset($_POST['subname']) && isset($_POST['notename'])) {
    $postdes = $_POST['requestDis'];
    $semYr = $_POST['semYr'];
    $subname = $_POST['subname'];
    $notename = $_POST['notename'];
    $stream = $_POST['stream'];

    // Check if an image is uploaded
    if (isset($_FILES['file']) && $_FILES['file']['size'] > 0) {
        $file = $_FILES['file'];

        // File upload logic
        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        // File extension
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Allowed file extensions
        $allowedExtensions = ['pdf'];

        // Check if the file has a valid extension
        if (in_array($fileExt, $allowedExtensions)) {
            // Generate a unique name for the file
            $newFileName = uniqid('', true) . '.' . $fileExt;

            // Set the destination path to store the uploaded file
            $destination = '../uploads/request/' . $newFileName;

            // Move the uploaded file to the destination
            if (move_uploaded_file($fileTmp, $destination)) {
                // Construct the SQL statement with image data
                $imagePath = $uploadFIleFront . 'request/' . $newFileName;
                $sql = "INSERT INTO `requestpost` (`description`, `stream`, `file`, `semYr`, `sub_name`, `note_name`, `author_name`, `author_id`) VALUES ('$postdes', '$stream', '$imagePath', '$semYr', '$subname', '$notename', '$username', '$id')";
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
        $sql = "INSERT INTO `requestpost` (`description`, `stream`, `file`, `semYr`, `sub_name`, `note_name`, `author_name`, `author_id`) VALUES ('$postdes', '$stream', NULL, '$semYr', '$subname', '$notename', '$author', '$id')";
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
}

// Close the database connection
mysqli_close($conn);
