<?php 
 include_once './session.php';
    include_once './inc/services/class.user.php';
    $user = new User();
 include './inc/head_ass.php';
    include './inc/header.php';
    include './inc/sidebar.php';

    if(isset($_POST['submit'])){
      $route_id = $_POST['route_id'];
       
      $route = $_POST['route'];
      $route = trim($route);

      $table1= 'route_master';
      
      $where='id = '.$route_id.'';
      $update=$user->update($table1,array('route_map'=>$route),array($where));     
      
        echo '<script>alert("Route Updated")</script>';

    }
 ?>
   <div class="content-wrapper">
    <section class="content-header">
       
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    <div class="col-md-6 col-md-offset-3">
    <div class="register-box-body">
    <p class="login-box-msg">Edit Route</p>
    
    <form action="" method="post">
      <input type="hidden" name="bus_id" value="<?php echo $_GET['bus_id'] ?>">
       <?php  $table='route_master';
                    $row = '*';
                    $where = 'bus_id = '.$_GET['bus_id'];
                    $details = $user->select($table,$row,$where); 
                    ?>
                    <input type="hidden" name="route_id" value="<?php echo $details[0]['id']; ?>">
       <div class="form-group">
        <label>Route</label>
           <textarea class="form-control" id="txt-area" name='route' rows="3" placeholder="Enter Route seperated by comma (,)"><?php if($details){echo trim($details[0]['route_map']);} ?></textarea>
        </div> 
      <div class="row">
       
        <!-- /.col -->
        <div class="col-xs-6">
          <button type="submit" id="update_permenent" name="submit" class="btn btn-primary btn-block btn-flat">Update Route</button>
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
   <script>
    $(document).ready(function(){
      $('#update_permenent').attr('disabled', true)

        $('#txt-area').bind('input propertychange', function() {
          $('#update_permenent').attr('disabled', false)
      })
    });
  </script>