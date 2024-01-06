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
    echo "clicked";
    // Retrieve the posted text from a form or any other source
    $author = $_POST['username'];
    $stream = $_POST['stream'];
    $postdes = $_POST['post_text'];
    $image = $_POST['image'];
    $post_like = $_POST['jscb'];

    // Prepare the query to insert the post into the database
    $query = "INSERT INTO `news` (`author`,`stream`, `postdes`, `image`) VALUES ('$author', '$stream', '$postdes', '$image')";

    // Execute the query
    $result = mysqli_query($con, $query);

    // Check if the query was successful
    if ($result) {
        echo "Post successfully added to the newsfeed.";
    } else {
        echo "Error: Unable to add the post.";
    }
}



// Close the database connection
mysqli_close($con);
