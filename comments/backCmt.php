<?
// Retrieve the comment data from the AJAX request
$name = $_POST['name'];
$comment = $_POST['comment'];

// Process the comment data (e.g., insert it into the database)
// ...

// Return a response with a status code and any necessary data
http_response_code(200);
echo json_encode(['message' => 'Comment submitted successfully']);
