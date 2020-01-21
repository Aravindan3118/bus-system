<?php 
    include_once './session.php';
    include_once './inc/services/class.user.php';
    $user = new User();
?>
<?php 
  if($_SESSION['user_type']=='student'){
    include './top_inc/top_head_ass.php';
    include './top_inc/top_header.php';
  }
  if($_SESSION['user_type']=='admin'){
    include './inc/head_ass.php';
    include './inc/header.php';
    include './inc/sidebar.php';
  }  
 
?>

<?php 
  if($_SESSION['user_type']=='student'){
    ?>
<div class="content-wrapper">
    <div class="container">
      
      <section class="content">
       <?php 
          $table='today_ride';
          $row = '*';
          date_default_timezone_set("Asia/Kolkata");
          $today = date("Y-m-d");
          $where = 'bus_id = '.$_SESSION['stu_bus_id']. ' and today_date = "'.$today.'"';
          $check_details = $user->select($table,$row,$where);  

          if ($check_details) {
            // echo "ride started";
          $sn_count = 1;
          $exist_route_array = explode(",",$check_details[0]['completed_route']);
          // foreach ($route_array as $ra) {
          // echo '<li><span class="serial-number">'.$sn_count.'</span> '.$ra .'</li>';
          // $sn_count++;
        // }
          $table='temp_route';
          $row = '*';
          date_default_timezone_set("Asia/Kolkata");
          $today = date("Y-m-d");
          $where = 'bus_id = '.$_SESSION['stu_bus_id']. ' and date = "'.$today.'"';
          // date pass in string
          $details = $user->select($table,$row,$where);   
          if ($details) {
          $sn_count = 1;
          $route_array = explode(",",$details[0]['temp_route_map']);

          $result=array_intersect($exist_route_array,$route_array);
          echo "<h1>completed route</h1>";
          foreach ($result as $ra) {
          echo '<li><span class="serial-number">'.$sn_count.') </span> '.$ra .'</li>';
          $sn_count++;
          }

          $result1=array_diff($route_array,$exist_route_array);
          echo "<h1>Still to complete</h1>";
          foreach ($result1 as $ra) {
          echo '<li><span class="serial-number">'.$sn_count.') </span> '.$ra .'</li>';
          $sn_count++;
          }

          } // if end
          else{
          $table='route_master';
          $row = '*';
          $where = 'bus_id = '.$_SESSION['stu_bus_id'];
          $details1 = $user->select($table,$row,$where);
          if ($details1) {
               $sn_count = 1;
        $route_array = explode(",",$details1[0]['route_map']);
        $result=array_intersect($exist_route_array,$route_array);
          echo "<h1>completed route</h1>";
          foreach ($result as $ra) {
          echo '<li><span class="serial-number">'.$sn_count.') </span> '.$ra .'</li>';
          $sn_count++;
          }

          $result1=array_diff($route_array,$exist_route_array);
          echo "<h1>Still to complete</h1>";
          foreach ($result1 as $ra) {
          echo '<li><span class="serial-number">'.$sn_count.') </span> '.$ra .'</li>';
          $sn_count++;
          }
          }
          } // else end
          } // check details if
          else{
            ?>
            <!-- <a href="complete_route.php?start_ride=1"><button class="btn btn-info">Start Ride</button></a> -->
            <h1 class="text-center">Your ride for the day not started yet</h1>

            <?php
          }

          
         ?>
 
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <?php } ?>

  <?php 
  if($_SESSION['user_type']=='admin'){
    ?>
  <div class="content-wrapper">
    <section class="content-header">
      
    </section>

    <!-- Main content -->
    <section class="content container-fluid">


    </section>
  </div>
  <?php } ?>
  <?php 
  if($_SESSION['user_type']=='student'){
    include './top_inc/top_footer.php';
  }
  if($_SESSION['user_type']=='admin'){
    include './inc/footer.php';
  }
    
    
?>