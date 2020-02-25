<?php 
    include_once './session.php';
    include_once './inc/services/class.user.php';
    $user = new User();
 include './inc/head_ass.php';
    include './inc/header.php';
    include './inc/sidebar.php';
 ?>
   <div class="content-wrapper">
    <section class="content-header">
      
    </section>

    <section class="content container-fluid">
      <a href="add_driver.php"><button class="btn btn-primary">Add Driver</button></a>

    <div class="box">
            <div class="box-header text-center">
              <h3 class="box-title">Driver list</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Driver Name</th>
                  <th>Driver Contact</th>
                  <th>Driver Email</th>
                  <th>Bus</th>
                  <!-- <th>Action</th> -->
                </tr>
                </thead>
                <tbody>
                <?php 
                    
                    $table='driver_master';                        
                    $details = $user->select($table); 
                    if($details){
          foreach($details as $d)
          {
        ?>
                <tr>
                  <td><?php echo $d['driver_name'];?></td>
                  <td><?php echo $d['driver_phone'];?>
                  </td>
                  <td><?php echo $d['driver_email'];?></td>
                  <td><?php echo $d['bus_id'];?></td>
                  <!-- <td><a href="manage_route.php?bus_id=<?php echo $d['id']; ?>" class="btn btn-primary">Edit</a></td> -->
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
                   <th>Driver Name</th>
                   <th>Driver Contact</th>
                  <th>Driver Email</th>
                  <th>Bus</th>
                  <!-- <th>Action</th> -->
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </section>
  </div>

  <?php 
  include './inc/footer.php';
   ?>