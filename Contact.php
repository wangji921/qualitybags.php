<div class="container-fluid myaboutcontainer">
    <h1>Contact us</h1>
    <div class="text-center">
        <h4>We'd love to hear from you, please contact us with the info below.</h4>
        <br />
        <address>
            <p><strong>Quality Bags</strong></p>
            <p>139 Carrington Rd, Mount Albert</p>
            <p>Auckland 1025</p>
            <p>New Zealand</p>
            <abbr title="Phone">Phone: </abbr>0800 10 95 10
        </address>
        <address>
            <strong>Support:</strong> <a href="mailto:study@unitec.ac.nz">study@unitec.ac.nz</a>
        </address>
    </div>
</div>


<div id="map"></div>
<div style="padding-bottom:50px;"></div>
<script>
    // Google Maps
    var marker
    function initMap() {
        var myLatLng = { lat: -36.8801237, lng: 174.7045496 };
        var map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 13
        });
        marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Unitec Institute of Technology',
            animation: google.maps.Animation.DROP
        });
        marker.addListener('click', toggleBounce);
    }

    function toggleBounce() {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfnpg3_OOEqQ5Qky1H0FinRRIpHpNAxQs&callback=initMap">
</script>
