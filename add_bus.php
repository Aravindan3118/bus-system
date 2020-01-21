<?php 
 include_once './session.php';
    include_once './inc/services/class.user.php';
    $user = new User();
 include './inc/head_ass.php';
    include './inc/header.php';
    include './inc/sidebar.php';

    if(isset($_POST['submit'])){
      $bus_num = $_POST['bus_num'];
      $reg_no = $_POST['reg_num'];
       

      $table1= 'bus_master';
      $row='bus_num,register_number';
      $insert = $user->insert($table1,array($bus_num,$reg_no),$row);
      
      if($insert){
        echo '<script>alert("Bus Added")</script>';
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
    <p class="login-box-msg">Add Bus</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="bus_num" placeholder="Bus Number">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
       

      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="reg_num" placeholder="register Number">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
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