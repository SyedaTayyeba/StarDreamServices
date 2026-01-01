<?php
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mywebsite_db"; // same DB as your contact_form

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["status"=>"error","message"=>"Database connection failed"]);
    exit;
}

// Fetch projects
$result = $conn->query("SELECT id, title, image FROM projects ORDER BY id ASC");

$projects = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }
}

echo json_encode(["status"=>"success","projects"=>$projects]);

$conn->close();
exit;
