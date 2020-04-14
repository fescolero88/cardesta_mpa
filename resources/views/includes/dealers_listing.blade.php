<script>
    var placeSearch, autocomplete;
    var componentForm = {
    street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'short_name',
            country: 'long_name',
            postal_code: 'short_name'
    };
    function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocomplete = new google.maps.places.Autocomplete(
            /** @type  {!HTMLInputElement} */(document.getElementById('stm-car-location-stm_all_listing_tab')),
    {types: ['geocode']});
    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);
    var latlng = {lat:parseFloat(window.localStorage.getItem('latitude')), lng:parseFloat(window.localStorage.getItem('longitude'))};
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({'latLng': latlng}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
    console.log(results)
            if (results[0]) {
    var address = results[0]['address_components'][3]['short_name'] + ', ' + results[0]['address_components'][4]['short_name'] + ', ' + results[0]['address_components'][8]['short_name'];
    console.log(address);
    window.localStorage.setItem('location', address);
    document.getElementById('g-lat').innerHTML = window.localStorage.getItem('location');
    }
    else{
    window.localStorage.setItem('location', "unknown location");
    document.getElementById('g-lat').innerHTML = window.localStorage.getItem('location');
    }
    }
    else{
    window.localStorage.setItem('location', "unknown location");
    //document.getElementById('g-lat').innerHTML = window.localStorage.getItem('location');
    }
    });
    }

    function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();
    $('input[name="stm_lat"]').val(place.geometry.location.lat())
            $('input[name="stm_lng"]').val(place.geometry.location.lng())
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
    if (window.localStorage.getItem('latitude') && window.localStorage.getItem('longitude'))
    {

    var geolocation = {
    lat: window.localStorage.getItem('latitude'),
            lng: window.localStorage.getItem('longitude')
    }
    var circle = new google.maps.Circle({
    center: geolocation,
            radius: window.localStorage.getItem('accuracy')
    });
    autocomplete.setBounds(circle.getBounds());
    }
    }


    $(function(){

    if (window.localStorage.getItem('latitude') && window.localStorage.getItem('longitude'))
    {
    $("input[name='stm_lat']").val(window.localStorage.getItem('latitude'));
    $("input[name='stm_lng']").val(window.localStorage.getItem('longitude'));
    $('#newSearchHeaderForm_NewCar_distance').val(100).trigger('change');
    @if (!isset($_GET['stm_lat']))
            $("#dealersearch").submit();
    @endif
    }

    @if (!empty($_GET['searchdistance']))
            $("#newSearchHeaderForm_NewCar_distance").val({{ $_GET['searchdistance'] }}).trigger('change');
    @endif

    })

</script>
<!--search by Name-->
<script>
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    //contact info
    jQuery(document).ready(function ($) {
    //by name
    $("#dealer_info").submit(function (e) {
    e.preventDefault();
    var formdata = $("#dealer_info").serialize(); // process the form
    $.ajax({
    type: 'GET',
            url: '{{route('searchby_dealername')}}',
            data: formdata,
            dataType: 'json',
            encode: true,
            processData: false,
            success: function (formdata) {
            if (formdata.status == "failure"){
            $('.err-dealer_name').html(formdata.msg);
            } else{
            $("#exampleModal3").modal("hide");
            $(".all_dealers").html(formdata.response);
            $("#dealer_info")[0].reset();
            $(".err-dealer_name").hide();
            }
            }
    });
    });
    //by make
    $("#dealer_make").submit(function (e) {
    e.preventDefault();
    var formdata = $("#dealer_make").serialize(); // process the form
    $.ajax({
    type: 'GET',
            url: '{{route('searchby_dealername')}}',
            data: formdata,
            dataType: 'json',
            encode: true,
            processData: false,
            success: function (formdata) {
            if (formdata.status == "failure"){
            $('.err-make').html(formdata.msg);
            } else{
            $("#exampleModal2").modal("hide");
            $(".all_dealers").html(formdata.response);
            $("#dealer_make")[0].reset();
            $(".err-make").hide();
            }
            }
    });
    });
    //search by distance and zip
    $("#searchbydistance").submit(function (e) {
    e.preventDefault();
    var formdata = $("#searchbydistance").serialize(); // process the form
    $.ajax({
    type: 'GET',
            url: '{{route('searchby_dealername')}}',
            data: formdata,
            dataType: 'json',
            encode: true,
            processData: false,
            success: function (formdata) {
            if (formdata.status == "failure"){
            $('.err-make').html(formdata.msg);
            } else{
            $("#exampleModal1").modal("hide");
            $(".all_dealers").html(formdata.response);
            $("#searchbydistance")[0].reset();
            }
            }
    });
    });
    });</script>
<!--google map marker-->
<script>
    var map;
    var geocoder;
    function initMap() {
    var mapLayer = document.getElementById("map-layer");
    var centerCoordinates = new google.maps.LatLng(43.18, -77.75);
    var defaultOptions = { center: centerCoordinates}
    map = new google.maps.Map(mapLayer, defaultOptions);
    geocoder = new google.maps.Geocoder();
<?php
if (!empty($dealers)) {
    foreach ($dealers as $dealer){
        ?>
            var contentString = '<?php echo $dealer['address'] ." ". $dealer['city'] ." ". $dealer['state']; ?>';
            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });
            geocoder.geocode({ 'address': '<?php echo $dealer['address'] ." ". $dealer['city']. " " . $dealer['state']; ?>' }, function(LocationResult, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = LocationResult[0].geometry.location.lat();
                var longitude = LocationResult[0].geometry.location.lng();
            }
            var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(latitude, longitude),
                    map: map,
                    title: '<?php echo $dealer['address']. " " . $dealer['city'] . " " . $dealer['state']; ?>'
            });
            marker.addListener('click', function() {
                    infowindow.setContent(marker.title);
                    infowindow.open(map, marker);
            });
            map.fitBounds(bounds);
            });
        <?php
    }
}
?>
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            this.setZoom(11);
            google.maps.event.removeListener(boundsListener);
        });
    }
</script>
<?php $google_maps_geocoding_api = "AIzaSyD-b_CoGss0ZVfIk_YnRdyqlZFOvpwFiCo"; ?>
<script src="https://maps.googleapis.com/maps/api/js?key={{$google_maps_geocoding_api}}&libraries=places&callback=initMap" async defer></script>