<?php
// importing session datas
include '../admin/UserSessionData.php';

// Importing configurations 
include '../Configuration.php';

// Database connection
$conn = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);

if (!$conn) {
    die("Could not connect to the database");
}

// =========================to update like ==============================
// Retrieve the data sent from the frontend
$data = json_decode(file_get_contents('php://input'), true);
$postId = $data['postId'];
$userId = $data['userId'];

// Check if the userId is valid
if ($userId > 0) {
    // Retrieve the existing like content from the database
    $sqlGet = "SELECT `post_like` FROM `news` WHERE `id` = $postId";
    $responseRes = mysqli_query($conn, $sqlGet);

    if (mysqli_num_rows($responseRes) > 0) {
        $row = mysqli_fetch_array($responseRes);
        $likeContent = $row['post_like'];

        // Convert the like content into an array
        $likeArr = explode(",", $likeContent);

        // Check if the user already exists in the array
        if (in_array($userId, $likeArr)) {
            // User already exists, remove the user from the array
            $elmind = array_search($userId, $likeArr);
            array_splice($likeArr, $elmind, 1);
        } else {
            // User doesn't exist, add the user to the array
            array_push($likeArr, $userId);
        }

        // Remove any empty or whitespace elements from the array
        $likeArr = array_diff($likeArr, array("", " "));

        // Convert the array back to a string
        $likeContentUpdated = implode(",", $likeArr);

        // Update the like content in the database
        $sqlUpdate = "UPDATE `news` SET `post_like`='$likeContentUpdated' WHERE `id`=$postId";

        if (mysqli_query($conn, $sqlUpdate)) {
            $response = [
                'success' => true,
                'message' => 'Liked successfully',
                'likeCount' => count($likeArr),
                'postId' => $postId,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Cannot update',
            ];
        }
    }
} else {
    $response = [
        'success' => false,
        'message' => 'Invalid user',
    ];
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
mysqli_close($conn);
