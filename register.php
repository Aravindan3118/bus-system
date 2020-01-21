<?php 
	// include './admin/inc/header.php';
    // include './inc/sidebar.php';

    include './inc/services/class.user.php';
    include './inc/head_ass.php';
    $user = new User();
    if(isset($_POST['submit'])){
      $firstname = $_POST['student_name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $mobile_num = $_POST['mobile_num'];
      $bus_id = $_POST['bus_id'];

      $table1= 'users';
      $row='username,user_email,password,user_mobile,bus_id';
      $insert = $user->insert($table1,array($firstname,$email,$password,$mobile_num,$bus_id),$row);
      
      if($insert){
        echo '<script>alert("Student Registered")</script>';
      }
      else{
        echo '<script>alert("something went wrong")</script>';
      } 
    }
 ?>

    <div class="col-md-4 col-md-offset-4">
    <div class="register-box-body">
    <p class="login-box-msg">Register</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="student_name" placeholder="Full name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="mobile_num" placeholder="Mobile Number">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
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
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
       
    </div>

    <a href="login.html" class="text-center">I already have a membership</a>
  </div>
</div>
  <?php 
  // include './inc/footer.php';
   ?>