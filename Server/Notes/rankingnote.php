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
