<?php 

// To POST http://localhost:81/locationEmitter/getloc.php

// Sample Data
// {
// 	"user_id": "1"
// }
include_once './session.php';
$input = json_decode(file_get_contents('php://input'),true);
// $user_id = $input['user_id'];
$bus_id = $_SESSION['stu_bus_id'];
// $bus_id = 2;
// $location = $input['location'];
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

$sql = "SELECT * FROM bus_location where bus_id = $bus_id and today_date = '".$today."' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // echo "id: " . $row. "<br>";
        // print_r($row);
        header('Content-Type: application/json');
        echo json_encode($row);
        // json_encode($result->fetch_assoc());
    }
} else {
    // echo "0 results";
    echo json_encode(false);
}

$conn->close();



?>