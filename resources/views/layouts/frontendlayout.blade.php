<!DOCTYPE html>
<html>
<head>
    <title>CarDesta - @yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <link href="{{remote_asset("css/all.css",\App::environment() == 'production')}}" rel="stylesheet" type="text/css">
    {{-- <link href="{{remote_asset("web-fontawsome/css/fontawesome-all.css",\App::environment() == 'production')}}" rel="stylesheet" type="text/css"> --}}
    @yield('css')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    @yield('googleanalytics')
    <script>

        if (navigator.geolocation){
            navigator.geolocation.getCurrentPosition(function(position){
                if(!window.localStorage.getItem('no-location'))
                {
                    window.localStorage.setItem('latitude',position.coords.latitude);
                    window.localStorage.setItem('longitude',position.coords.longitude);
                    window.localStorage.setItem('accuracy',position.coords.accuracy);
//                    window.localStorage.setItem('location',getlocation());
//                    document.getElementById('g-lat').innerHTML =window.localStorage.getItem('location');
//                    document.getElementById('g-lng').innerHTML = position.coords.longitude;
                    document.getElementById('location-off').style.display = 'none';
                    document.getElementById('location-view').style.display = 'block';
                }
                else
                {
                    document.getElementById('location-view').style.display = 'none';
                    document.getElementById('location-off').style.display = 'block';
                }

                document.getElementById('on-lat-lng').addEventListener('click',function(){
                    console.log('on-lat-lng');
                    window.localStorage.removeItem('no-location');
                    window.location.reload();

                },false)
                document.getElementById('clear-lat-lng').addEventListener('click',function(){
                    window.localStorage.removeItem('latitude');
                    window.localStorage.removeItem('longitude');
                    window.localStorage.setItem('no-location',1);
                    document.getElementById('g-lat').innerHTML = '';
//                    document.getElementById('g-lng').innerHTML = '';
                    window.location.reload();
                },false)
            });
        }
    </script>

</head>
<body class="page-template-default page page-id-1637 stm_frontend_customizer stm-template-listing stm-user-not-logged-in wpb-js-composer js-comp-ver-5.4.5 vc_responsive envato-preview-visible" ontouchstart="">

@yield('frontend')

<script type="text/javascript" src="{{remote_asset("js/home.js",\App::environment() == 'production')}}"></script>

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_GEOCODING_API_KEY') }}&libraries=places&callback=initAutocomplete" async defer>

</script>

<script>


//            $.ajax({
//                type: 'get',
//                url: 'https://geo.qualaroo.com/json/',
//                success: function (data){
//                    //console.log(data)
//                    window.localStorage.setItem('location',data.city+', '+data.country_name);
//                    document.getElementById('g-lat').innerHTML =window.localStorage.getItem('location');
//                },
//                error:function(){
//                    window.localStorage.setItem('location',"unknown location");
//                    document.getElementById('g-lat').innerHTML =window.localStorage.getItem('location');
//                }
//            });

//            $.getJSON("https://ipinfo.io/""?token=ca7f1e4138e45e", function (response) {
//                window.localStorage.setItem('location',response.city+', '+response.country);
//                document.getElementById('g-lat').innerHTML =window.localStorage.getItem('location');
//                console.log(response);
//            });

</script>
@stack('scripts')
@yield('googleadwords')

<!-- Begin Inspectlet JS Code -->
<script type="text/javascript" id="inspectletjs">
    (function() {
        var insp_ab_loader = true; // set this boolean to false to disable the A/B testing loader
        window._insp = window._insp || [];
        _insp.push(['wid', 1253224830]);
        var ldinsp = function(){
            if(typeof window._inspld != "undefined") return; window._inspld = 1; var insp = document.createElement('script'); insp.type = 'text/javascript'; insp.async = true; insp.id = "inspsync"; insp.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cdn.inspectlet.com/inspectlet.js?wid=1253224830&r=' + Math.floor(new Date().getTime()/3600000); var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(insp, x);if(typeof insp_ab_loader != "undefined" && insp_ab_loader){ var adlt = function(){ var e = document.getElementById('insp_abl'); if(e){ e.parentNode.removeChild(e); _insp.push(['ab_timeout']); }}; var adlc = "body{ visibility: hidden !important; }"; var adln = typeof insp_ab_loader_t != "undefined" ? insp_ab_loader_t : 1200; insp.onerror = adlt; var abti = setTimeout(adlt, adln); window.__insp_abt = abti; var abl = document.createElement('style'); abl.id = "insp_abl"; abl.type = "text/css"; if(abl.styleSheet) abl.styleSheet.cssText = adlc; else abl.appendChild(document.createTextNode(adlc)); document.head.appendChild(abl); } };
        setTimeout(ldinsp, 0);
    })();
</script>
<!-- End Inspectlet JS Code -->
</body>
</html>