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
  if($_SESSION['user_type']=='admin'){
    include './inc/head_ass.php';
    include './inc/header.php';
    include './inc/sidebar.php';
  }  
  if(isset($_POST['submit'])){
      $bus_id = $_POST['bus_id'];
      $where='id = '.$_SESSION['user_id'].'';
      $update=$user->update($table= 'users',array('bus_id'=>$bus_id),array($where));     
       
        echo '<script>alert("Bus Chanaged sign in again");window.location.href="signout.php"</script>';
       
       
    }
?>

<?php 
  if($_SESSION['user_type']=='student'){
    ?>
<div class="content-wrapper">
    <div class="container">
      
      <section class="content">
           <div class="col-md-4 col-md-offset-4">
    <div class="register-box-body">
    <p class="login-box-msg">Chang bus</p>

    <form action="" method="post">
       
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
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Change</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
 
</div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <?php } ?>

  <?php 
  if($_SESSION['user_type']=='admin'){
    ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Page Header
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">


    </section>
  </div>
  <?php } ?>
  <?php 
  if($_SESSION['user_type']=='student'){
    include './top_inc/top_footer.php';
  }
  if($_SESSION['user_type']=='admin'){
    include './inc/footer.php';
  }
    
    
?>