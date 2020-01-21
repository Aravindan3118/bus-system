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
                    <input type="hidden" name="bus_from" value="<?php echo $details[0]['bus_from']; ?>">
                    <input type="hidden" name="bus_to" value="<?php echo $details[0]['bus_to']; ?>">
       <div class="form-group">
        <label>Route</label>
           <input type="date" class="form-control" name="date" id="edit_date">
        </div> 

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
    function send_email (table,change_date) {
      console.log('send_email',table);
      email_data = [];
      table.forEach( function(element) {
        email_data.push(element.user_email)
      });
      console.log('mail data',email_data);
      console.log('date',change_date)
      $.ajax({
    url: "ajax_mailer.php",
    method: "POST",
    data: {collegeemail: JSON.stringify(email_data), changed_date: change_date},
    success: function(data) {
      console.log('data',data);
      data = JSON.parse(data);      
       
    },
    error: function(data) {
      console.log(data);
    }
  });
    }
    $(document).ready(function(){
      $('#update_permenent').attr('disabled', true)

        $('#txt-area').bind('input propertychange', function() {
          $('#update_permenent').attr('disabled', false)
      })
    });
  </script>

  <?php 
    if(isset($_POST['submit'])){
      $route_id = $_POST['route_id'];
       
      $route = $_POST['route'];
      $route = trim($route);
      $date = $_POST['date'];
      $bus_from = $_POST['bus_from'];
      $bus_to = $_POST['bus_to'];
      $table1= 'temp_route';

      $row='bus_id,date,bus_from,bus_to,temp_route_map';
       $table='users';
      $row = '*';
      $where = 'bus_id = '.$_GET['bus_id'];
      $details = $user->select($table,$row,$where); 
      echo "<script>send_email(".json_encode($details).",'".$date."');</script>";
      $insert = $user->insert($table1,array($_GET['bus_id'],$date,$bus_from,$bus_to,$route),$row);
      
      if($insert){
        echo '<script>alert("Route Updated")</script>';
      }
      else{
        echo '<script>alert("something went wrong")</script>';
      }

    }
   ?>