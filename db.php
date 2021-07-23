<?php
$servername = "localhost";
$username = "root";
$password = "*****";
$dbName = "LDUexercise";

// Connect to MySQL
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If database is not exist create one
if (!mysqli_select_db($conn, $dbName)){
    $sql = "CREATE DATABASE " . $dbName;
    if ($conn->query($sql) !== TRUE) {
        echo "Error creating database: " . $conn->error;
    }
} 

mysqli_select_db($conn, $dbName);

$sql = "CREATE TABLE IF NOT EXISTS users (USERNAME VARCHAR(100) NOT NULL,"
    . " PASSWORD_HASH CHAR(60) NOT NULL,"
    . " PHONE VARCHAR(10) NOT NULL, UNIQUE (USERNAME))";

if ($conn->query($sql) !== TRUE) {
    echo "Error creating table: " . $conn->error;
  }

?>