<script src="{{asset('new_ui/js/jquery-2.2.4.min.js',Request::secure())}}" type="text/javascript"></script>

@if(Route::current()->getName() != "list")
<script src="{{asset('new_ui/js/jquery.mmenu.all.js',Request::secure())}}" type="text/javascript"></script>
@endif

<!-- bootstrap -->
<script src="{{asset('new_ui/js/bootstrap.min.js',Request::secure())}}" type="text/javascript"></script>

<script src="{{asset('new_ui/js/jquery-ui.js',Request::secure())}}" type="text/javascript"></script>

<script src="{{asset('new_ui/js/select2.min.js',Request::secure())}}" type="text/javascript"></script>

<!-- popper.min -->
<script src="{{asset('new_ui/js/popper.min.js',Request::secure())}}" type="text/javascript"></script>
<script src="{{asset('new_ui/js/custom-script.js',Request::secure())}}" type="text/javascript"></script>

@if(Route::current()->getName() != "dealerlist")
<?php $google_maps_geocoding_api = "AIzaSyD-b_CoGss0ZVfIk_YnRdyqlZFOvpwFiCo";?>
<script src="https://maps.googleapis.com/maps/api/js?key={{$google_maps_geocoding_api}}&libraries=places&callback=initAutocomplete" async defer></script>
@endif

<script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
     
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
            /** @type {!HTMLInputElement} */(document.getElementById('stm-car-location-stm_all_listing_tab')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);

          var latlng   = {lat:parseFloat(window.localStorage.getItem('latitude')),lng:parseFloat(window.localStorage.getItem('longitude'))};
          var geocoder = new google.maps.Geocoder();

          geocoder.geocode({'latLng': latlng}, function(results,status) {
              if(status === google.maps.GeocoderStatus.OK) {
                  console.log(results)
                  if(results[0]) {
                      var address = results[0]['address_components'][3]['short_name']+', '+results[0]['address_components'][4]['short_name']+', '+results[0]['address_components'][8]['short_name'];
                      console.log(address);
                      window.localStorage.setItem('location',address);
                      document.getElementById('g-lat').innerHTML =window.localStorage.getItem('location');
                  }
                  else{
                      window.localStorage.setItem('location',"unknown location");
                      document.getElementById('g-lat').innerHTML =window.localStorage.getItem('location');
                  }
              }
              else{
                  window.localStorage.setItem('location',"unknown location");
                  //document.getElementById('g-lat').innerHTML =window.localStorage.getItem('location');
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
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>

@yield('googleanalytics')

<script>
  $(function() {
        
        $("#menu").mmenu({
          //extensions: [ "shadow-panels", "fx-panels-slide-100", "border-none", "theme-black", "fullscreen" ],
          extensions: [ "position-front", "position-right"],
          navbars   : {
            content : [ "prev", "title", "close" ],
            height  : 2
          },
          setSelected: true,
          searchfield: {
            resultsPanel: true
          }}, { });
          // $(".mh-head.mm-sticky").mhead({
          //   scroll: {
          //     hide: 200
          //   }
          // });
          // $(".mh-head:not(.mm-sticky)").mhead({
          //   scroll: false
          // });

        $('body').on( 'click',
          'a[href^="#/"]',
          function() {
            return false;
          }
        );
      });
</script>
<script type="text/javascript">
    $(window).scroll(function(){
        var sticky = $('.header'),
            scroll = $(window).scrollTop();

       if (scroll >= 50) sticky.addClass('fixed-top');         
        else sticky.removeClass('fixed-top');
      });
</script>

<script>
      //search scipt in database
      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        let search_type = $(e.target).data('type');
        let value = $(e.target).data('value');

        if(!search_type)
        {
            $("input[name='certified']").val('');
            $("input[name='search_type']").val('');
            return;
        }

        if(search_type == 'certified_used')
        {
            $("input[name='certified']").val('True');
            $("input[name='search_type']").val('Used');
        }
        else
        {
             $("input[name='"+search_type+"']").val(value);
        }
    })
</script>