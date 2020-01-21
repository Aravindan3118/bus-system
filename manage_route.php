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

    <section class="content container-fluid">
      

    <div class="box">
            <div class="box-header text-center">
              <h3 class="box-title">Route Detail</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Route unique Id</th>
                  <th>Bus From</th>
                  <th>Bus To</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    
                    $table='route_master';
                    $row='*';                     
                    $where = 'bus_id = '.$_GET['bus_id'].'';
                    $details = $user->select($table,$row,$where); 
                    if($details){
          foreach($details as $d)
          {
        ?>
                <tr>
                  <td><?php echo $d['id'];?></td>
                  <td><?php echo $d['bus_from'];?>
                  </td>
                  <td><?php echo $d['bus_to'];?></td>
                  <td><a href="full_route.php?bus_id=<?php echo $d['id']; ?>" class="btn btn-primary">View full Route</a></td>
                </tr>
                    <?php }} else{
                        ?>
                <tr >
                  <td colspan='4' class='text-center'><a href="add_route.php?bus_id=<?php echo $_GET['bus_id'] ?>"><button class="btn btn-primary">Add Route</button></a></td>
                   
                </tr>
                    <?php
                    }?>
                
                </tbody>
                <tfoot>
                <tr>
                   <th>Bus unique Id</th>
                  <th>Bus Number</th>
                  <th>register Number</th> 
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
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