<?php
include_once './session.php';
include_once './inc/services/class.user.php';
$user = new User();
?>
<?php
if ($_SESSION['user_type'] == 'student') {
  include './top_inc/top_head_ass.php';
  include './top_inc/top_header.php';
}
if ($_SESSION['user_type'] == 'admin' || $_SESSION['user_type'] == 'driver') {
  include './inc/head_ass.php';
  include './inc/header.php';
  include './inc/sidebar.php';
}

?>

<?php
if ($_SESSION['user_type'] == 'student') {
?>
  <div class="content-wrapper">
    <div class="container">

      <section class="content">
        <div class="box">
          <div class="box-header text-center">
            <h3 class="box-title">Bus list</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Bus unique Id</th>
                  <th>Bus Number</th>
                  <th>register Number</th>
                  <th>Driver Name</th>
                  <th>Driver Contact</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $table = 'bus_master b join driver_master d on b.id = d.bus_id';
                $row = 'b.*,d.*';
                $where = 'b.id = ' . $_SESSION['stu_bus_id'];
                $details = $user->select($table, $row, $where);
                if ($details) {
                  foreach ($details as $d) {
                ?>
                    <tr>
                      <td><?php echo $d['bus_id']; ?></td>
                      <td><?php echo $d['bus_num']; ?>
                      </td>
                      <td><?php echo $d['register_number']; ?></td>
                      <td><?php echo $d['driver_name']; ?></td>
                      <td><?php echo $d['driver_phone']; ?></td>
                      <?php
                      $table = 'route_master';
                      $row = '*';
                      $where = 'bus_id = ' . $_SESSION['stu_bus_id'];
                      $details = $user->select($table, $row, $where);

                      ?>
                      <?php if ($details) : ?>
                        <td><a href="manage_route.php?bus_id=<?php echo $d['bus_id']; ?>" class="btn btn-primary">View Route</a></td>
                      <?php else : ?>
                        <td><a class="btn btn-primary">No route added to this bus</a></td>
                      <?php endif ?>

                    </tr>
                  <?php }
                } else {
                  ?>
                  <tr>
                    <td colspan='4' class='text-center'>No Data</td>

                  </tr>
                <?php
                } ?>

              </tbody>
              <tfoot>
                <tr>
                  <th>Bus unique Id</th>
                  <th>Bus Number</th>
                  <th>register Number</th>
                  <th>Driver Name</th>
                  <th>Driver Contact</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
<?php } ?>

<?php
if ($_SESSION['user_type'] == 'admin' || $_SESSION['user_type'] == 'driver') {
?>
  <div class="content-wrapper">
    <section class="content-header">

    <!-- Main content -->
    <section class="content container-fluid">
      <?php if ($_SESSION['user_type'] == 'driver') : ?>
        <!-- <button onclick="geoFindMe()">Emit Location</button> -->
        <button id="startTimer" class="btn btn-success" onclick="startTimer()">Start Ride</button>
        <button class="hide btn btn-danger" id="stopTimer" onclick="stopTimer()">StopRide</button>
        <div id="googleMap" style="width:100%;height:400px;"></div>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAGGKKZDIrGC4i7w32LbaP-cEnmCw_UWE&callback=myMap"></script>

        <script>
          var timer = null

          function startTimer() {
            document.getElementById('startTimer').classList.add("hide")
            document.getElementById('stopTimer').classList.remove("hide")
            timer = setInterval(() => {
              geoFindMe()
            }, 5000);
          }

          function stopTimer() {
            document.getElementById('startTimer').classList.remove("hide")
            document.getElementById('stopTimer').classList.add("hide")
            clearInterval(timer)
          }

          function myMap(loc = null) {

            var myLatlng = new google.maps.LatLng(51.508742, -0.120850);
            if (loc) {

              var myLatlng = new google.maps.LatLng(loc.lat, loc.long);
            }
            var imagePath = 'http://m.schuepfen.ch/icons/helveticons/black/60/Pin-location.png'
            // var imagePath = 'https://cdn3.iconfinder.com/data/icons/small-black-v11/512/bus_public_transport_transportation_travel-512.png'
            var mapOptions = {
              zoom: 16,
              center: myLatlng,
              mapTypeId: google.maps.MapTypeId.ROADMAP,

            }

            var map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
            marker = new google.maps.Marker({
              position: myLatlng,
              map: map,
              icon: imagePath
            });
          }
          var initialLoc = {}

          function geoFindMe() {
            console.log('geo loc')

            function success(position) {
              const latitude = position.coords.latitude;
              const longitude = position.coords.longitude;
              myMap({
                lat: latitude,
                long: longitude
              })
              // status.textContent = '';
              //   mapLink.href = `https://www.openstreetmap.org/#map=18/${latitude}/${longitude}`;
              // mapLink.textContent = `Latitude: ${latitude} °, Longitude: ${longitude} °`;
              console.log('lat long', `Latitude: ${latitude} °, Longitude: ${longitude} °`)
              if (initialLoc.latitude != latitude || initialLoc.longitude != longitude) {
                initialLoc.latitude = latitude
                initialLoc.longitude = longitude
                console.log('update db')
                fetch('setlocation.php', {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/json'
                    // 'Content-Type': 'application/x-www-form-urlencoded',
                  },
                  body: JSON.stringify({
                    // "bus_id": "2",
                    "location": `${latitude},${longitude}`
                  })
                })
              }
            }

            function error() {
              // status.textContent = 'Unable to retrieve your location';
              console.log('Unable to retrieve your location')
            }

            if (!navigator.geolocation) {
              // status.textContent = 'Geolocation is not supported by your browser';
              console.log('Geolocation is not supported by your browser')
            } else {
              console.log('Locationg...')
              // status.textContent = 'Locating…';
              navigator.geolocation.getCurrentPosition(success, error);
            }

          }
        </script>
      <?php endif ?>
    </section>
  </div>
<?php } ?>
<?php
if ($_SESSION['user_type'] == 'student') {
  include './top_inc/top_footer.php';
}
if ($_SESSION['user_type'] == 'admin' || $_SESSION['user_type'] == 'driver') {
  include './inc/footer.php';
}


?>