<?php 
 include_once './session.php';
    include_once './inc/services/class.user.php';
    $user = new User();
 include './inc/head_ass.php';
    include './inc/header.php';
    include './inc/sidebar.php';

    if(isset($_POST['submit'])){
      $driver_name = $_POST['driver_name'];
      $email = $_POST['driver_email'];
      $password = $_POST['password'];
      $mobile = $_POST['mobile'];
      $bus_id = $_POST['bus_id'];
      
       

      $table1= 'driver_master';
      $row='driver_name,driver_email,driver_password,driver_phone,bus_id';
      $insert = $user->insert($table1,array($driver_name,$email,$password,$mobile,$bus_id),$row);
      
      if($insert){
        echo '<script>alert("Driver Added")</script>';
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
    <p class="login-box-msg">Add Driver</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="driver_name" placeholder="Driver Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
       

      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="driver_email" placeholder="email">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div> 

      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="password">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="mobile" placeholder="mobile number">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group">
                  <label>Bus num</label>
                  <select name="bus_id" class="form-control">
                    <?php 

                    $table='bus_master';                        
                    $details = $user->select($table); 
                    if($details){
          foreach($details as $d)
          {
        ?>
            <option value="<?php echo $d['id']; ?>"><?php echo $d['bus_num']; ?></option>
              <?php 
            }
          }
                     ?>
                  </select>
                </div>
       
      <div class="row">
       
        <!-- /.col -->
        <div class="col-xs-6">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">save</button>
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