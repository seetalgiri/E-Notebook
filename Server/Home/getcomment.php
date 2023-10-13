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

// Check if the request is a GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if the postId parameter is provided in the URL
    if (isset($_GET['postId'])) {
        // Sanitize the postId parameter to prevent SQL injection
        $postId = mysqli_real_escape_string($con, $_GET['postId']);

        // Select comments based on the provided postId
        $sql = "SELECT comments.*, auth.name AS author
        FROM comments
        JOIN auth ON comments.userid = auth.id WHERE postId = '$postId'";
        $result = mysqli_query($con, $sql);

        $comments = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $comments[] = $row;
        }

        // Close the database connection
        mysqli_close($con);

        // Return the comments as JSON response
        header('Content-Type: application/json');
        echo json_encode($comments);
    } else {
        // postId parameter is missing
        $response = array('status' => 'error', 'message' => 'postId parameter is missing');

        // Close the database connection
        mysqli_close($con);

        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    // Handle invalid request method
    $response = array('status' => 'error', 'message' => 'Invalid request method');

    // Close the database connection
    mysqli_close($con);

    header('Content-Type: application/json');
    echo json_encode($response);
}