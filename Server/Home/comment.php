<?php
// importing session datas
include '../../admin/UserSessionData.php';

// Importing configurations 
include '../../Configuration.php';

// Database connection
$con = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);

if (!$con) {
    die("Could not connect to the database");
}


// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentData = json_decode(file_get_contents('php://input'), true);

    // Extract the comment details from the array
    $postId = $commentData['postId'];
    $userId = $commentData['userId'];
    $comment = $commentData['comment'];
    $userName = $commentData['userName'];

    // Insert the comment into the 'comments' table
    $sql = "INSERT INTO comments (cmt_des, author, postId, date, userid) VALUES ('$comment', '$userName', '$postId', NOW(), '$userId')";

    if (mysqli_query($con, $sql)) {
        // Comment insertion successful
        $response = array('status' => 'success', 'message' => 'Comment added successfully');
    } else {
        // Comment insertion failed
        $response = array('status' => 'error', 'message' => 'Failed to add comment');
    }

    // Close the database connection
    mysqli_close($con);
} else {
    // Handle invalid request method
    $response = array('status' => 'error', 'message' => 'Invalid request method');
}

echo json_encode($response);
