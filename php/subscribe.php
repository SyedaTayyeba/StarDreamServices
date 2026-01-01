<?php
header("Content-Type: application/json");
require_once "../config/db.php";

// Check if email is received
if (!isset($_POST['email']) || empty(trim($_POST['email']))) {
    echo json_encode([
        "status" => "error",
        "message" => "Email is required"
    ]);
    exit;
}

$email = trim($_POST['email']);

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid email format"
    ]);
    exit;
}

// Check if email already exists
$check = $conn->prepare("SELECT id FROM subscribers WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Email already subscribed"
    ]);
    exit;
}

// Insert new email
$stmt = $conn->prepare("INSERT INTO subscribers (email) VALUES (?)");
$stmt->bind_param("s", $email);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Subscribed successfully!"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Database error. Please try again."
    ]);
}
exit;
?>
