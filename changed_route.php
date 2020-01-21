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
?>

<?php 
  if($_SESSION['user_type']=='student'){
    ?>
<div class="content-wrapper">
    <div class="container">
      
      <section class="content">
         <div class="box">
            <div class="box-header text-center">
              <h3 class="box-title">Changed Route For Your Bus</h3>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Date</th>
                  <th>Route</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    
                    $table='temp_route';
                    $row = '*';
                    $where = 'bus_id = '.$_SESSION['stu_bus_id'];
                    $details = $user->select($table,$row,$where); 
                    if($details){
                    foreach($details as $d)
                    {
                  ?>
                <tr>
                   
                  <td><?php echo $d['date'];?></td>
                  <td><?php echo $d['temp_route_map'];?></td>
                 
                  
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
                   <th>Date</th>
                  <th>Route</th>
                </tr>
                </tfoot>
              </table>
            </div>
          </div>        
      </section>
    </div>
  </div>
  <?php } ?>

  <?php 
  if($_SESSION['user_type']=='student'){
    include './top_inc/top_footer.php';
  }
      
    
?>