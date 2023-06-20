<?php

session_start();

include '../Configuration.php';
include 'auth.php';

// Database connection
$con = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);

if (!$con) {
    die("Could not connect to the database");
}

if (isset($_POST['post'])) {
    echo "clicked";
    // Retrieve the posted text from a form or any other source
    $author = $_POST['username'];
    $stream = $_POST['stream'];
    $postdes = $_POST['post_text'];

    // Prepare the query to insert the post into the database
    $query = "INSERT INTO `news` (`author`,`stream`, `postdes`) VALUES ('$author', '$stream', '$postdes')";

    // Execute the query
    $result = mysqli_query($con, $query);

    // Check if the query was successful
    if ($result) {
        echo "Post successfully added to the newsfeed.";
    } else {
        echo "Error: Unable to add the post.";
    }
}


//Display the newsfeed entries

// Retrieve the newsfeed entries from the database
$query = "SELECT * FROM newsfeed ORDER BY entry_id DESC";
$result = mysqli_query($con, $query);
// Check if there are any newsfeed entries
if (mysqli_num_rows($result) > 0) {
    // Display the newsfeed entries
    while ($row = mysqli_fetch_assoc($result)) {
        echo "User ID: " . $row['author'] . "<br>";
        echo "Stream: " . $row['stream'] . "<br>";
        echo "Content: " . $row['postdes'] . "<br><br>";
    }
} else {
    echo "No newsfeed entries found.";
}

// Close the database connection
mysqli_close($con);
