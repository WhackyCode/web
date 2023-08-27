<?php
// Replace these values with your actual database credentials
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
if (!isset($_SESSION["user_id"])) {
    echo "You need to be logged in to generate a key.";
    exit();
}

$user_id = $_SESSION["user_id"];
$key = uniqid(); // Replace with a secure key generation method
$expiration = date("Y-m-d H:i:s", strtotime("+24 hours"));

$sql = "INSERT INTO keys_table (user_id, key_value, expiration) VALUES ('$user_id', '$key', '$expiration')";

if ($conn->query($sql) === TRUE) {
    echo $key;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
