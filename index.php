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
  if($_SESSION['user_type']=='admin' || $_SESSION['user_type']=='driver'){
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
         <div class="box">
            <div class="box-header text-center">
              <h3 class="box-title">Bus list</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Bus unique Id</th>
                  <th>Bus Number</th>
                  <th>register Number</th>
                  <th>Driver  Name</th>
                  <th>Driver Contact</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    
                    $table='bus_master b join driver_master d on b.id = d.bus_id';
                    $row = 'b.*,d.*';
                    $where = 'b.id = '.$_SESSION['stu_bus_id'];
                    $details = $user->select($table,$row,$where); 
                    if($details){
          foreach($details as $d)
          {
        ?>
                <tr>
                  <td><?php echo $d['bus_id'];?></td>
                  <td><?php echo $d['bus_num'];?>
                  </td>
                  <td><?php echo $d['register_number'];?></td>
                  <td><?php echo $d['driver_name'];?></td>
                  <td><?php echo $d['driver_phone'];?></td>
                  <?php 
                    $table='route_master';
                    $row = '*';
                    $where = 'bus_id = '.$_SESSION['stu_bus_id'];
                    $details = $user->select($table,$row,$where); 

                   ?>
                   <?php if ($details): ?>
                     <td><a href="manage_route.php?bus_id=<?php echo $d['bus_id']; ?>" class="btn btn-primary">View Route</a></td>
                   <?php else: ?>
                     <td><a class="btn btn-primary">No route added to this bus</a></td>
                   <?php endif ?>
                  
                </tr>
                    <?php }} else{
                        ?>
                <tr >
                  <td colspan='4' class='text-center'>No Data</td>
                   
                </tr>
                    <?php
                    }?>
                
                </tbody>
                <tfoot>
                <tr>
                   <th>Bus unique Id</th>
                  <th>Bus Number</th>
                  <th>register Number</th> 
                  <th>Driver  Name</th>
                  <th>Driver Contact</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>        
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <?php } ?>

  <?php 
  if($_SESSION['user_type']=='admin' || $_SESSION['user_type']=='driver'){
    ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Page Header
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <?php if ($_SESSION['user_type']=='driver'): ?>
        <?php 
          $table='today_ride';
          $row = '*';
          date_default_timezone_set("Asia/Kolkata");
          $today = date("Y-m-d");
          $where = 'bus_id = '.$_SESSION['driver_bus_id']. ' and today_date = "'.$today.'"';
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
          $where = 'bus_id = '.$_SESSION['driver_bus_id']. ' and date = "'.$today.'"';
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
          echo '<li><span class="serial-number">'.$sn_count.') </span> '.$ra .'<a href="complete_route.php?route_name='.$ra.'" style="padding-left:25px;"><button class="btn btn-success">Reached</button></a></li>';
          $sn_count++;
          }

          } // if end
          else{
          $table='route_master';
          $row = '*';
          $where = 'bus_id = '.$_SESSION['driver_bus_id'];
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
          echo '<li><span class="serial-number">'.$sn_count.') </span> '.$ra .'<a href="complete_route.php?route_name='.$ra.'" style="padding-left:25px;"><button class="btn btn-success">Reached</button></a></li>';
          $sn_count++;
          }
          }
          } // else end
          } // check details if
          else{
            ?>
            <a href="complete_route.php?start_ride=1"><button class="btn btn-info">Start Ride</button></a>

            <?php
          }

          
         ?>
      <?php endif ?>
    </section>
  </div>
  <?php } ?>
  <?php 
  if($_SESSION['user_type']=='student'){
    include './top_inc/top_footer.php';
  }
  if($_SESSION['user_type']=='admin' || $_SESSION['user_type']=='driver' ){
    include './inc/footer.php';
  }
    
    
?>