<?php

session_start();

include '../Configuration.php';
include './auths.php';

// Database connection
$con = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);

if (!$con) {
    die("Could not connect to the database");
}

if (isset($_POST['post'])) {
    $faculty_name = $_POST['fname'];
    $yearsem = $_POST['yearsem'];

    // Prepare the query to insert the post into the database
    $query = "INSERT INTO `faculty` (`faculty_name`,`yearsem`) VALUES ('$faculty_name', '$yearsem')";

    // Execute the query
    $result = mysqli_query($con, $query);

    // Check if the query was successful
    if ($result) {
        echo "Faculty name successfully inserted in the database";
    } else {
        echo "Error: Unable to add the faculty name.";
    }
}

// Close the database connection
mysqli_close($con);
