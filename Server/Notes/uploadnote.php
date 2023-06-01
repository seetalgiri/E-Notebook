<?php

include '../../admin/UserSessionData.php';

// Importing configurations
include '../../Configuration.php';

// Database connection
$con = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);

if (!$con) {
    die("Could not connect to the database");
}

if (isset($_POST['notePostUpload'])) {
    $description = isset($_POST['description']) ? $_POST['description'] : "";
    $facultyid = isset($_POST['facultyid']) ? $_POST['facultyid'] : 0;
    $subjectid = isset($_POST['subject']) ? $_POST['subject'] : 0;
    $year = isset($_POST['year']) ? $_POST['year'] : 0;
    $sem = isset($_POST['sem']) ? $_POST['sem'] : 0;
    $section = isset($_POST['section']) ? $_POST['section'] : "";
    $noteName = isset($_POST['noteName']) ? $_POST['noteName'] : "";
    $facultyName = "";
    $subName = "";
    $note_like = "";

    // Prepare the faculty name query
    if ($facultyid != 0 && $facultyid != "") {
        $sqlfacName = "SELECT * FROM faculty WHERE id = $facultyid";
        $resultFacName = mysqli_query($con, $sqlfacName);

        if (mysqli_num_rows($resultFacName) > 0) {
            while ($faculty = mysqli_fetch_array($resultFacName)) {
                $facultyName = $faculty['faculity_name'];
            }
        }
    } else {
        die("Please select faculty");
    }

    // Prepare the subject name query
    if ($subjectid != 0 && $subjectid != "") {
        $sqlfSubject = "SELECT * FROM subname WHERE id = $subjectid";
        $resultSubName = mysqli_query($con, $sqlfSubject);

        if (mysqli_num_rows($resultSubName) > 0) {
            while ($subject = mysqli_fetch_array($resultSubName)) {
                $subName = $subject['name'];
            }
        }
    } else {
        die("Please select subject");
    }

    // File upload handling
    if (isset($_FILES['note'])) {
        $file = $_FILES['note'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];

        // Check if the file is a PDF
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if ($file_ext !== "pdf") {
            die("Only PDF files are allowed!");
        }

        // Define the upload directory based on section
        if ($section == "syllabus") {
            $upload_dir = '../uploads/syllabus/';
            $notePath =  $uploadFIleFront . 'syllabus/';
        } elseif ($section == "prevqn") {
            $upload_dir = '../uploads/prevqn/';
            $notePath =  $uploadFIleFront . 'prevqn/';
        } else {
            $upload_dir = '../uploads/notes/';
            $notePath =  $uploadFIleFront . 'notes/';
        }

        // Generate a unique filename
        $unique_filename = uniqid('', true) . '.' . $file_ext;

        // Set the destination path to store the uploaded file
        $destination = $upload_dir . $unique_filename;

        // Move the uploaded file to the desired location
        if (move_uploaded_file($file_tmp, $destination)) {
            $notePath .= $unique_filename;
            // Prepare the insert query
            $insertQuery = "INSERT INTO notes (post_des, stream_id, sem, year, sub_name, sub_id, note_file, note_name, note_category, stream_name, note_like)
                            VALUES ('$description', '$facultyid', '$sem', '$year', '$subName', '$subjectid', '$notePath', '$noteName', '$section', '$facultyName', '$note_like')";

            // Execute the insert query
            if (mysqli_query($con, $insertQuery)) {
                echo "Record inserted successfully!";
            } else {
                echo "Error inserting record: " . mysqli_error($con);
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "No file uploaded.";
    }

    // Close the database connection
    mysqli_close($con);
} else {
    echo 'Bad job';
}
