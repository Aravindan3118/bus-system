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
if ($_SESSION['user_type'] == 'admin') {
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
                <div id="RideStatus"></div>
                <div id="googleMap" style="width:100%;height:400px;"></div>

                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAGGKKZDIrGC4i7w32LbaP-cEnmCw_UWE&callback=myMap"></script>

                <script>
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
                    // myMap({
                    //     lat: 11.0256128,
                    //     long: 76.976128
                    // })
                    let myLocApi = setInterval( () => {
                        document.getElementById('RideStatus').innerHTML = ""
                        fetch('getlocation.php').then(res => res.json()).then(res => {
                        console.log('res',res)
                        if(res){
                            myMap({
                                lat: +res.currentLocation.split(',')[0],
                                long: +res.currentLocation.split(',')[1]
                            })
                        }else{
                            document.getElementById('RideStatus').innerHTML = "<h1>Ride Details Not Available</h1>"
                        }
                    })
                    },5000)
                </script>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>
<?php } ?>
<?php
if ($_SESSION['user_type'] == 'student') {
    include './top_inc/top_footer.php';
}
if ($_SESSION['user_type'] == 'admin') {
    include './inc/footer.php';
}


?>