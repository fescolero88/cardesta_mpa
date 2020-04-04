@extends("layouts/frontendlayout")
@section('title',"Find Your Closest Dealer" )
@section('description','Research and compare cars, find local dealers/sellers, calculate loan payments, find your car\'s value, sell or trade your car, get a service estimate, and much more on CarDesta.com.')
@section("frontend")
    <div id="wrapper" style="min-height: 399px;">
    @include('layouts.header')

    <div id="main">
        <div class="stm-single-car-page " style="margin-bottom: 25px">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                    <div class="vc_row wpb_row vc_row-fluid">
                        <div class="wpb_column vc_column_container vc_col-sm-12">
                            <div class="vc_column-inner vc_custom_1459408833820">
                                <div class="wpb_wrapper" style="margin-top:100px;">
                                    <div class="stm_dynamic_listing_filter filter-listing stm-vc-ajax-filter animated fadeIn ">
                                        <div class="tab-content">

                                            <div role="tabpanel" class="tab-pane fade in active" id="stm_all_listing_tab">
                                                <form class="sm-form-style" action="{{ route('dealerlist') }}" method="GET" id="dealersearch">
                                                    <button type="submit" class="heading-font xs-tab-btn"><i class="fa fa-search"></i> Search
                                                    </button>
                                                    <div class="stm-filter-tab-selects filter stm-vc-ajax-filter xs-order-one">
                                                        <div class="row">
                                                            <div class="col-md-4 col-sm-6 col-xs-12 stm-select-col">
                                                                <div class="stm-ajax-reloadable">
                                                                   <input type="text" name="zip" placeholder="Enter Your Zip" value="{{ $_GET['zip'] ?? '' }}" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-6 col-xs-12 stm-select-col">
                                                                <div class="stm-ajax-reloadable">
                                                                    <select name="searchdistance" id="newSearchHeaderForm_NewCar_distance" class="distance form-control" data-change="searchdistance">
                                                                        <option value="10"  >10 mi</option>
                                                                        <option value="25" >25 mi</option>
                                                                        <option value="50" >50 mi</option>
                                                                        <option value="75" >75 mi</option>
                                                                        <option value="100" >100 mi</option>
                                                                        <option value="150" >150 mi</option>
                                                                        <option value="200" >200 mi</option>
                                                                        <option value="500" >500 mi</option>
                                                                        <option value="0" selected="selected">Select a Distance</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-6 col-xs-12 stm-select-col">
                                                                <div class="stm-location-search-unit">
                                                                    <input type="text" class="stm_listing_filter_text stm_listing_search_location" id="stm-car-location-stm_all_listing_tab" name="ca_location" placeholder="Enter a Location" value="{{ $_GET['ca_location'] ?? '' }}" autocomplete="off">
                                                                    <input type="hidden" name="stm_lat" value="{{ $_GET['stm_lat'] ?? '' }}">
                                                                    <input type="hidden" name="stm_lng" value="{{ $_GET['stm_lng'] ?? '' }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div></div>
            </div>
        </div>


        <div class="stm-single-car-page ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-sm-12" style="margin-top:12px;">
                        <h4 class="title heading-font min-m-top">Find Your Closest Dealer</h4>
                        <p>Research and compare cars, find local dealers/sellers, calculate loan payments, find your car's value, sell or trade your car, get a service estimate, and much more on CarDesta.com.</p>
                    </div><!--col-lg-12 col-sm-12 end-->
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    @if(!$featured->isEmpty() || !$dealers->isEmpty() )
                    <div class="col-lg-12 col-sm-12">
                        <div class="active-delear">

                            <div class="stm-featured-top-cars-title m-bot-zero">
                                <div class="heading-font">Featured</div>
                            </div><!--stm-featured-top-cars-title end-->
                            @foreach($featured as $feature)
                                <div class="listing-list-loop stm-listing-directory-list-loop stm-isotope-listing-item dealer-list-back" style="background:#f1faf3 !important;">
                                    <div class="content">
                                        <div class="meta-top min-m-bot">
                                            <div class="title heading-font dealer-head">
                                                <a href="{{route('list',['dealername'=>empty($feature->name)?'car-dealer-solutions':strtolower(str_replace(' ','-',$feature->name)),'id'=>$feature->dealer_id,'zip'=>makeslug($feature->zip,"zip")])}}" class="rmv_txt_drctn">{{ !empty($feature->name) ? $feature->name : 'Car Dealer Solutions'}}</a>
                                            </div>
                                        </div>
                                        <div class="meta-middle min-m-bot min-height">
                                            <div class="meta-middle-row m-top-bot-zero clearfix">
                                                <div class="meta-middle-unit font-exists dealer-list-wid " style="width:33%;">
                                                    <div class="meta-middle-unit-top">
                                                        <div class="icon"><i class="fas fa-car clr-green"></i></div>
                                                        <div class="name">Used Type</div>
                                                    </div>
                                                    <div class="value">{{$feature->dealerproduct_count}} New/Used</div>
                                                </div>
                                                <div class="meta-middle-unit meta-middle-divider"></div>
                                                <div class="meta-middle-unit font-exists  dealer-list-wid" style="width:33%;">
                                                    <div class="meta-middle-unit-top">
                                                        <div class="icon"><i class="fas fa-phone clr-green"></i></div>
                                                        <div class="name">Phone</div>
                                                    </div>
                                                    <div class="value">{{$feature->call_tracking_no}}</div>
                                                </div>
                                                <div class="meta-middle-unit meta-middle-divider"></div>
                                                <div class="meta-middle-unit font-exists dealer-list-wid" style="width:33%;">
                                                    <div class="meta-middle-unit-top">
                                                        <div class="icon"><i class="fas fa-map-marker-alt clr-green"></i></div>
                                                        <div class="name">Location</div>
                                                    </div>
                                                    <div class="value">{{$feature->city}}, {{$feature->state}}</div>
                                                </div>
                                                <div class="meta-middle-unit meta-middle-divider"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div><!--active-delear end-->
                    </div>

                                @foreach($dealers as $dealer)
                                <?php
                                     $dealer = (object)$dealer;
                                ?>
                            <div class="col-lg-12 col-sm-12">
                                        <div class="inactive-delear">

                                            <div class="listing-list-loop stm-listing-directory-list-loop stm-isotope-listing-item dealer-inactive-list-back ">
                                                <div class="content">
                                                    <div class="meta-top min-m-bot">
                                                        <div class="title heading-font dealer-head">
                                                            <a href="{{route('list',['dealername'=>$dealer->dealer_slug,'id'=>$dealer->dealer_id,'zip'=>makeslug($dealer->zip,"zip")])}}" class="rmv_txt_drctn">{{ !empty($dealer->name) ? $dealer->name : 'Car Dealer Solutions'}}</a>
                                                        </div>
                                                    </div>
                                                    <div class="meta-middle m-bot-zero min-height">
                                                        <div class="meta-middle-row m-top-bot-zero clearfix">
                                                            <div class="meta-middle-unit font-exists dealer-list-wid " style="width:33%;">
                                                                <div class="meta-middle-unit-top">
                                                                    <div class="icon"><i class="fas fa-car clr-green"></i></div>
                                                                    <div class="name">Used Type</div>
                                                                </div>
                                                                <div class="value">{{$dealer->dealerproduct_count}} New/Used</div>
                                                            </div>
                                                            <div class="meta-middle-unit meta-middle-divider"></div>
                                                            <div class="meta-middle-unit font-exists  dealer-list-wid" style="width:33%;">
                                                                <div class="meta-middle-unit-top">
                                                                    <div class="icon"><i class="fas fa-phone clr-green"></i></div>
                                                                    <div class="name">Phone</div>
                                                                </div>
                                                                <div class="value">{{$dealer->call_tracking_no}}</div>
                                                            </div>
                                                            <div class="meta-middle-unit meta-middle-divider"></div>
                                                            <div class="meta-middle-unit font-exists dealer-list-wid" style="width:33%;">
                                                                <div class="meta-middle-unit-top">
                                                                    <div class="icon"><i class="fas fa-map-marker-alt clr-green"></i></div>
                                                                    <div class="name">Location</div>
                                                                </div>
                                                                <div class="value">{{$dealer->city}}, {{$dealer->state}}</div>
                                                            </div>
                                                            <div class="meta-middle-unit meta-middle-divider"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--inactive-delear end-->
                            </div>
                                @endforeach
                    <div class="col-lg-12 col-sm-12">
                                <nav aria-label="Page navigation ">
                                    <ul class="pagination pull-right">
                                        {{$dealers->appends($_GET)->links()}}
                                    </ul>
                                </nav></div>
                    @else
                        <img src="{{remote_asset('images/vendor_not_found.png')}}" class="img-responsive middle">
                        <!--col-lg-12 col-sm-12 end-->
                        @endif
                    </div>
                </div>
            </div><!--row end-->
        </div>
    </div>
    @include('layouts.footer')
@endsection
@push('scripts')
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
                    document.getElementById('g-lat').innerHTML =window.localStorage.getItem('location');
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
            if(window.localStorage.getItem('latitude') && window.localStorage.getItem('longitude'))
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

                        if(window.localStorage.getItem('latitude') && window.localStorage.getItem('longitude'))
                        {
                            $("input[name='stm_lat']").val(window.localStorage.getItem('latitude'));
                            $("input[name='stm_lng']").val(window.localStorage.getItem('longitude'));

                            $('#newSearchHeaderForm_NewCar_distance').val(100).trigger('change');
                    
                            @if(!isset($_GET['stm_lat']))
                                $( "#dealersearch" ).submit();
                            @endif
                        }

                    @if(!empty($_GET['searchdistance']))
                        $("#newSearchHeaderForm_NewCar_distance").val({{ $_GET['searchdistance'] }}).trigger('change');
                    @endif

        })

        </script>
    @endpush



