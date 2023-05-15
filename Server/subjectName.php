<?php
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e_notebook";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT id, name, facname, facultyid, date, sem, year FROM subname";
$result = $conn->query($sql);

// Prepare an array to store the results
$data = array();

// Iterate through the results and add them to the array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Convert the array to JSON
$jsonData = json_encode($data);

// Send the JSON response
header('Content-Type: application/json');
echo $jsonData;

// Close the database connection
$conn->close();
?>