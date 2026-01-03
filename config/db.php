<?php
// ---------------------------------------------
// STEP 1: Replace the following details with your InfinityFree database credentials
// You can find these in your InfinityFree Control Panel → MySQL Databases
// ---------------------------------------------

$servername = "sql202.infinityfree.com"; // <- Yahan "Host" ka naam likho, dashboard me milega
$username   = "if0_40804697";           // <- Yahan "MySQL Username" likho
$password   = "SyedaTayyeba29";              // <- Yahan "MySQL Password" likho
$database   = "mywebsite_db"; // <- Yahan "Database Name" likho

// ---------------------------------------------
// STEP 2: Create connection
// ---------------------------------------------
$conn = mysqli_connect($servername, $username, $password, $database);

// ---------------------------------------------
// STEP 3: Check connection
// Agar connection fail ho to exact error show ho jayega
// ---------------------------------------------
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// ---------------------------------------------
// STEP 4: Now you can use $conn for your queries
// Example: SELECT, INSERT, UPDATE, DELETE etc.
// ---------------------------------------------
