<?php
session_start();
// session_destroy();
// include "./admin/common/common.php";
include "../Configuration.php";
// db connection in (lms) db
$con = mysqli_connect($host, $dbUserName, $dbPassword, $database);
if (!$con) {
    die("DB connection failed");
}

if (isset($_POST['like'])) {
    // data from frontend
    $data = $_POST['data'];
    $userid = $_POST['userid'];

    // data from backend
    $sqlGet = "SELECT * FROM `like` WHERE `id` = '1'";
    $responseRes = mysqli_query($con, $sqlGet);
    if (mysqli_num_rows($res_news) > 0) {
        $row = mysqli_fetch_array($responseRes);
        $likecontent = $row['like'];

        // converting data into array format
        $likeArr = explode(",", $likecontent);

        // checking user is exist or not
        if (in_array("$userid", $likeArr)) {
            // when user already exist remove user from array (check in which index this user is);
            $elmind = array_search($userid, $likeArr);
            array_splice($likeArr, $elmind, 1);
            // echo "updated unliked <br />";
        } else {
            array_push($likeArr, $userid);
            // echo "updated liked <br />";
        }
        $likeArr = array_diff($likeArr, array("", " "));
        $data = $likeArr;
        $data = implode(",", $likeArr);
        // inserting to db
        $sql = "UPDATE `like` SET `like`='$data' WHERE `id`='1'";

        if (mysqli_query($con, $sql)) {
            echo count($likeArr);
            // echo "updated";
        } else {
            echo "cannot update";
        }
    }
}
