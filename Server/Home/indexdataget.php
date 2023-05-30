<?php
// importing session datas
include '../../admin/UserSessionData.php';

// Importing configurations 
include '../../Configuration.php';

// Database connection
$conn = mysqli_connect($commonHost, $commonUser, $commonPassword, $commonDbname);

if (!$conn) {
    die("Could not connect to the database");
}


// =====================================to get data from the database=========================
// Create a response array
$response = array();

// Fetch data from the database
$query = "SELECT * FROM news";
$result = mysqli_query($conn, $query);

if ($result) {
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    $response['data'] = $data;
} else {
    $response['error'] = "Error fetching data from the database";
}

// Close the database connection
mysqli_close($conn);

// Convert the response array to JSON
$jsonResponse = json_encode($response);

// Set the content type header to application/json
header('Content-Type: application/json');

// Send the JSON response
echo $jsonResponse;
