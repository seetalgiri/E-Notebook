<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// session_destroy();
include "./admin/common/common.php";
// db connection in (lms) db
$con = mysqli_connect($host, $dbUserName, $dbPassword, $database);
if (!$con) {
    die("DB connection failed");
}
$sqlGet = "SELECT * FROM `like` WHERE `id` = '1'";
$responseRes = mysqli_query($con, $sqlGet);

$totalLike = 0;
if (mysqli_num_rows($responseRes) > 0) {
    $row = mysqli_fetch_assoc($responseRes);
    $like = $row['like'];
    if ($like) {
        $likeArr = explode(",", $like);
        $totalLike = count($likeArr);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>libraby management system</title>
    <style>
        .actions {
            display: flex;
            gap: 10px;
        }

        .actionsPar {
            display: flex;
            gap: 20px;
        }

        .readonly-text {
            border: none;
            background-color: transparent;
            font-family: inherit;
            font-size: inherit;
            color: inherit;
            outline: none;
            cursor: default;
            width: 100%;
            max-width: 35px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>This is libraby management system</h2>

    <form id="myForm">
        <input type="userId" name="userid" id="userid" value="10">
        <input type="text" name="data" id="likeIdSet" liketype=readonly value=<?php echo $totalLike ?> class="readonly-text">
        <button type="submit" id="myButton">Like</button>
    </form>

    <script>
        // TODO: variable declaration
        const form = document.getElementById("myForm");
        const button = document.getElementById("myButton");

        // TODO: Make like function
        form.addEventListener("submit", function(event) {
            event.preventDefault();
            // TODO: backend logic
            const formData = new FormData(form);
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    likeIdSet.value = xhr.responseText;
                }
            };
            xhr.open("POST", "likeBackend.php", true);
            xhr.send(formData);
        });
    </script>

</body>

</html>