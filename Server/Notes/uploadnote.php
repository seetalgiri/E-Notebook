<?php
// Include the necessary files
require_once '../../admin/UserSessionData.php';
require_once '../../Configuration.php';

// Database connection
$con = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);

if (!$con) {
    die("Could not connect to the database");
}

if (isset($_POST['notePostUpload']) || isset($_POST['noteUpdateUpload'])) {
    $description = isset($_POST['description']) ? $_POST['description'] : "";
    $facultyid = isset($_POST['facultyid']) ? $_POST['facultyid'] : 0;
    $subjectid = isset($_POST['subject']) ? $_POST['subject'] : 0;
    $section = isset($_POST['section']) ? $_POST['section'] : "";
    $noteName = isset($_POST['noteName']) ? $_POST['noteName'] : "";
    $author = isset($_POST['author']) ? $_POST['author'] : "";
    $sem = isset($_POST['sem']) ? $_POST['sem'] : "";
    $year = isset($_POST['year']) ? $_POST['year'] : "";

    // Validate faculty ID
    if ($facultyid == 0 || $facultyid == "") {
        header("Location: ../../admin/notepost.php?error=Please select a faculty");
    }

    // Validate subject ID
    if ($subjectid == 0 || $subjectid == "") {
        header("Location: ../../admin/notepost.php?error=Please select a subject");
    }

    // Prepare the faculty name query
    $facultyName = "";
    $sqlfacName = "SELECT faculity_name FROM faculty WHERE id = $facultyid";
    $resultFacName = mysqli_query($con, $sqlfacName);

    if (mysqli_num_rows($resultFacName) > 0) {
        $faculty = mysqli_fetch_array($resultFacName);
        $facultyName = $faculty['faculity_name'];
    }

    // Prepare the subject name query
    $subName = "";
    $sqlfSubject = "SELECT name FROM subname WHERE id = $subjectid";
    $resultSubName = mysqli_query($con, $sqlfSubject);

    if (mysqli_num_rows($resultSubName) > 0) {
        $subject = mysqli_fetch_array($resultSubName);
        $subName = $subject['name'];
    }

    if (isset($_POST['noteUpdateUpload'])) {
        $update = $_POST['update'];

        // File upload handling
        if (isset($_FILES['note']) && $_FILES['note']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['note'];
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];

            // Check if the file is a PDF
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            if ($file_ext !== "pdf") {
                header("Location: ../../admin/notepost.php?error=Only PDF files are allowed");
            }

            // Define the upload directory based on section
            $upload_dir = '';
            $notePath = '';
            switch ($section) {
                case 'syllabus':
                    $upload_dir = '../uploads/syllabus/';
                    $notePath = $uploadFIleFront . 'syllabus/';
                    break;
                case 'prevqn':
                    $upload_dir = '../uploads/prevqn/';
                    $notePath = $uploadFIleFront . 'prevqn/';
                    break;
                default:
                    $upload_dir = '../uploads/notes/';
                    $notePath = $uploadFIleFront . 'notes/';
                    break;
            }

            // Generate a unique filename
            $unique_filename = uniqid('', true) . '.' . $file_ext;

            // Set the destination path to store the uploaded file
            $destination = $upload_dir . $unique_filename;

            // Move the uploaded file to the desired location
            if (move_uploaded_file($file_tmp, $destination)) {
                $lastPath = $notePath . $unique_filename;

                // Prepare the update query
                $updateQuery = "UPDATE notes SET post_des = ?, stream_id = ?, sub_id = ?, note_name = ?, note_category = ?, note_file = ?, stream_name = ?, sem = ?, year = ?, sub_name = ?, author = ?
                WHERE id = ?";

                // Create a prepared statement
                $stmt = mysqli_prepare($con, $updateQuery);

                // Bind the parameters to the statement
                mysqli_stmt_bind_param($stmt, "siissssiissi", $description, $facultyid, $subjectid, $noteName, $section, $lastPath, $facultyName, $sem, $year, $subName, $author, $update);

                // Execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    header("Location: ../../admin/notepost.php?success=note update successfully");
                    exit;
                } else {
                    header("Location: ../../admin/notepost.php?error=sorry cannot update note");
                }
            } else {
                header("Location: ../../admin/notepost.php?error=Error uploading file");
            }
        } else {
            $updateQuery = "UPDATE notes SET post_des = ?, stream_id = ?, sub_id = ?, note_name = ?, note_category = ?, stream_name = ?, sem = ?, year = ?, sub_name = ?, author = ?
            WHERE id = ?";

            // Create a prepared statement
            $stmt = mysqli_prepare($con, $updateQuery);

            // Bind the parameters to the statement
            mysqli_stmt_bind_param($stmt, "siisssiissi", $description, $facultyid, $subjectid, $noteName, $section, $facultyName, $sem, $year, $subName, $author, $update);

            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                header("Location: ../../admin/notepost.php?success=note update successfully");
                exit;
            } else {
                header("Location: ../../admin/notepost.php?error=cannot update note");
            }
        }
    } else {
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
                header("Location: ../../admin/notepost.php?error=only PDF file allowed");
            }

            // Define the upload directory based on section
            $upload_dir = '';
            $notePath = '';
            switch ($section) {
                case 'syllabus':
                    $upload_dir = '../uploads/syllabus/';
                    $notePath = $uploadFIleFront . 'syllabus/';
                    break;
                case 'prevqn':
                    $upload_dir = '../uploads/prevqn/';
                    $notePath = $uploadFIleFront . 'prevqn/';
                    break;
                default:
                    $upload_dir = '../uploads/notes/';
                    $notePath = $uploadFIleFront . 'notes/';
                    break;
            }

            // Generate a unique filename
            $unique_filename = uniqid('', true) . '.' . $file_ext;

            // Set the destination path to store the uploaded file
            $destination = $upload_dir . $unique_filename;

            // Move the uploaded file to the desired location
            if (move_uploaded_file($file_tmp, $destination)) {
                $lastPath = $notePath . $unique_filename;

                // Prepare the insert query
                $insertQuery = "INSERT INTO notes (post_des, stream_id, sub_id, note_file, note_name, note_category, stream_name, sem, year, sub_name, author)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                // Create a prepared statement
                $stmt = mysqli_prepare($con, $insertQuery);

                // Bind the parameters to the statement
                mysqli_stmt_bind_param($stmt, "siissssssss", $description, $facultyid, $subjectid, $lastPath, $noteName, $section, $facultyName, $sem, $year, $subName, $author);

                // Execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    header("Location: ../../admin/notepost.php?success=note added successfully");
                    exit;
                } else {
                    echo "Error inserting record: " . mysqli_error($con);
                    header("Location: ../../admin/notepost.php?error=cannot added note");
                }
            } else {
                header("Location: ../../admin/notepost.php?error=Error uploading file");
                // echo "Error uploading file.";
            }
        } else {
            // echo "No file uploaded.";
            header("Location: ../../admin/notepost.php?error=No file uploaded");
        }
    }

    // Close the database connection
    mysqli_close($con);
}
