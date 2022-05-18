<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "h1";

// Create connection
$conn = new mysqli($serverName, $userName, $password, $dbName);

//check connection
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

?>