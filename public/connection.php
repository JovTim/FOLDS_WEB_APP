<?php
$servername = "localhost";
$username = "root";
$password = "T1m0s@99145078";
$dbname = "folder_tracker";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
  die("Connection Failed: " . $conn->connect_error);
}

//echo "Connection Success!";
?>