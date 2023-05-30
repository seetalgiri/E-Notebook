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
        // Get the comment ID
        $commentId = mysqli_insert_id($con);

        // Update the 'comment' column in the 'news' table
        $sqlSelect = "SELECT comment FROM news WHERE id = $postId";
        $result = mysqli_query($con, $sqlSelect);
        $row = mysqli_fetch_assoc($result);
        $existingComment = $row['comment'];

        if ($existingComment == "") {
            // If the 'comment' column is empty, directly add the comment ID
            $updatedComment = $commentId;
        } else {
            // If the 'comment' column has existing IDs, concatenate the new ID without a leading comma
            $updatedComment = $existingComment . ", " . $commentId;
        }

        $sqlUpdate = "UPDATE news SET comment = '$updatedComment' WHERE id = $postId";
        mysqli_query($con, $sqlUpdate);

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
