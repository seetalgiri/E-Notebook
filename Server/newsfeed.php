<?php

session_start();

include '../Configuration.php';
include 'auths.php';

// Database connection
$con = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);

if (!$con) {
    die("Could not connect to the database");
}

if (isset($_POST['post'])) {
    echo "clicked";
}

// if (isset($_POST['post'])) {

//     echo "clicked";
//     // Retrieve the posted text from a form or any other source
//     $name = $_POST['username'];
//     $faculty = $_POST['stream'];
//     $postText = $_POST['post_text'];

//     // Prepare the query to insert the post into the database
//     $query = "INSERT INTO `newsfeed` (`user_name`,`faculty_name`, `post_description`) VALUES ('$name', '$faculty', '$postText')";

//     // Execute the query
//     $result = mysqli_query($con, $query);

//     // Check if the query was successful
//     if ($result) {
//         echo "Post successfully added to the newsfeed.";
//     } else {
//         echo "Error: Unable to add the post.";
//     }
// }


//Display the newsfeed entries

// Retrieve the newsfeed entries from the database
$query = "SELECT * FROM newsfeed ORDER BY entry_id DESC";
$result = mysqli_query($con, $query);

// Display the newsfeed entries
while ($row = mysqli_fetch_assoc($result)) {
    echo "User ID: " . $row['user_id'] . "<br>";
    echo "User Name: " . $row['user_name'] . "<br>";
    echo "Content: " . $row['content'] . "<br><br>";
}

// Close the database connection
mysqli_close($con);
