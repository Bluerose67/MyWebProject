<?php
$servername = "localhost"; //Points to the local server
$username = "root"; //User name for connecting the database
$password = ""; //Password for connection to the database
$dbname = "my_project"; //Name of the database
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
//mysqli_connect function is used to connect the application to the database
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>