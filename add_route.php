<?php 
 include_once './session.php';
    include_once './inc/services/class.user.php';
    $user = new User();
 include './inc/head_ass.php';
    include './inc/header.php';
    include './inc/sidebar.php';

    if(isset($_POST['submit'])){
      $bus_id = $_POST['bus_id'];
      $from = $_POST['from'];
      $to = $_POST['to'];
      $route = $_POST['route'];
       

      $table1= 'route_master';
      $row='bus_id,bus_from,bus_to,route_map';
      $insert = $user->insert($table1,array($bus_id,$from,$to,$route),$row);
      
      if($insert){
        echo '<script>alert("Route Added")</script>';
      }
      else{
        echo '<script>alert("something went wrong")</script>';
      }

    }
 ?>
   <div class="content-wrapper">
    <section class="content-header">
       
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    <div class="col-md-6 col-md-offset-3">
    <div class="register-box-body">
    <p class="login-box-msg">Add Route</p>
    
    <form action="" method="post">
      <input type="hidden" name="bus_id" value="<?php echo $_GET['bus_id'] ?>">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="from" placeholder="From">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
       

      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="to" placeholder="To">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div> 
       
       <div class="form-group">
        <label>Route</label>
           <textarea class="form-control" name='route' rows="3" placeholder="Enter Route seperated by comma (,)"></textarea>
        </div> 
      <div class="row">
       
        <!-- /.col -->
        <div class="col-xs-6">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">save Route</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
 
  </div>
</div>
  
    </section>
  </div>

  <?php 
  include './inc/footer.php';
   ?>