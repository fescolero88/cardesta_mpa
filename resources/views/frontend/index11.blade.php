@extends("layouts/frontendlayout")
@section('title',"Find Cars for Sale and Reviews | New and Used Cars For Sale")
@section('description','Find used cars and new cars for sale at CarDesta.  Research and compare cars, find local dealers/sellers, get an estimate and much more on CarDesta.')
@section("frontend")
<div id="wrapper" style="min-height: 399px;">
    @include('layouts.homeheader')
    <div id="main">
        <!-- Breads -->
        <div class="container">
            <div class="vc_row wpb_row vc_row-fluid">
                <div class="stm-banner-fullwidth wpb_column vc_column_container vc_col-sm-12">
                    <div class="vc_column-inner ">
                        <div class="wpb_wrapper">
                            <div class="stm-banner-image-filter image" style="background-image: url('images/listing_bnr.jpg'); top: 91px;">
                            </div>
                            <div class="stm_lOffers_banner animated fadeIn">
                                <div class="centered-banner-content-listing ">
                                    <div class="inner">
                                        <object data="/images/arrow7white.svg" id="stm-vivus-arrow" type="image/svg+xml">
                                        </object>
                                        <h1>
                                            <span style="color: #f0bb3a;">
                                                {{ floor($home['noofproduct'] / 100) * 100 }}+
                                            </span>
                                        </h1>
                                        <h3>
                                            <span style="color: #ffffff;">
                                                Vehicles
                                            </span>
                                        </h3>
                                    </div>
                                </div>
                                <script>
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vc_row wpb_row vc_row-fluid">
                <div class="wpb_column vc_column_container vc_col-sm-12">
                    <div class="vc_column-inner vc_custom_1459408833820">
                        <div class="wpb_wrapper">
                            <div class="stm_dynamic_listing_filter filter-listing stm-vc-ajax-filter animated fadeIn ">
                                <!-- Nav tabs -->
                                <ul class="stm_dynamic_listing_filter_nav clearfix heading-font" role="tablist">
                                    <li class="active" role="presentation">
                                        <a aria-controls="stm_all_listing_tab" data-toggle="tab" href="#stm_all_listing_tab" role="tab">
                                            All condition
                                        </a>
                                    </li>
                                    <li class="">
                                        <a aria-controls="new-cars" data-slug="condition" data-toggle="tab" data-type="search_type" data-value="new-cars" href="#stm_all_listing_tab" role="tab">   
                                            New Cars
                                        </a>
                                    </li>
                                    <li class="">
                                        <a aria-controls="used-cars" data-slug="condition" data-toggle="tab" data-type="search_type" data-value="used-cars" href="#stm_all_listing_tab" role="tab">
                                            Used Cars
                                        </a>
                                    </li>
                                    <li class="">
                                        <a aria-controls="certified-used-cars" data-slug="condition" data-toggle="tab" data-type="certified_used" data-value="certified-used" href="#stm_all_listing_tab" role="tab">
                                            Certified Used Cars
                                        </a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="stm_all_listing_tab" role="tabpanel">
                                            @php
                                                if($check){
                                                $action=   route('list',['dealername'=>$googledealer->dealer->dealer_slug,'id'=>$googledealer->dealer->dealer_id,'zip'=>$googledealer->dealer->zip]) ;
                                                }else{
                                                $action=  route('list');
                                                }
                                            @endphp
                                        <form action="{{$action}}" class="sm-form-style" method="GET">
                                            <button class="heading-font xs-tab-btn" type="submit">
                                                <i class="fa fa-search">
                                                </i>
                                                Search
                                            </button>
                                            <div class="stm-filter-tab-selects filter stm-vc-ajax-filter xs-order-one">
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-6 col-xs-12 stm-select-col">
                                                        <div class="stm-ajax-reloadable">
                                                            <select aria-hidden="true" class="select2-hidden-accessible form-control" data-class="stm_select_overflowed" id="make" name="search_make" tabindex="-1">
                                                                <option value="">
                                                                    Choose Make
                                                                </option>
                                                                @foreach($search['makes'] as $key=>$val)
                                                                <option value="{{ $key }}">
                                                                    {{ $key }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 col-xs-12 stm-select-col">
                                                        <div class="stm-ajax-reloadable">
                                                            <select aria-hidden="true" class="select2-hidden-accessible" data-class="stm_select_overflowed" id="model" name="search_model" tabindex="-1">
                                                                <option value="0">
                                                                    Choose Model
                                                                </option>
                                                                @foreach($search['models'] as $make)
                                                                <option value="{{ $make }}">
                                                                    {{ $make }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 col-xs-12 stm-select-col">
                                                        <select aria-hidden="true" class="stm-filter-ajax-disabled-field select2-hidden-accessible form-control" data-class="stm_select_overflowed" name="max_price" tabindex="-1">
                                                            <option value="">
                                                                Max Price
                                                            </option>
                                                            @foreach($search['prices'] as $price)
                                                            <option value="{{ $price }}">
                                                                {{ money_format('%n',$price) }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 col-xs-12 stm-select-col">
                                                        <div class="stm-location-search-unit">
                                                            <input autocomplete="off" class="stm_listing_filter_text stm_listing_search_location" id="stm-car-location-stm_all_listing_tab" name="ca_location" placeholder="Enter a location" type="text">
                                                                <input name="stm_lat" type="hidden">
                                                                    <input name="stm_lng" type="hidden">
                                                                        <input name="search_type" type="hidden" value="">
                                                                            <input name="certified" type="hidden" value="">
                                                                                <input name="search_from" type="hidden" value="home">
                                                                                </input>
                                                                            </input>
                                                                        </input>
                                                                    </input>
                                                                </input>
                                                            </input>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade " id="new-cars" role="tabpanel">
                                    </div>
                                    <div class="tab-pane fade " id="used-cars" role="tabpanel">
                                    </div>
                                    <div class="tab-pane fade " id="certified-used-cars" role="tabpanel">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vc_row wpb_row vc_row-fluid vc_custom_1455190820632 vc_row-o-equal-height vc_row-flex">
                <div class="stm-vc-listing-pad__right wpb_column vc_column_container vc_col-sm-12 vc_col-lg-6">
                    <div class="vc_column-inner vc_custom_1459833133238">
                        <div class="wpb_wrapper">
                            <div class="stm_icon_filter_unit">
                                <div class="clearfix">
                                    <div class="stm_icon_filter_title">
                                        <h3>
                                            Browse by
                                            <span class="stm-secondary-color">
                                                Make
                                            </span>
                                        </h3>
                                    </div>
                                </div>
                                <div class="browse_by_make stm_listing_icon_filter stm_listing_icon_filter_3 text-left active">
                                    @if(!empty($search['makes']))
                                    @foreach($search['makes'] as $val => $count)
                                                @if($check)
                                    <a class="stm_listing_icon_filter_single" href="{{route('list',['dealername'=>$googledealer->dealer->dealer_slug,'id'=>$googledealer->dealer->dealer_id,'zip'=>$googledealer->dealer->zip])}}/?search_make={{ urlencode($val).'&search_from=home' }}" title="{{$val}}">
                                        <div class="inner">
                                            <div class="name">
                                                {{ str_limit($val, 8, '...') }}
                                            </div>
                                        </div>
                                    </a>
                                    @else
                                    <a class="stm_listing_icon_filter_single" href="{{ route('list') }}/?search_make={{ urlencode($val).'&search_from=home' }}" title="{{$val}}">
                                        <div class="inner">
                                            <div class="name">
                                                {{ str_limit($val, 8, '...') }}
                                            </div>
                                        </div>
                                    </a>
                                    @endif

                                        @endforeach
                                        
                                        @endif
                                </div>
                                @if(count($search['makes']) > 20)
                                <p class="prompt">
                                    <a class="button aabutton browse_by_make_btn" href="#">
                                        See More
                                    </a>
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="stm-vc-listing-pad__left wpb_column vc_column_container vc_col-sm-12 vc_col-lg-6">
                    <div class="vc_column-inner vc_custom_1459833140404">
                        <div class="wpb_wrapper">
                            <div class="stm_icon_filter_unit">
                                <div class="clearfix">
                                    {{--
                                    <div class="stm_icon_filter_label">
                                        --}}
                                            {{--Show all Types
                                    </div>
                                    --}}
                                    <div class="stm_icon_filter_title">
                                        <h3>
                                            Browse by
                                            <span class="stm-secondary-color">
                                                Type
                                            </span>
                                        </h3>
                                    </div>
                                </div>
                                <div class="browse_by_type stm_listing_icon_filter stm_listing_icon_filter_3 text-left active">
                                    @if(!empty($search['bodies']))
                                      @foreach($search['bodies'] as $key )
                                                @if($check)
                                    <a class="stm_listing_icon_filter_single" href="{{ route('list',['dealername'=>$googledealer->dealer->dealer_slug,'id'=>$googledealer->dealer->dealer_id,'zip'=>$googledealer->dealer->zip]) }}/?body={{ urlencode($key['body']).'&search_from=home' }}" title="{{$key['body']}}">
                                        <div class="inner">
                                            <div class="name">
                                                {{ str_limit($key['body'], 8, '...')}} ({{ $key['count'] }})
                                            </div>
                                        </div>
                                    </a>
                                    @else
                                    <a class="stm_listing_icon_filter_single" href="{{ route('list') }}/?body={{ urlencode($key['body']).'&search_from=home' }}" title="{{$key['body']}}">
                                        <div class="inner">
                                            <div class="name">
                                                {{ str_limit($key['body'], 8, '...')}}
                                            </div>
                                        </div>
                                    </a>
                                    @endif
                                       @endforeach
                                       @endif
                                </div>
                                @if(count($search['models']) > 20)
                                <p class="prompt">
                                    <a class="button aabutton browse_by_type_btn" href="#">
                                        See More
                                    </a>
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vc_row wpb_row vc_row-fluid vc_custom_1460725906798">
                <div class="wpb_column vc_column_container vc_col-sm-12">
                    <div class="vc_column-inner ">
                        <div class="wpb_wrapper">
                            <div class="stm_listing_tabs_style_2 ">
                                <div class="clearfix">
                                    <h3 class="hidden-md hidden-lg hidden-sm">
                                        New/Used Cars
                                    </h3>
                                    <!-- Nav tabs -->
                                    <ul class="stm_listing_nav_list heading-font" role="tablist">
                                        {{--
                                        <li class="" role="presentation">
                                            <a aria-controls="popular" data-toggle="tab" href="#popular" role="tab">
                                                <span>
                                                    Popular items
                                                </span>
                                            </a>
                                        </li>
                                        --}}
                                        <li class="" role="presentation">
                                            <a aria-controls="recent" data-toggle="tab" href="#recent" role="tab">
                                                <span>
                                                    Recent items
                                                </span>
                                            </a>
                                        </li>
                                        <li class="active" role="presentation">
                                            <a aria-controls="recent" data-toggle="tab" href="#featured" role="tab">
                                                <span>
                                                    Featured items
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <h3 class="hidden-xs">
                                        New/Used Cars
                                    </h3>
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane fade " id="popular" role="tabpanel">
                                    </div>
                                    <div class="tab-pane fade " id="recent" role="tabpanel">
                                        <div class="loader" id="recentloader">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade active in" id="featured" role="tabpanel">
                                        <div class="loader" id="featuredloader">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vc_row wpb_row vc_row-fluid stm-fixed-attachment vc_custom_1480577795601" data-vc-full-width="true" data-vc-full-width-init="true" style="position: relative; left: -381.5px; box-sizing: border-box; width: 1903px; padding-left: 381.5px; padding-right: 381.5px;">
                <div class="wpb_column vc_column_container vc_col-sm-6 vc_col-lg-4">
                    <div class="vc_column-inner ">
                        <div class="wpb_wrapper">
                            <div class="stm-icon-counter">
                                <div class="dp-in">
                                    <div class="clearfix">
                                        <div class="stm-icon-counter-left">
                                            <i class="stm-service-icon-car-listing">
                                            </i>
                                        </div>
                                        <div class="stm-counter-meta heading-font">
                                            <div class="stm-value-wrapper">
                                                <div class="stm-value" id="counter_8131">
                                                    0
                                                </div>
                                                <div class="stm-value-affix">
                                                </div>
                                            </div>
                                            <div class="stm-label">
                                                cars for sale
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                            </script>
                        </div>
                    </div>
                </div>
                <div class="wpb_column vc_column_container vc_col-sm-6 vc_col-lg-4">
                    <div class="vc_column-inner ">
                        <div class="wpb_wrapper">
                            <div class="stm-icon-counter">
                                <div class="dp-in">
                                    <div class="clearfix">
                                        <div class="stm-icon-counter-left">
                                            <i class="stm-service-icon-two_users">
                                            </i>
                                        </div>
                                        <div class="stm-counter-meta heading-font">
                                            <div class="stm-value-wrapper">
                                                <div class="stm-value" id="counter_8132">
                                                    0
                                                </div>
                                                <div class="stm-value-affix">
                                                </div>
                                            </div>
                                            <div class="stm-label">
                                                visited user
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                            </script>
                        </div>
                    </div>
                </div>
                <div class="wpb_column vc_column_container vc_col-sm-6 vc_col-lg-4">
                    <div class="vc_column-inner ">
                        <div class="wpb_wrapper">
                        </div>
                    </div>
                </div>
                <div class="wpb_column vc_column_container vc_col-sm-6 vc_col-lg-4">
                    <div class="vc_column-inner ">
                        <div class="wpb_wrapper">
                            <div class="stm-icon-counter">
                                <div class="dp-in">
                                    <div class="clearfix">
                                        <div class="stm-icon-counter-left">
                                            <i class="stm-service-icon-shield-o">
                                            </i>
                                        </div>
                                        <div class="stm-counter-meta heading-font">
                                            <div class="stm-value-wrapper">
                                                <div class="stm-value" id="counter_5989">
                                                    0
                                                </div>
                                                <div class="stm-value-affix">
                                                </div>
                                            </div>
                                            <div class="stm-label">
                                                verified dealers
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vc_row-full-width">
            </div>
            <div class="clearfix">
            </div>
        </div>
    </div>
    <!--main-->
</div>
<!--wrapper-->
@include('layouts.footer')
    @endsection
@section('css')
    {{--
<link href="/css/admin_custom.css" rel="stylesheet">
    --}}
    <style>
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('images/pageLoader.gif') 50% 50% no-repeat rgb(249,249,249);
            opacity: .8;
        }
    </style>
    @stop

@push('scripts')
    <script>
        // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

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
    <script>
        jQuery(document).ready(function($) {

$(".browse_by_make_btn").click(function(e){
    e.preventDefault();
    $(".browse_by_make").css({height:'100%'});
    $(this).hide();
});

$(".browse_by_type_btn").click(function(e){
    e.preventDefault();
    $(".browse_by_type").css({height:'100%'});
    $(this).hide();
});



        var counter_8131 = new countUp("counter_8131", 0, {{ floor($home['noofproduct'] / 100) * 100  }}, 0, 3, {
            useEasing : true,
            useGrouping: true,
            separator : ',',
            suffix: '+'
        });

        $(window).scroll(function(){
            if( $("#counter_8131").is_on_screen() ){
                counter_8131.start();
            }
        });

        var counter_8132 = new countUp("counter_8132", 0, 1800, 0, 3, {
            useEasing : true,
            useGrouping: true,
            separator : ',',
            suffix: '+'
        });

        $(window).scroll(function(){
            if( $("#counter_8132").is_on_screen() ){
                counter_8132.start();
            }
        });
    });

    jQuery(document).ready(function($) {
        var counter_5989 = new countUp("counter_5989", 0, {{ floor($home['noofdealer'] / 100) * 100  }}, 0, 1.5, {
            useEasing : true,
            useGrouping: true,
            separator : ',',
            suffix: '+'
        });

        $(window).scroll(function(){
            if( $("#counter_5989").is_on_screen() ){
                counter_5989.start();
            }
        });
    });

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

    jQuery(document).ready(function($){
        var data;

        $.ajax({
            type        : 'GET',
            url         : '{{route('getcloserproduct')}}',
            data        : {
                'lat':$("input[name='stm_lat']").val() ? $("input[name='stm_lat']").val() : window.localStorage.getItem('latitude'),
                'lng':$("input[name='stm_lng']").val() ? $("input[name='stm_lng']").val() : window.localStorage.getItem('longitude'),
                'distance':100,
            },
            dataType    : 'json',
            encode          : true,
            beforeSend: function() {
                $('#recentloader').show();
                $('#featuredloader').show();
            },
            success: function(data) {

                $('#recentloader').hide();
                $('#featuredloader').hide();

                $("#recent").html(data['recentproduct']);
                $("#featured").html(data['featuredproduct']);
            },
            error: function(err) {

            }
        });

        var data=[];
        data={!! json_encode($search['makes_model']) !!};

        $('#make').change(function(e){
            var make = this.value;

            $.ajax({
                type: 'POST',
                url: '{{route('getmodel')}}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "make": make,
                    "home":true
                },
                success: function (data) {
                    $("#model").html(data);
                }
            });
        });

        $('#model').change(function(e){
            var model = this.value
            if(model!=='0'){
                make =data[model];

                $('#make').html('<option value="'+make+'">'+make+'</option>')
            }


        });

        function models(arr,make){
            arr2 =[];
            for(key in arr){
                if(arr[key]===make){
                    arr2.push(key);
                }

            }
            return arr2;
        }

        function makes(arr,model){
            arr2 =[];
            for(key in arr){
                if(arr[key]===make){
                    arr2.push(key);
                }

            }
            return arr2;
        }


    });
    </script>
    @endpush
