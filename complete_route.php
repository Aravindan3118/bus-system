<?php 

include_once './session.php';
 include_once './inc/services/class.user.php';
 $user = new User();
 	if ($_GET['route_name']) {
 		$table='today_ride';
	$row = '*';
	date_default_timezone_set("Asia/Kolkata");
	$today = date("Y-m-d");
	$where = 'bus_id = '.$_SESSION['driver_bus_id']. ' and today_date = "'.$today.'"';
	$check_details = $user->select($table,$row,$where);  
	$comp_route = $check_details[0]['completed_route'];
	

	 $route_name = $_GET['route_name'];
	 $route_name = $comp_route . "," . $route_name;
	 echo 'route_name'.$route_name;
	 $where='bus_id = '.$_SESSION['driver_bus_id'].'';

	 $update=$user->update($table= 'today_ride',array('completed_route'=>$route_name),array($where));    
 	}
 	if ($_GET['start_ride']) {
 	  $table1= 'today_ride';
      $row='bus_id,today_date,completed_route';
      date_default_timezone_set("Asia/Kolkata");
	  $today = date("Y-m-d");
	  $comp = '';
      $insert = $user->insert($table1,array($_SESSION['driver_bus_id'],"$today",$comp),$row);
 	}
 	

	 header('location: index.php');
 ?>