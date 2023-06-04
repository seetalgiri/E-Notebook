<?php
// Include the necessary files
include '../../admin/UserSessionData.php';
include '../../Configuration.php';

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
    $facultyName = "";
    $subName = "";

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

    if (isset($_POST['noteUpdateUpload'])) {
        $update = $_POST['update'];

        if (isset($_FILES['note']) && $_FILES['note']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['note'];
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];

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
                $lastPath = $notePath . $unique_filename;
            } else {
                echo "Error uploading file.";
                exit;
            }

            // Prepare the update query
            $updateQuery = "UPDATE notes SET post_des = '$description', stream_id = '$facultyid', sub_id = '$subjectid', note_name = '$noteName', note_category = '$section', note_file = '$lastPath', stream_name = '$facultyName', sem = '$sem', year = '$year', sub_name = '$subName', author='$author'
            WHERE id = '$update'";

            // Execute the update query
            if (mysqli_query($con, $updateQuery)) {
                header("Location: ../../admin/notepost.php");
            } else {
                echo "Error updating record: " . mysqli_error($con);
            }
        } else {
            $updateQuery = "UPDATE notes SET post_des = '$description', stream_id = '$facultyid', sub_id = '$subjectid', note_name = '$noteName', note_category = '$section', stream_name = '$facultyName', sem = '$sem', year = '$year', sub_name = '$subName', author='$author'
            WHERE id = '$update'";

            if (mysqli_query($con, $updateQuery)) {
                header("Location: ../../admin/notepost.php");
            } else {
                echo "Error updating record: " . mysqli_error($con);
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
                $lastPath = $notePath . $unique_filename;
                // Prepare the insert query
                $insertQuery = "INSERT INTO notes (post_des, stream_id, sub_id, note_file, note_name, note_category, stream_name, sem, year, sub_name, author)
                            VALUES ('$description', '$facultyid', '$subjectid', '$lastPath', '$noteName', '$section', '$facultyName', '$sem', '$year', '$subName', $author)";

                // Execute the insert query
                if (mysqli_query($con, $insertQuery)) {
                    header("Location: ../../admin/notepost.php");
                } else {
                    echo "Error inserting record: " . mysqli_error($con);
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "No file uploaded.";
        }
    }

    // Close the database connection
    mysqli_close($con);
}
