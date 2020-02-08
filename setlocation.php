<?php 

// To POST http://localhost:81/locationEmitter/setloc.php

// Sample Data
// {
// 	"user_id": "1",
// 	"location": "sample"
// }
include_once './session.php';
$input = json_decode(file_get_contents('php://input'),true);
// $bus_id = $input['bus_id'];
$bus_id = $_SESSION['driver_bus_id'];
$location = $input['location'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
date_default_timezone_set("Asia/Kolkata");
$today = date("Y-m-d");

$selectSql = "SELECT * FROM bus_location where bus_id = ".$bus_id." and today_date = '".$today."' ";

$result = $conn->query($selectSql);

if ($result->num_rows > 0) {
    $sql = "UPDATE bus_location SET currentLocation='$location' WHERE bus_id=$bus_id";
}else{
    $sql = "INSERT into bus_location (today_date,bus_id,currentLocation) values('".$today."', ".$bus_id.",'".$location."') ";
}

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();



?>