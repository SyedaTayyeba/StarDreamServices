<?php
header('Content-Type: application/json'); // Return JSON
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "../config/db.php"; // include DB connection

if(isset($_POST['email'])) {
    $email = trim($_POST['email']);

    // Validate email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Invalid email address"]);
        exit;
    }

    // Prepare SQL to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO subscribers (email) VALUES (?)");
    $stmt->bind_param("s", $email);

    if($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "You have been subscribed!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Email already exists or database error"]);
    }

    $stmt->close();
}
$conn->close();
?>
