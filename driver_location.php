<?php
include_once './session.php';
include_once './inc/services/class.user.php';
$user = new User();
include './inc/head_ass.php';
include './inc/header.php';
include './inc/sidebar.php';


?>

<div class="content-wrapper">
    <!-- <section class="content-header">
        <h1>
            Page Header
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
    </section> -->

    <!-- Main content -->
    <section class="content container-fluid">
        <?php if ($_SESSION['user_type'] == 'driver') : ?>
            <!-- <button onclick="geoFindMe()">Emit Location</button> -->
            <button id="startTimer" class="btn btn-success" onclick="startTimer()">Start Ride</button>
            <button class="hide btn btn-danger" id="stopTimer" onclick="stopTimer()">StopRide</button>
        <?php endif ?>
    </section>
</div>

<script>
    var timer = null
    function startTimer(){
        document.getElementById('startTimer').classList.add("hide")
        document.getElementById('stopTimer').classList.remove("hide")
        timer = setInterval(() => {
            geoFindMe()
        }, 5000);
    }
    function stopTimer(){
        document.getElementById('startTimer').classList.remove("hide")
        document.getElementById('stopTimer').classList.add("hide")
        clearInterval(timer)
    }
    var initialLoc = {}
    function geoFindMe() {
        console.log('geo loc')
        function success(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            // myMap({
            //     lat: latitude,
            //     long: longitude
            // })
            // status.textContent = '';
            //   mapLink.href = `https://www.openstreetmap.org/#map=18/${latitude}/${longitude}`;
            // mapLink.textContent = `Latitude: ${latitude} °, Longitude: ${longitude} °`;
            console.log('lat long',`Latitude: ${latitude} °, Longitude: ${longitude} °`)
            if(initialLoc.latitude != latitude || initialLoc.longitude != longitude){
                initialLoc.latitude = latitude
                initialLoc.longitude = longitude
                console.log('update db')
                fetch('setlocation.php',{
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