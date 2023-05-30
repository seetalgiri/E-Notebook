<?php
// importing session datas
include '../admin/UserSessionData.php';

// Importing configurations 
include '../Configuration.php';

// Database connection
$conn = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);

if (!$conn) {
    die("Could not connect to the database");
}



// =====================================to post data in database=========================
if (isset($_POST['postnews'])) {
    $postdes = $_POST['post'];
    $stream = strtolower($_POST['stream']);
    $author = $username;
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
            // Check if there is no error
            if ($fileError === 0) {
                // Set a unique name for the file
                $newFileName = uniqid('', true) . '.' . $fileExt;

                // Set the destination path to store the uploaded image
                $destination = 'uploads/' . $newFileName;

                $extaNewFile = $uploadFIleFront . $newFileName;
                // Move the uploaded file to the destination
                if (move_uploaded_file($fileTmp, $destination)) {
                    // Construct the SQL statement with image data
                    $sql = "INSERT INTO `news` (`postdes`, `image`, `stream`, `author`, `post_like`, `comment`) VALUES ('$postdes', '$extaNewFile', '$stream', '$author', '$like', '$comment')";
                } else {
                    echo 'Error uploading file.';
                    exit;
                }
            } else {
                echo 'Error: ' . $fileError;
                exit;
            }
        } else {
            echo 'Invalid file extension.';
            exit;
        }
    } else {
        // Construct the SQL statement without image data
        $sql = "INSERT INTO `news` (`postdes`, `stream`, `author`, `post_like`, `comment`) VALUES ('$postdes', '$stream', '$author', '$like', '$comment')";
    }

    // Execute the SQL statement
    if (mysqli_query($conn, $sql)) {
        header("Location: ../index.php");
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
