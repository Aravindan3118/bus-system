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

      $table1= 'users';
      $row='firstname,email,password,mobile';
      $insert = $user->insert($table1,array($firstname,$email,$password,$mobile_num),$row);
      
      if($insert){
        echo '<script>alert("Student Registered")</script>';
      }
      else{
        echo '<script>alert("something went wrong")</script>';
      }
      // echo '<br>'.$student_name;
      // echo '<br>'.$email;
      // echo '<br>'.$password;
      // echo '<br>'.$mobile_num;
      // echo '<br>'.$dob;
      // echo '<br>'.$sslcavg;
      // echo '<br>'.$hslccavg;

    }
 ?>
   <div class="container">
  
    <section class="content ">
    <div class="register-box-body col-md-4 col-md-offset-4">
    <p class="login-box-msg">Register</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name='student_name' placeholder="Student Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name='email' placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name='password' placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name='mobile_num' placeholder="Mobile Number">
        <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
      </div>
      <div class="row">
      
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name='submit' class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
    </div>

    <a href="login.php" class="text-center">I already have a account</a>
  </div>

    </section>
  </div>

  <?php 
//   include './inc/footer.php';
   ?>