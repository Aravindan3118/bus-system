<?php 
    include_once './session.php';
    include_once './inc/services/class.user.php';
    $user = new User();
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
   <div class="content-wrapper">
    <section class="content-header">
      
    </section>
    <?php if ($_SESSION['user_type'] == 'admin'): ?>
      <a href="edit_permenent.php?bus_id=<?php echo $_GET['bus_id']; ?>"><button class="btn btn-primary">Edit Permenent</button></a>

      <a href="edit_temp.php?bus_id=<?php echo $_GET['bus_id']; ?>"><button class="btn btn-primary">Edit For Date</button></a>      
    <?php endif ?>
    <section class="content container-fluid">
    <?php 
      $table='route_master';
      $row='*';                     
      $where = 'bus_id = '.$_GET['bus_id'].'';
      $details = $user->select($table,$row,$where);
      if ($details) {
        // echo $details[0]['route_map'];
        $sn_count = 1;
        $route_array = explode(",",$details[0]['route_map']);
        foreach ($route_array as $ra) {
          echo '<li><span class="serial-number">'.$sn_count.'</span> '.$ra .'</li>';
          $sn_count++;
        }
      }
     ?>
    </section>
  </div>

  <?php 
   if($_SESSION['user_type']=='student'){
    include './top_inc/top_footer.php';
  }
  if($_SESSION['user_type']=='admin'){
    include './inc/footer.php';
  }
   ?>