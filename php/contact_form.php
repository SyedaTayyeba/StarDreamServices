<?php
header("Content-Type: application/json");

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mywebsite_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["status"=>"error","message"=>"Database connection failed"]);
    exit;
}

// Determine submitted fields
// Check both index.html (capitalized) and contact_form.html (lowercase)
$name    = $_POST['name'] ?? $_POST['Name'] ?? '';
$email   = $_POST['email'] ?? $_POST['Email'] ?? '';
$phone   = $_POST['phone'] ?? $_POST['Phone'] ?? '';
$message = $_POST['message'] ?? $_POST['Message'] ?? '';
$source  = $_POST['source'] ?? 'index'; // mark which page submitted

// Optional: only require **email and phone**, others can be empty
if(empty($email) || empty($phone)){
    echo json_encode(["status"=>"error","message"=>"Email and Phone are required"]);
    exit;
}

// Optional: assign default empty values if not filled
if(empty($name)) $name = '';
if(empty($message)) $message = '';

// Validate email
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo json_encode(["status"=>"error","message"=>"Invalid email"]);
    exit;
}

// Validate phone (digits only)
if(!preg_match('/^[0-9]{10,15}$/',$phone)){
    echo json_encode(["status"=>"error","message"=>"Invalid phone number"]);
    exit;
}

// Insert into table
$stmt = $conn->prepare("INSERT INTO contact_form (name,email,phone,message,source) VALUES (?,?,?,?,?)");
$stmt->bind_param("sssss",$name,$email,$phone,$message,$source);

if($stmt->execute()){
    echo json_encode(["status"=>"success","message"=>"Message saved successfully"]);
}else{
    echo json_encode(["status"=>"error","message"=>"Failed to insert"]);
}

$stmt->close();
$conn->close();
exit;
