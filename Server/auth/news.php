<?php
// Connecting to db
$con = mysqli_connect("localhost", "root", "", "e_notebook");
if (!$con) {
  die("Database connection failed");
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the post content from the form
    $content = $_POST['post_content'];

    // Validate and sanitize the input data (e.g., using trim() and htmlspecialchars())

    // Insert the post into the database
    $userId = 1; // Assuming a user ID of 1 for demonstration purposes
    $createdAt = date('Y-m-d H:i:s'); // Current timestamp

    // Establish a database connection (assuming MySQL here)
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "e_notebook";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the post into the posts table
    $sql = "INSERT INTO posts (user_id, content, created_at) VALUES ('$userId', '$content', '$createdAt')";

    if ($conn->query($sql) === TRUE) {
        echo "Post created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

// Fetch and display the newsfeed
// Establish a database connection (same code as above)

// Fetch posts from the database
$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output each post
    while ($row = $result->fetch_assoc()) {
        $postContent = $row['content'];
        $createdAt = $row['created_at'];

        // Display the post content and creation timestamp
        echo "<div>";
        echo "<p>$postContent</p>";
        echo "<small>Posted on: $createdAt</small>";
        echo "</div>";
    }
} else {
    echo "No posts found.";
}

$conn->close();

?>