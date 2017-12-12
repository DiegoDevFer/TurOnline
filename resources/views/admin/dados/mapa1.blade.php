<!DOCTYPE html>
<html>
<head>
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
</head>
<body>


<h3>My Google Maps Demo</h3>
<div id="map"></div>
<script>
    function initMap() {
        var uluru = {lat:-9.951906, lng:-67.827722};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: uluru
        });
        var image = '{{asset('img/market2.png')}}';

        var beachMarker = new google.maps.Marker({
            position: {lat: -9.960029, lng: -67.816872},
            map: map,
            icon: image
        });
    }

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTQB7g-Zt97BAFemdIua5zP9EdD3LK3Co&callback=initMap">
</script>
</body>
</html>