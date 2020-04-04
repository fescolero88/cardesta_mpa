@extends("layouts/frontendlayout")
@if($id!==null)
@section('title',"Find Cars for Sale and Reviews | New and Used Cars For Sale from {$search_filterable['product']['dealer']->name} | {$search_filterable['product']['dealer']->city}, {$search_filterable['product']['dealer']->state}, {$search_filterable['product']['dealer']->zip}")
@section('description',"Search cars for sale from {$search_filterable['product']['dealer']->name}, at {$search_filterable['product']['dealer']->city}, {$search_filterable['product']['dealer']->state}, {$search_filterable['product']['dealer']->zip} on CarDesta. Browse popular models for sale, find a car by make, model, features, mileage, certifications and get advice on your car shopping journey.")
@if(!empty($search_filterable['product']['dealer']->ga_tag))
@section('googleanalytics')
    <script async src="https://www.googletagmanager.com/gtag/js?id={{$search_filterable['product']['dealer']->ga_tag}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{$search_filterable['product']['dealer']->ga_tag}}');
    </script>
    @endsection
@endif
@else
@section('title',"Search for New and Used Cars for Sale")
@section('description','Search cars for sale at CarDesta.com. Browse popular models for sale in your area or in proximity, find a car by make, model, features, mileage, certifications and get advice on your car shopping journey.')
@endif

@section("frontend")
<div class="hide">
    @foreach ($list['product']['data'] as $row)
            <a href="{{ route('list_details',['dealername' => $row->dealer->dealer_slug ?? 'car-dealer-solution','city' => $row->dealer->city ?? '','vin' => $row->vin,'make'=>$row->make,'model'=>$row->model]) }}"  class="rmv_txt_drctn">
                <div class="labels">{{ $row->type}} {{ $row->year }}</div> {{ $row->make }} {{ $row->model }}
            </a>
            {{ $pagination }}
    @endforeach
</div>
<div id="app">
    <div id="wrapper" style="padding-top: 104px; min-height: 508px;">
        @include('layouts.header')
        <div id="main">
            <!-- Breads -->
            <div class="container">

                <div class="vc_row wpb_row vc_row-fluid">
                    <div class="wpb_column vc_column_container vc_col-sm-12">
                        <div class="vc_column-inner ">
                            <div class="wpb_wrapper">
                                <div class="archive-listing-page sm-bot-zero">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12">
                                                <h3 class="clr-ash sm-head">Shop Cars for Sale</h3>
                                            </div>

                                            <div class="cd-main-header">
                                                <a href="#0" class="cd-nav-trigger"><span><h6><i class="fas fa-filter clr-ash"></i> Filter</h6></span></a>
                                            </div>

                                            <div class="col-md-3 col-sm-2 classic-filter-row sidebar-sm-mg-bt sm-head-mar sm-pad-zero">
                                                <div class="cd-main-content">
                                                    <form action="" method="get" data-trigger="filter">
                                                        <nav class="cd-side-nav" style="">
                                                            <ul class="list-unstyled">
                                                                <li class="has-children overview active ">
                                                                    <a class="lg-display-none" href="#">Overview</a>
                                                                    <ul class="list-unstyled lg-display">
                                                                        <li>
                                                                            <div class="filter filter-sidebar pad-zero ">
                                                                                <!--
                                                                                  <div class="sidebar-entry-header">
                                                                                  <i class="stm-icon-car_search"></i>
                                                                                  <span class="h4">Search Options</span>
                                                                                  </div><!-->

                                                                                <div class="row row-pad-top-24 form-width" style="padding:0px">
                                                                                    <div class="col-md-12 col-sm-12">
                                                                                        <div id="exTab1" class="">
                                                                                            <ul class="tab nav-pills left-tab list-unstyled lg-display" role="tablist">
                                                                                                <li class="active" role="presentation">
                                                                                                    <a href="#1a" aria-controls="tab1" role="tab" data-toggle="tab" aria-expanded="true" data-type="type" data-value="Used">Search Used</a>
                                                                                                </li>
                                                                                                <li role="presentation" class="">
                                                                                                    <a href="#1a" aria-controls="tab2" role="tab" data-toggle="tab" aria-expanded="false" data-type="type" data-value="New">Search New</a>
                                                                                                </li>
                                                                                            </ul>
                                                                                            <div class="tab-content pad-left-right clearfix">
                                                                                                <div class="tab-pane active" id="1a">

                                                                                                    <div id="exTab2" class="lg-display">
                                                                                                        <ul class="nav nav-tabs left-second-tab">
                                                                                                            <li class="active" >
                                                                                                                <a  id="bycarused" href="#1" data-toggle="tab">By Car</a>
                                                                                                            </li>
                                                                                                            <li >
                                                                                                                <a id="bybodyused" href="#2" data-toggle="tab">Body Style</a>
                                                                                                            </li>
                                                                                                        </ul>

                                                                                                        <div class="tab-content mar-top p ">
                                                                                                            <div class="tab-pane active" id="1">
                                                                                                                <div class="form-group mar-top-bot">
                                                                                                                    <select name="searchmake" class="form-control" tabindex="-1" id="usedmake" aria-hidden="true" data-change="searchmake">
                                                                                                                        {{-- <option value="">
                                                                                                                            All Makes            </option> --}}
                                                                                                                        <option v-for="searchmake in make"  :value="searchmake.make">

                                                                                                                            @{{ searchmake.make == 'all' ?  'All Makes' : searchmake.make  }}

                                                                                                                        </option>

                                                                                                                    </select>
                                                                                                                    <span class="dropdown-wrapper" aria-hidden="true"></span>
                                                                                                                </div>

                                                                                                                <div class="form-group ">
                                                                                                                    <select name="searchmodel" class="form-control select2-hidden-accessible" tabindex="-1" id="usedmodel" aria-hidden="true" data-change="searchmodel">
                                                                                                                         {{-- <option value="All Models"  selected="selected">
                                                                                                                            All Models      </option> --}}
                                                                                                                        <option  v-for="searchmodel in model" :value="searchmodel.model">
                                                                                                                            @{{ searchmodel.model == 'all' ? 'All Models' : searchmodel.model}}
                                                                                                                        </option>

                                                                                                                    </select>

                                                                                                                    <span class="dropdown-wrapper" aria-hidden="true"></span>
                                                                                                                </div>
                                                                                                                <table class="cg-dealFinder-searchByCar-zipRadius">
                                                                                                                    <tbody>
                                                                                                                    <tr>
                                                                                                                        <td class="tdLabel border-none form-td-style "><label for="zip">ZIP</label></td>
                                                                                                                        <td class="tdContent border-none form-td-style " >
                                                                                                                            <input type="text" name="searchzip" maxlength="7" id="newSearchHeaderForm_NewCar_zip" class=" form-control" style="margin-top: 1px;">
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                    <tr>
                                                                                                                        <td class="tdLabel border-none form-td-style "><label for="zip">Location</label></td>
                                                                                                                        <td class="tdContent border-none form-td-style " >
                                                                                                                            <input type="text" class="stm_listing_filter_text stm_listing_search_location" id="stm-car-location-stm_all_listing_tab" name="ca_location" :value="selected_location" placeholder="Enter a Location" autocomplete="off">
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                    <tr>
                                                                                                                        <td class=" border-none form-td-style "><label for="distance">Radius</label></td>
                                                                                                                        <td class=" border-none form-td-style ">
                                                                                                                            <select name="searchdistance"id="newSearchHeaderForm_NewCar_distance" class="distance form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" data-change="searchdistance">
                                                                                                                                <option value="10" selected="selected">10 mi</option>
                                                                                                                                <option value="25">25 mi</option>
                                                                                                                                <option value="50">50 mi</option>
                                                                                                                                <option value="75">75 mi</option>
                                                                                                                                <option value="100" >100 mi</option>
                                                                                                                                <option value="150">150 mi</option>
                                                                                                                                <option value="200">200 mi</option>
                                                                                                                                <option value="500">500 mi</option>
                                                                                                                                <option value="50000">Nationwide</option>
                                                                                                                            </select><span class="dropdown-wrapper" aria-hidden="true"></span>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                    </tbody></table>
                                                                                                                <div class="clearfix"></div>
                                                                                                                <button id="searchused" type="button" class="heading-font middle mar-bot" onclick="search()">Search </button>
                                                                                                            </div>
                                                                                                            <div class="tab-pane" id="2">
                                                                                                                <div class="form-group mar-top-bot">
                                                                                                                    <select name="searchbody" class="form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" data-change="searchbody">
                                                                                                                        <option value="" selected="selected">
                                                                                                                            All Body Type            </option>

                                                                                                                        <option v-for="searchbody in body"  :value="searchbody.body">

                                                                                                                            @{{ searchbody.body }}

                                                                                                                        </option>

                                                                                                                    </select>
                                                                                                                    <span class="dropdown-wrapper" aria-hidden="true"></span>
                                                                                                                </div>
                                                                                                                <div class="clearfix"></div>
                                                                                                                <button id="searchused" type="button" class="heading-font middle mar-bot" onclick="search()">Search </button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                </div>


                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <!--View type-->
                                                                                <input type="hidden" id="stm_view_type" name="view_type" value="">
                                                                                <!--Filter links-->
                                                                                <input type="hidden" id="stm-filter-links-input" name="stm_filter_link" value="">
                                                                                <!--Popular-->
                                                                                <input type="hidden" name="popular" value="">


                                                                                <input type="hidden" name="s" value="">
                                                                                <input type="hidden" name="sort_order" value="">


                                                                            </div>
                                                                        </li>
                                                                    </ul>

                                                                </li>

                                                                <li class="has-children notifications active">
                                                                    <a class="lg-display-none" href="#0">Price</a>
                                                                    <ul class="list-unstyled">
                                                                        <li>
                                                                            <div class="stm-filter-listing-directory-price">
                                                                                <div class="stm-accordion-single-unit price">
                                                                                    <a class="title" data-toggle="collapse" href="#price" aria-expanded="true">
                                                                                        <h5> Price</h5>
                                                                                        <span class="minus"></span>
                                                                                    </a>
                                                                                    <div class="stm-accordion-content">
                                                                                        <div class="collapse in content" id="price">
                                                                                            <div class="stm-accordion-content-wrapper price-wrapper">
                                                                                                <div class="stm-price-range-unit">
                                                                                                    <div class="stm-price-range ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                                                                                        <div class="ui-Rochester, NY, USAslider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div>
                                                                                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 0%;"></span>
                                                                                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 100%;"></span>
                                                                                                        <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class="col-md-6 col-sm-6 col-xs-6 col-md-wider-right">
                                                                                                        <input type="text" name="min_price"  id="stm_filter_min_price">
                                                                                                    </div>
                                                                                                    <div class="col-md-6 col-sm-6 col-xs-6 col-md-wider-left">
                                                                                                        <input type="text" name="max_price"  id="stm_filter_max_price">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </li>

                                                                <div class="clearfix"></div>

                                                                <li class="has-children notifications active hover">
                                                                    <a class="lg-display-none" href="#0">Mileage</a>
                                                                    <ul class="list-unstyled">
                                                                        <li>
                                                                            <div class="stm-filter-listing-directory-price">
                                                                                <div class="stm-accordion-single-unit price">
                                                                                    <a class="title" data-toggle="collapse" href="#mileage" aria-expanded="true">
                                                                                        <h5>Mileage</h5>
                                                                                        <span class="minus"></span>
                                                                                    </a>
                                                                                    <div class="stm-accordion-content">
                                                                                        <div class="collapse in content" id="mileage">
                                                                                            <div class="stm-accordion-content-wrapper">
                                                                                                <div class="stm-milage-range-unit">
                                                                                                    <div class="stm-milage-range ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" style="margin-bottom: 19px;">
                                                                                                        <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div>
                                                                                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 0%;"></span>
                                                                                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 100%;"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class="col-md-6 col-sm-6 col-xs-6 col-md-wider-right">
                                                                                                        <input type="text" name="min_milage" id="stm_filter_min_milage">
                                                                                                    </div>
                                                                                                    <div class="col-md-6 col-sm-6 col-xs-6 col-md-wider-left">
                                                                                                        <input type="text" name="max_milage" id="stm_filter_max_milage">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </li>


                                                                <!--this portion add for extra style-->
                                                                <li class="has-children notifications active hover" v-show="transmission.length">
                                                                    <a class="lg-display-none" href="#0">Transmission Type</a>
                                                                    <ul class="list-unstyled">
                                                                        <li>
                                                                            <div class="stm-filter-listing-directory-price">
                                                                                <!--this portion add for extra style-->


                                                                                <div class="scroll-height1 stm-accordion-single-unit stm-listing-directory-checkboxes stm- stm-ajax-checkbox-instant price">
                                                                                    <a data-toggle="collapse" href="#accordion-trance" aria-expanded="true" class="title">
                                                                                        <h5>Transmission Type</h5>
                                                                                        <span class="minus"></span></a>
                                                                                    <div class="stm-accordion-content  scroll-height">
                                                                                        <div id="accordion-trance" class="collapse in content">
                                                                                            <div class="stm-accordion-content-wrapper stm-accordion-content-padded">
                                                                                                <div class="stm-accordion-inner">
                                                                                                    <label class="stm-option-label" v-for="trans in transmission">
                                                                                                       <div class="checker">
                                                                                                       <span>
                                                                                                         <input type="checkbox" class="custom-checkbox" class="custom-checkbox" name="transmission[]" :value="trans">
                                                                                                        </span>
                                                                                                        </div>
                                                                                                        <span>@{{trans}}</span>
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>



                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </li>


                                                                <div class="clearfix"></div>

                                                                <!--this portion add for extra style-->
                                                                <li class="has-children notifications active hover" v-show="transmission_speed.length">
                                                                    <a class="lg-display-none" href="#0">Transmission Speed</a>
                                                                    <ul class="list-unstyled">
                                                                        <li>
                                                                            <div class="stm-filter-listing-directory-price">
                                                                                <!--this portion add for extra style-->


                                                                                <div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm- stm-ajax-checkbox-instant price">
                                                                                    <a data-toggle="collapse" href="#accordion-speed" aria-expanded="true" class="title">
                                                                                        <h5>Transmission Speed</h5> <span class="minus"></span></a>
                                                                                    <div class="stm-accordion-content  scroll-height">
                                                                                        <div id="accordion-speed" class="collapse in content">
                                                                                            <div class="stm-accordion-content-wrapper stm-accordion-content-padded">
                                                                                                <div class="stm-accordion-inner">
                                                                                                    <label class="stm-option-label" v-for="speed in transmission_speed">
                                                                                                        <div class="checker">
                                                                                                       <span>
                                                                                                        <input type="checkbox" class="custom-checkbox"  name="transmission_speed[]" :value="speed">
                                                                                                        </span>
                                                                                                       </div>
                                                                                                        <span>@{{speed}}</span>
                                                                                                    </label>
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>



                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </li>

                                                                <div class="clearfix"></div>




                                                                <!--this portion add for extra style-->
                                                                <li class="has-children notifications active hover" v-show="fueltype.length">
                                                                    <a class="lg-display-none" href="#0">Fuel type</a>
                                                                    <ul class="list-unstyled">
                                                                        <li>
                                                                            <div class="stm-filter-listing-directory-price">
                                                                                <!--this portion add for extra style-->


                                                                                <div class="scroll-height1 stm-accordion-single-unit stm-listing-directory-checkboxes stm- stm-ajax-checkbox-instant">
                                                                                    <a data-toggle="collapse" href="#accordion-fuel" aria-expanded="true" class="title">
                                                                                        <h5>Fuel type</h5>
                                                                                        <span class="minus"></span></a>
                                                                                    <div class="stm-accordion-content  scroll-height">
                                                                                        <div id="accordion-fuel" class="collapse in content">
                                                                                            <div class="stm-accordion-content-wrapper stm-accordion-content-padded">
                                                                                                <div class="stm-accordion-inner">
                                                                                                    <label class="stm-option-label" v-for="fuel in fueltype">
                                                                                                        <div class="checker">
                                                                                                       <span>
                                                                                                        <input type="checkbox" class="custom-checkbox" name="fule[]" :value="fuel.fuel_type">
                                                                                                        </span>
                                                                                                        </div>
                                                                                                        <span>@{{ fuel.fuel_type }}</span>
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </li>

                                                                <div class="clearfix"></div>

                                                                <li class="has-children notifications active hover">
                                                                    <a class="lg-display-none" href="#0">Certified</a>
                                                                    <ul class="list-unstyled">
                                                                        <li>
                                                                            <div class="stm-filter-listing-directory-price">
                                                                                <!--this portion add for extra style-->


                                                                                <div class="scroll-height1 stm-accordion-single-unit stm-listing-directory-checkboxes stm- stm-ajax-checkbox-instant">
                                                                                    <a data-toggle="collapse" href="#accordion-new-used-cpo" aria-expanded="true" class="title">
                                                                                        <h5>Certified</h5>
                                                                                        <span class="minus"></span></a>
                                                                                    <div class="stm-accordion-content">
                                                                                        <div id="accordion-new-used-cpo" class="collapse in content">
                                                                                            <div class="stm-accordion-content-wrapper stm-accordion-content-padded">
                                                                                                <div class="stm-accordion-inner">
                                                                                                    @if(isset($_GET['certified']) && $_GET['certified']==='True' )
                                                                                                        <label class="stm-option-label">

                                                                                                                    <input type="checkbox" name="certified[]" value="True" checked>

                                                                                                            <span>Certified</span>
                                                                                                        </label>
                                                                                                    @else
                                                                                                        <label class="stm-option-label">

                                                                                                                    <input type="checkbox" name="certified[]" value="True">

                                                                                                            <span>Certified</span>
                                                                                                        </label>
                                                                                                    @endif

                                                                                                    @if(isset($_GET['certified']) && $_GET['certified']==='False' )
                                                                                                        <label class="stm-option-label">

                                                                                                                    <input type="checkbox" name="certified[]" value="False" checked>

                                                                                                            <span>Non Certified</span>
                                                                                                        </label>
                                                                                                    @else
                                                                                                        <label class="stm-option-label">

                                                                                                                    <input type="checkbox" name="certified[]" value="False">

                                                                                                            <span>Non Certified</span>
                                                                                                        </label>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </li>

                                                                <div class="clearfix"></div>

                                                                <li class="has-children notifications active hover" v-show="passengercapacity.length">
                                                                    <a class="lg-display-none" href="#0">Seating Capacity</a>
                                                                    <ul class="list-unstyled">
                                                                        <li>
                                                                            <div class="stm-filter-listing-directory-price">
                                                                                <!--this portion add for extra style-->


                                                                                <div class="scroll-height1 stm-accordion-single-unit stm-listing-directory-checkboxes stm- stm-ajax-checkbox-instant">
                                                                                    <a data-toggle="collapse" href="#accordion-seat-capacity" aria-expanded="true" class="title">
                                                                                        <h5>Seating Capacity</h5>
                                                                                        <span class="minus"></span></a>
                                                                                    <div class="stm-accordion-content  scroll-height">
                                                                                        <div id="accordion-seat-capacity" class="collapse in content">
                                                                                            <div class="stm-accordion-content-wrapper stm-accordion-content-padded">
                                                                                                <div class="stm-accordion-inner">
                                                                                                    <label class="stm-option-label" v-for="seat in passengercapacity">
                                                                                                    <div class="checker">
                                                                                                       <span>
                                                                                                       <input type="checkbox" class="custom-checkbox" name="passengercapacity[]" :value="seat">
                                                                                                       </span>
                                                                                                       </div>
                                                                                                        <span>@{{seat}}</span>
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </li>

                                                                <div class="clearfix"></div>

                                                                <li class="has-children notifications active hover" v-show="year.length">
                                                                    <a class="lg-display-none" href="#0">Year</a>
                                                                    <ul class="list-unstyled">
                                                                        <li>
                                                                            <div class="stm-filter-listing-directory-price">
                                                                                <!--this portion add for extra style-->


                                                                                <div class="scroll-height1 stm-accordion-single-unit stm-listing-directory-checkboxes stm- stm-ajax-checkbox-instant">
                                                                                    <a data-toggle="collapse" href="#accordion-ca-year" aria-expanded="true" class="title">
                                                                                        <h5>Year</h5>
                                                                                        <span class="minus"></span></a>
                                                                                    <div class="stm-accordion-content  scroll-height">
                                                                                        <div id="accordion-ca-year" class="collapse in content">
                                                                                            <div class="stm-accordion-content-wrapper stm-accordion-content-padded">
                                                                                                <div class="stm-accordion-inner">
                                                                                                    <label class="stm-option-label" v-for="years in year">
                                                                                                    <div class="checker">
                                                                                                       <span>
                                                                                                        <input type="checkbox" class="custom-checkbox" name="year[]" :value="years.year">
                                                                                                        </span>
                                                                                                        </div>
                                                                                                        <span>@{{years.year}}</span>
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </li>

                                                                <div class="clearfix"></div>

                                                                <li class="has-children notifications active hover" v-show="drivetrain.length">
                                                                    <a class="lg-display-none" href="#0">Drive</a>
                                                                    <ul class="list-unstyled">
                                                                        <li>
                                                                            <div class="stm-filter-listing-directory-price">
                                                                                <!--this portion add for extra style-->


                                                                                <div class="scroll-height1 stm-accordion-single-unit stm-listing-directory-checkboxes stm- stm-ajax-checkbox-instant">
                                                                                    <a data-toggle="collapse" href="#accordion-drive" aria-expanded="true" class="title">
                                                                                        <h5>Drive</h5>
                                                                                        <span class="minus"></span></a>
                                                                                    <div class="stm-accordion-content  scroll-height">
                                                                                        <div id="accordion-drive" class="collapse in content">
                                                                                            <div class="stm-accordion-content-wrapper stm-accordion-content-padded">
                                                                                                <div class="stm-accordion-inner">
                                                                                                    <label class="stm-option-label" v-for="drive in drivetrain">
                                                                                                    <div class="checker">
                                                                                                       <span>
                                                                                                        <input type="checkbox" class="custom-checkbox" name="drivetrain[]" :value="drive.drivetrain">
                                                                                                        </span>
                                                                                                        </div>
                                                                                                        <span>@{{drive.drivetrain}}</span>
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </li>

                                                                <div class="clearfix"></div>

                                                                <li class="has-children notifications active hover" v-show="extcolor.length">
                                                                    <a class="lg-display-none" href="#0">Exterior Color</a>
                                                                    <ul class="list-unstyled">
                                                                        <li>
                                                                            <div class="stm-filter-listing-directory-price">
                                                                                <!--this portion add for extra style-->


                                                                                <div class="scroll-height1 stm-accordion-single-unit stm-listing-directory-checkboxes stm- stm-ajax-checkbox-instant">
                                                                                    <a data-toggle="collapse" href="#accordion-exterior-color" aria-expanded="true" class="title">
                                                                                        <h5>Exterior Color</h5>
                                                                                        <span class="minus"></span></a>
                                                                                    <div class="stm-accordion-content  scroll-height">
                                                                                        <div id="accordion-exterior-color" class="collapse in content">
                                                                                            <div class="stm-accordion-content-wrapper stm-accordion-content-padded">
                                                                                                <div class="stm-accordion-inner">
                                                                                                    <label class="stm-option-label" v-for="ext in extcolor">
                                                                                                    <div class="checker">
                                                                                                       <span>
                                                                                                            <input type="checkbox" class="custom-checkbox" name="extcolor[]" :value="ext.exteriorcolor">
                                                                                                        </span>
                                                                                                        </div>
                                                                                                    <span :style="{display:'inline-block',width:'50px',height:'18px',border:'1px solid #000',background:'#'+ext.exteriorcolor,color: '#'+ext.exteriorcolor}">@{{ext.exteriorcolor}}</span>
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </li>

                                                                <div class="clearfix"></div>

                                                                <li class="has-children notifications active hover" v-show="intcolor.length">
                                                                    <a class="lg-display-none" href="#0">Interior Color</a>
                                                                    <ul class="list-unstyled">
                                                                        <li>
                                                                            <div class="stm-filter-listing-directory-price">
                                                                                <!--this portion add for extra style-->


                                                                                <div class="scroll-height1 stm-accordion-single-unit stm-listing-directory-checkboxes stm- stm-ajax-checkbox-instant">
                                                                                    <a data-toggle="collapse" href="#accordion-interior-color" aria-expanded="true" class="title">
                                                                                        <h5>Interior Color</h5>
                                                                                        <span class="minus"></span></a>
                                                                                    <div class="stm-accordion-content  scroll-height">
                                                                                        <div id="accordion-interior-color" class="collapse in content">
                                                                                            <div class="stm-accordion-content-wrapper stm-accordion-content-padded">
                                                                                                <div class="stm-accordion-inner">
                                                                                                    <label class="stm-option-label" v-for="ints in intcolor">
                                                                                                    <div class="checker">
                                                                                                       <span>
                                                                                                        <input type="checkbox" class="custom-checkbox" name="intcolor[]" :value="ints.interiorcolor">
                                                                                                        </span>
                                                                                                        </div>
                                                                                                        <span>@{{ints.interiorcolor}}</span>
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </li>

                                                                <div class="clearfix"></div>
                                                            </ul>
                                                        </nav>
                                                    </form>
                                                </div>

                                            </div><!--left-panel-col-end-->


                                            <!--left-panel html end-->






                                            <div class="col-md-9 col-sm-10 ">
                                                <div class="stm-ajax-row sm-stm-ajax-row">

                                                    <div class="stm-car-listing-sort-units stm-car-listing-directory-sort-units clearfix">
                                                        <div class="stm-listing-directory-title">
                                                            <h3 class="title">Cars for sale</h3>
                                                            <div class="stm-listing-directory-total-matches total stm-secondary-color heading-font"><span v-cloak>@{{ product.total > 9999 ? (Math.ceil(product.total / 100) * 100)+'+' : product.total }}</span> matches</div>
                                                        </div>
                                                        <div class="stm-directory-listing-top__right">
                                                            <div class="clearfix">
                                                                {{--<div class="stm-view-by">--}}
                                                                    {{--<a href="#" class="view-grid view-type " data-view="grid">--}}
                                                                        {{--<i class="stm-icon-grid"></i>--}}
                                                                    {{--</a>--}}
                                                                    {{--<a href="#" class="view-list view-type active" data-view="list">--}}
                                                                        {{--<i class="stm-icon-list"></i>--}}
                                                                    {{--</a>--}}
                                                                {{--</div>--}}



                                                                <div class="stm-sort-by-options clearfix">
                                                                    <span>Sort by:</span>
                                                                    <div class="stm-select-sorting">
                                                                        <select tabindex="-1" class="select2-hidden-accessible" aria-hidden="true" name="sortBy">
                                                                            <option value="year,desc" selected="">Date: newest first</option>
                                                                            <option value="year,asc">Date: oldest first</option>
                                                                            <option value="sellingprice,asc">Price: lower first</option>
                                                                            <option value="sellingprice,desc">Price: highest first</option>
                                                                            <option value="miles,asc">Mileage: lowest first</option>
                                                                            <option value="miles,desc">Mileage: highest first</option>
                                                                        </select>

                                                                        <span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="listings-result">

                                                        <div class="stm-featured-top-cars-title">
                                                            <div class="heading-font">Inventory List</div>
                                                        </div>

                                                        <div class="stm-isotope-sorting stm-isotope-sorting-list">


                                                            <div class="listing-list-loop stm-listing-directory-list-loop stm-isotope-listing-item ">
                                                                <div v-if="product.data.length == 0" v-cloak>
                                                                    <img  class ="nocarfound" class="center-block" src="{{ remote_asset('images/car_not_found.png',\App::environment() == 'production') }}" />
                                                                </div>
                                                                <div v-for="row in product.data" v-cloak class="clearfix">

                                                                <div class="image">

                                                                        <a :href="app_base_url(row)" class="rmv_txt_drctn">


                                                                            {{--<a :href="'/'+row.id+'/details'" v-bind:data-id=row.id class="rmv_txt_drctn">--}}

                                                                            <div class="image-inner">
                                                                                <img :dataOriginal=" row.images.length?(row.images[0].image !=='' ? row.images[0].image : noimage()):noimage()" :src=" row.images.length?(row.images[0].image !=='' ? row.images[0].image : noimage()):noimage()" class="lazy img-responsive" :alt="row.type+' '+row.year+' '+row.make+' '+row.model" style="display: block;">
                                                                            </div>
                                                                        </a>
                                                                </div>

                                                                <div class="content">

                                                                    <div class="meta-top">
                                                                        <div class="price">
                                                                            <div class="normal-price">
                                                                                <span class="heading-font stm-tooltip-link" data-toggle="tooltip" data-placement="bottom" :title="row.dealer.price_off || row.sellingprice =='' ? row.dealer.call_tracking_no :  row.display_price" :data-original-title="row.dealer.price_off || row.sellingprice =='' ? row.dealer.call_tracking_no :  row.display_price" >Price: @{{ row.dealer.price_off || row.sellingprice =='' ? 'Call for price' :  row.display_price }}</span>
                                                                            </div>
                                                                        </div>

                                                                        <div class="title heading-font">
                                                                            <a :href="app_base_url(row)" :data-id=row.id class="rmv_txt_drctn">
                                                                                <div class="labels">@{{row.type}} @{{row.year}}</div> @{{row.make}} @{{row.model}}		</a>
                                                                        </div>
                                                                    </div>

                                                                    <div class="meta-middle">
                                                                        <div class="meta-middle-row xs-m-zero clearfix">




                                                                            <div class="meta-middle-unit xs-min-m font-exists mileage">
                                                                                <div class="meta-middle-unit-top">
                                                                                    <div class="icon"><i class="stm-icon-road"></i></div>
                                                                                    <div class="name">Mileage</div>
                                                                                </div>

                                                                                <div class="value">
                                                                                    @{{row.miles}}                  </div>
                                                                            </div>
                                                                            <div class="meta-middle-unit meta-middle-divider"></div>







                                                                            <div class="meta-middle-unit font-exists fuel">
                                                                                <div class="meta-middle-unit-top">
                                                                                    <div class="icon"><i class="stm-icon-fuel"></i></div>
                                                                                    <div class="name">Fuel type</div>
                                                                                </div>

                                                                                <div class="value" :title="row.fuel_type">
                                                                                    @{{row.fuel_type}}                   </div>
                                                                            </div>
                                                                            <div class="meta-middle-unit meta-middle-divider"></div>







                                                                            <div class="meta-middle-unit font-exists engine">
                                                                                <div class="meta-middle-unit-top">
                                                                                    <div class="icon"><i class="stm-icon-engine_fill"></i></div>
                                                                                    <div class="name">Engine</div>
                                                                                </div>

                                                                                <div class="value" :title="row.engine_description">
                                                                                    @{{row.enginecylinders}} Cyl - @{{ row.enginedisplacement }}                    </div>
                                                                            </div>
                                                                            <div class="meta-middle-unit meta-middle-divider"></div>






                                                                            <div class="meta-middle-unit font-exists location">
                                                                                <div class="meta-middle-unit-top">
                                                                                    <div class="icon"><i class="stm-service-icon-pin_big"></i></div>
                                                                                    <div class="name">Distance</div>
                                                                                </div>

                                                                                <div class="value">
                                                                                    <div class="stm-tooltip-link" data-toggle="tooltip" data-placement="bottom" :title="row.dealer['city']+' '+row.dealer['state']" :data-original-title="row.dealer['city']+' '+row.dealer['state']">
                                                                                        @{{row.dealer['city']}} @{{row.dealer['state']}}                               </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="meta-middle-unit meta-middle-divider"></div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="meta-bottom">

                                                                        <div class="single-car-actions">
                                                                            <ul class="list-unstyled clearfix">


                                                                                <li class="car-action-dealer-info">
                                                                                    <div class="listing-archive-dealer-info clearfix">

                                                                                        <div class="dealer-info-block">
                                                                                        <a :href="'{{ url()->to('/') }}'+'/inventory/'+row.dealer['dealer_slug']+'/'+row.dealer['dealer_id']+'/'+row.dealer['zip']!==''?row.dealer['zip']:'car-dealer-solution-zip'" class="title">@{{ row.dealer['name'] ? row.dealer['name'] :'Car Dealers Solutions' }} </a>
                                                                                            <div class="dealer-information" v-if="row.dealer['call_tracking_no']">
                                                                                                <i class="stm-service-icon-phone"></i><div class="phone">@{{row.dealer['call_tracking_no']}}</div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="certified-logo-1" v-show="row.certified == 'True'">
                                                                                    <img src="{{ url()->to('/') }}/images/Certified-pre-owned.png" alt="Certified">
                                                                                </li>

                                                                                <!--Stock num-->

                                                                                <!--Schedule-->

                                                                                <!--Compare-->

                                                                                <!--PDF-->

                                                                                <!--Share-->

                                                                                <!--Certified Logo 1-->

                                                                                <!--Certified Logo 2-->

                                                                            </ul>
                                                                        </div>        </div>

                                                                    <a :href="app_base_url(row)" class="stm-car-view-more button visible-xs xs-min-m">View more</a>

                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>


                                                        <div class="row" v-if="product.next_page_url" >
                                                            <div class="col-xs-12 text-center">
                                                                <div class="dp-in">
                                                                    <a class="load-more-btn" @click="loadmoreproducts" href="javascript:;">
                                                                        Show More</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!--col-md-9-->

                                        </div>

                                    </div>
                                </div></div></div></div></div>


                <div class="clearfix">
                </div>
            </div>
        </div> <!--main-->
    </div>
</div>
@include('layouts.footer')
 {{--</template>--}}
    </div>
</div>


@endsection

@section('css')

    <style>
        .nocarfound{
            margin:0 auto;
            display: block;
        }

        .stm-template-listing .stm-accordion-single-unit>a.title {
            border-top-color: #1bc744;
        }

        .nicescroll-rails{
            z-index:999 !important;
        }
    </style>
    @endsection

@push('scripts')
    <script type="text/javascript" src="{{asset("js/list.js")}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>

var formatted_address;
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
        /** @type {!HTMLInputElement} */
        (document.getElementById('stm-car-location-stm_all_listing_tab')), {
            types: ['geocode']
        });

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);

    var latlng = {
        lat: parseFloat(window.localStorage.getItem('latitude')),
        lng: parseFloat(window.localStorage.getItem('longitude'))
    };
    var geocoder = new google.maps.Geocoder();

    geocoder.geocode({
        'latLng': latlng
    }, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            console.log(results)
            if (results[0]) {
                var address = results[0]['address_components'][3]['short_name'] + ', ' + results[0]['address_components'][4]['short_name'] + ', ' + results[0]['address_components'][8]['short_name'];
                console.log(address);
                window.localStorage.setItem('location', address);
                document.getElementById('g-lat').innerHTML = window.localStorage.getItem('location');
            } else {
                window.localStorage.setItem('location', "unknown location");
                document.getElementById('g-lat').innerHTML = window.localStorage.getItem('location');
            }
        } else {
            window.localStorage.setItem('location', "unknown location");
            document.getElementById('g-lat').innerHTML = window.localStorage.getItem('location');
        }
    });


}

function fillInAddress() {

    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();
    data.search.stm_lat = place.geometry.location.lat()
    data.search.stm_lng = place.geometry.location.lng()
    data.search.search_distance = 10
    data.selected_location = place.formatted_address;
    formatted_address = place.formatted_address;

}
var base_url = '{{ url()->to(' / ') }}';
//var data = {!! json_encode($search_filterable) !!};
var data = {
    "product": {
        data: []
    },
    "makes_model": [],
    "year": [],
    "extcolor": [],
    "intcolor": [],
    "drivetrain": [],
    "body": [],
    "price": [],
    "milage": [],
    "transmission": [],
    "transmission_speed": [],
    "make": [],
    "model": [],
    "passengercapacity": [],
    "dateinstock": [],
    "fueltype": [],
    "search": {!!json_encode($search_filterable['search']) !!
    },
};
data.base_url = base_url;
data.selected_make = '{{ $_GET['
search_make ']?? '
' }}';
data.selected_model = '{{ $_GET['
search_model ']?? '
' }}';
data.selected_location = '{{ $_GET['
ca_location ']?? '
' }}';
data.selected_body = '{{ $_GET['
body ']?? '
' }}';
var stmOptions_price;
var stmOptions_milage;
var si;
if (window.localStorage.getItem('latitude') && window.localStorage.getItem('longitude')) {
    var pos = {
        lat: window.localStorage.getItem('latitude'),
        lng: window.localStorage.getItem('longitude')
    }
    data.search.stm_lat = pos.lat;
    data.search.stm_lng = pos.lng;
    data.search.search_distance = 100;
}
var vm = new Vue({

    el: '#app',

    data: data,

    mounted() {
        this.initial_fetach();
    },
    methods: {

        initial_fetach() {
            $('.stm-ajax-row').addClass('stm-loading');
            $('.classic-filter-row .filter-sidebar .select2-container--default .select2-selection--single .select2-selection__arrow b').addClass('stm-preloader');

            let that = this;
            let nocarfound = base_url + '/images/car_not_found.png';
            $(".nocarfound").attr('src', base_url + '/images/CARloader.gif');

            var url = '{{ url()->current() }}';

            @if(empty($_GET['search_from']))
            data.search.sellingprice = ""
            data.search.miles = ""
            @endif
            var url_s = base_url + '/inventory?' + this.serialize();
            @if(!empty($_GET['max_price']))
            url_s += '&max_price=' + {
                {
                    $_GET['max_price']
                }
            }
            @endif
            //                console.log(url_array.length)
            //                if(url_array.length <= 2)
            //                {
            //                    url += that.serialize();
            //                }

            //                console.log(url_s)
            $.getJSON(url_s, function(response) {

                $(".nocarfound").attr('src', nocarfound);
                $('.stm-ajax-row').removeClass('stm-loading');
                $('.classic-filter-row .filter-sidebar .select2-container--default .select2-selection--single .select2-selection__arrow b').removeClass('stm-preloader');
                $('.classic-filter-row .filter-sidebar select').prop("disabled", false);
                response.make.unshift({
                    make: "all"
                })
                response.make.unshift({
                    make: ""
                })

                response.model.unshift({
                    model: "all"
                })
                vm = Object.assign(vm, response);

                data = response;
                data.base_url = base_url;
                data.selected_make = '{{ $_GET['
                search_make ']?? '
                ' }}';
                data.selected_model = '{{ $_GET['
                search_model ']?? '
                ' }}';
                data.selected_location = '{{ $_GET['
                ca_location ']?? '
                ' }}';
                data.selected_body = '{{ $_GET['
                body ']?? '
                ' }}';
                that.product.data = that.product.data.filter(function(row) {
                    return !$.isEmptyObject(row.dealer);
                });
                that.product.data.map(function(o) {
                    o.images.map(function(i) {
                        i.image = i.image.replace(/^http:/i, "https:");
                        //i.image = 'images/no-car.png';
                        return i;
                    });
                    return o;
                });



                /**/

                $(".scroll-height").niceScroll({
                    cursorcolor: "#1bc744"
                });


                $(document).ready(function() {

                    $("select[name=searchbody]").select2('destroy').select2({
                        maximumSelectionSize: 1,
                        placeholder: data.selected_body !== ' ' ? data.selected_body : "choose a body"
                    });

                    $("select[name=searchmake]").select2('destroy').select2({
                        maximumSelectionSize: 1,
                        placeholder: data.selected_make !== ' ' ? data.selected_make : "choose a make"
                    });

                    $("select[name=searchmodel]").select2('destroy').select2({
                        maximumSelectionSize: 1,
                        placeholder: data.selected_model !== ' ' ? data.selected_model : "choose a model"
                    });


                    //                        setTimeout(function(){
                    //                            $("#usedmake").val('all').trigger('change');
                    //                        },500);

                    var affix = "";
                    var stmMinValue = {{ $search_filterable['milage']['min'] }};
                    var stmMaxValue = {{ $search_filterable['milage']['max']  }};
                    stmOptions_milage = { stmOptions_milage = {
                            range: true,
                            min: {{ $search_filterable['milage']['min']  }},
                            max: {{ $search_filterable['milage']['max']  }},
                            values: [{{ $search_filterable['milage']['min']  }}, {{ $search_filterable['milage']['max']  }}],
                            step: 1,
                            slide: function (event, ui) {
                                $("#stm_filter_min_milage").val(ui.values[0]);
                                $("#stm_filter_max_milage").val(ui.values[1]);

                                console.log(stmMinValue+" - "+stmMaxValue);

                                $('.filter-milage .stm-current-slider-labels').html(stmMinValue+" - "+stmMaxValue);
                            },
                            stop:function (event, ui) {
                                data.search.miles = ui.values[0]+','+ui.values[1];
                                vm.fetchProduct();
                            }
                        };
                        
                        $(".stm-milage-range").slider(stmOptions_milage);


                        $("#stm_filter_min_milage").val($(".stm-milage-range").slider("values", 0));
                        $("#stm_filter_max_milage").val($(".stm-milage-range").slider("values", 1));

                        $("#stm_filter_min_milage").keyup(function () {
                            $(".stm-milage-range").slider("values", 0, $(this).val());
                        });

                        $("#stm_filter_min_milage").focusout(function () {
                            if ($(this).val() < stmMinValue) {
                                $(".stm-milage-range").slider("values", 0, stmMinValue);
                                $(this).val(stmMinValue);
                            }
                        });

                        $("#stm_filter_max_milage").keyup(function () {
                            $(".stm-milage-range").slider("values", 1, $(this).val());
                        });

                        $("#stm_filter_max_milage").focusout(function () {
                            if ($(this).val() > stmMaxValue) {
                                $(".stm-milage-range").slider("values", 1, stmMaxValue);
                                $(this).val(stmMaxValue);
                            }
                        });

                    /**/
                    // fiter left bar js
                    (function($) {

                        "use strict";

                        function SearchBox(form) {
                            this.form = form;
                            this.listing = $('body').hasClass('stm-template-listing');
                            this.init();
                        }
                        SearchBox.prototype.init = function() {
                            var timer, self = this;
                            $('select:not(.hide)', this.form).select2().on('change', function() {
                                if (timer) {
                                    clearTimeout(timer);
                                }
                                timer = setTimeout($.proxy(self.performAjax, self), 300);
                            });
                        };
                        SearchBox.prototype.fragments = function() {
                            return 'total' + (!this.listing ? ',options' : '');
                        };
                        SearchBox.prototype.performAjax = function() {
                            var $_form = $(this.form);
                            $.ajax({
                                url: $_form.attr('action'),
                                dataType: 'json',
                                context: this,
                                data: $_form.serialize() + '&ajax_action=listings-binding&fragments=' + this.fragments(),
                                beforeSend: $.proxy(this.beforeAjax, this),
                                success: $.proxy(this.success, this),
                                complete: $.proxy(this.complete, this)
                            });
                        };
                        SearchBox.prototype.beforeAjax = function() {
                            if (!this.listing) {
                                $('select, button[type="submit"]', this.form).prop("disabled", true);
                                $('.select2-container--default .select2-selection--single .select2-selection__arrow b', this.form).addClass('stm-preloader');
                            }
                        };
                        SearchBox.prototype.success = function(data) {
                            if (!this.listing) {
                                if (typeof data.options != 'undefined') {
                                    $.each(data.options, function(key, options) {
                                        $('select[name=' + key + '] > option', this.form).each(function() {
                                            var slug = $(this).val();
                                            if (options.hasOwnProperty(slug)) {
                                                $(this).prop('disabled', options[slug].disabled);
                                            }
                                        });
                                    });
                                }
                                $('select:not(.hide)', this.form).select2("destroy").select2();
                                if ($('body').hasClass('stm-template-motorcycle')) {
                                    $('.stm_mc-found .number-found', this.form).text(data.total);
                                }
                            } else {
                                $('button[type="submit"] span', this.form).text(data.total);
                            }
                        };
                        SearchBox.prototype.complete = function() {
                            if (!this.listing) {
                                $('.select2-container--default .select2-selection--single .select2-selection__arrow b', this.form).removeClass('stm-preloader');
                                $('select, button[type="submit"]', this.form).prop("disabled", false);
                            }
                        };
                        STMListings.SearchBox = SearchBox;
                        var stm_single_filter_link = false;
                        var stmIsotope;
                        var $container = $('.stm-isotope-sorting');
                        var stm_timeout_rental;
                        $(document).ready(function() {
                            $(document).on("click", '.stm-template-car_rental .form-row.terms a', function(event) {
                                event.preventDefault();
                            });
                            if ($('body').hasClass('stm-template-rental-daypicker-page')) {
                                $('select[name="pickup_location"]').on('change', function() {
                                    var locationId = $(this).select2("val");
                                    $.ajax({
                                        url: ajaxurl,
                                        type: "GET",
                                        dataType: 'json',
                                        context: this,
                                        data: 'rental_office_id=' + locationId + '&action=stm_ajax_rental_check_car_in_current_office',
                                        success: function(data) {
                                            $("#select-vehicle-popup").attr("href", $("#select-vehicle-popup").attr('href').split("?")[0] + "?pickup_location=" + locationId);
                                            if (data == 'EMPTY') {
                                                clearTimeout(stm_timeout_rental);
                                                $('.choose-another-class').addClass('single-add-to-compare-visible');
                                                stm_timeout_rental = setTimeout(function() {
                                                    $('.choose-another-class').removeClass('single-add-to-compare-visible');
                                                }, 5000);
                                            }
                                        }
                                    });
                                });
                            }
                            stm_ajax_add_to_compare();
                            stm_ajax_remove_from_compare();
                            stm_ajax_filter_remove_hidden();
                            stm_ajax_add_test_drive();
                            stm_ajax_get_car_price();
                            stm_ajax_add_trade_offer();
                            clearFilter();
                            stm_filter_links();
                            stm_favourites();
                            loadMoreDealerCars();
                            loadMoreDealerReviews();
                            stm_sort_listing_cars();
                            stm_modern_filter_isotope();
                            $('body').on('click', '#modern-filter-listing .stm-clear-listing-one-unit', function(e) {
                                var selectToClear = $(this).data('select');
                                if (typeof selectToClear != 'undefined') {
                                    if (selectToClear != 'price' && $('select[name=' + selectToClear + ']').length > 0) {
                                        $('select[name=' + selectToClear + ']').val('').change();
                                    } else {
                                        var $priceRange = $('#stm-' + selectToClear + '-range');
                                        if ($priceRange.length > 0) {
                                            $priceRange.slider('values', [stmOptions_price.min, stmOptions_price.max]);
                                            $("#stm_filter_min_" + selectToClear).val(stmOptions_price.min);
                                            $("#stm_filter_max_" + selectToClear).val(stmOptions_price.max);
                                        }
                                    }
                                }
                            });
                            $('body').on('click', '.stm-clear-listing-one-unit-classic', function() {
                                var selectToClear = $(this).data('select');
                                var clearLinkArg = $(this).data('url');
                                if (typeof selectToClear != 'undefined') {
                                    if (selectToClear.indexOf('[')) {
                                        window.location = clearLinkArg;
                                        return false;
                                    }
                                    if (selectToClear != 'price' && $('select[name=' + selectToClear + ']').length > 0) {
                                        window.location = clearLinkArg;
                                    } else {


                                    }
                                }
                            });
                        });

                        function stm_ajax_filter_remove_hidden() {
                            if ($('body').hasClass('stm-template-listing')) {
                                $('.filter-listing.stm-vc-ajax-filter form').each(function() {
                                    new SearchBox(this);
                                });
                            } else {
                                $('.filter.stm-vc-ajax-filter select:not(.hide)').select2().on('change', function() {
                                    var $_form = $(this).closest('form');
                                    var stmUrl = $_form.attr('action');
                                    $.ajax({
                                        url: stmUrl,
                                        dataType: 'json',
                                        context: this,
                                        data: $_form.serialize() + '&ajax_action=listings-binding',
                                        beforeSend: function() {
                                            if (!$('body').hasClass('stm-template-listing')) {
                                                $('.filter.stm-vc-ajax-filter select, .filter.stm-vc-ajax-filter button[type="submit"]').prop("disabled", true);
                                                $('.select2-container--default .select2-selection--single .select2-selection__arrow b').addClass('stm-preloader');
                                            }
                                        },
                                        success: function(data) {
                                            if (!$('body').hasClass('stm-template-listing')) {
                                                $('.select2-container--default .select2-selection--single .select2-selection__arrow b').removeClass('stm-preloader');
                                                $('.filter.stm-vc-ajax-filter select, .filter.stm-vc-ajax-filter button[type="submit"]').prop("disabled", false);
                                                if (typeof data.options != 'undefined') {
                                                    $.each(data.options, function(key, options) {
                                                        $('select[name=' + key + '] > option', $_form).each(function() {
                                                            var slug = $(this).val();
                                                            if (options.hasOwnProperty(slug)) {
                                                                $(this).prop('disabled', options[slug].disabled);
                                                            }
                                                        });
                                                    });
                                                }
                                                $('.filter.stm-vc-ajax-filter select:not(.hide)').select2("destroy");
                                                $('.filter.stm-vc-ajax-filter select:not(.hide)').select2();

                                                if ($('body').hasClass('stm-template-motorcycle')) {
                                                    $('.stm_mc-found .number-found').text(data.total);
                                                }
                                            } else {
                                                $_form.find('button[type="submit"] span').text(data.total);
                                            }
                                        }
                                    });
                                    return false;
                                });
                            }
                        }

                        function stm_ajax_add_to_compare() {
                            $(document).on('click', '.add-to-compare', function(e) {
                                e.preventDefault();
                                var dataId = $(this).attr('data-id');
                                var dataAction = $(this).attr('data-action');
                                if (typeof dataAction == 'undefined') {
                                    dataAction = 'add';
                                }
                                var stm_timeout;
                                if (typeof dataId != 'undefined') {
                                    $.ajax({
                                        url: ajaxurl,
                                        type: "POST",
                                        dataType: 'json',
                                        data: '&post_id=' + dataId + '&post_action=' + dataAction + '&action=stm_ajax_add_to_compare',
                                        context: this,
                                        beforeSend: function(data) {
                                            $(this).addClass('disabled');
                                            clearTimeout(stm_timeout);
                                        },
                                        success: function(data) {
                                            $(this).removeClass('disabled');
                                            clearTimeout(stm_timeout);
                                            $('.single-add-to-compare').addClass('single-add-to-compare-visible');
                                            if (typeof data.response != 'undefined') {
                                                $('.single-add-to-compare .stm-title').text(data.response);
                                            }
                                            if (typeof data.length != 'undefined') {
                                                $('.stm-current-cars-in-compare').text(data.length);
                                            }
                                            stm_timeout = setTimeout(function() {
                                                $('.single-add-to-compare').removeClass('single-add-to-compare-visible');
                                            }, 5000);
                                            if (data.status != 'danger') {
                                                if (dataAction == 'remove') {
                                                    $(this).removeClass('stm-added');
                                                    $(this).html('<i class="stm-icon-add"></i>' + data.add_to_text);
                                                    $(this).removeClass('hovered');
                                                    $(this).attr('data-action', 'add');
                                                } else {
                                                    $(this).addClass('stm-added');
                                                    $(this).html('<i class="stm-icon-added stm-unhover"></i><span class="stm-unhover">' + data.in_com_text + '</span><div class="stm-show-on-hover"><i class="stm-icon-remove"></i>' + data.remove_text + '</div>');
                                                    $(this).removeClass('hovered');
                                                    $(this).attr('data-action', 'remove');
                                                }
                                            }
                                        }
                                    });
                                }
                            });
                            var stm_timeout;
                            $(document).on('click', '.stm-user-public-listing .stm-listing-compare,.listing-list-loop.stm-listing-directory-list-loop .stm-listing-compare, .stm-gallery-action-unit.compare, .stm-compare-directory-new', function(e) {
                                e.preventDefault();
                                var stm_cookies = $.cookie();
                                var stm_car_compare = [];
                                var stm_car_add_to = $(this).data('id');
                                var stm_car_title = $(this).data('title');
                                for (var key in stm_cookies) {
                                    if (stm_cookies.hasOwnProperty(key)) {
                                        if (key.indexOf('compare_ids') > -1) {
                                            stm_car_compare.push(stm_cookies[key]);
                                        }
                                    }
                                }
                                var stm_compare_cars_counter = stm_car_compare.length;
                                $.cookie.raw = true;
                                if ($.inArray(stm_car_add_to.toString(), stm_car_compare) === -1) {
                                    if (stm_car_compare.length < 3) {
                                        $.cookie('compare_ids[' + stm_car_add_to + ']', stm_car_add_to, {
                                            expires: 7,
                                            path: '/'
                                        });
                                        $(this).addClass('active');
                                        stm_compare_cars_counter++;
                                        clearTimeout(stm_timeout);
                                        $('.single-add-to-compare .stm-title').text(stm_car_title + ' - ' + stm_added_to_compare_text);
                                        $('.single-add-to-compare').addClass('single-add-to-compare-visible');
                                        stm_timeout = setTimeout(function() {
                                            $('.single-add-to-compare').removeClass('single-add-to-compare-visible');
                                        }, 5000);
                                    } else {
                                        clearTimeout(stm_timeout);
                                        $('.single-add-to-compare .stm-title').text(stm_already_added_to_compare_text);
                                        $('.single-add-to-compare').addClass('single-add-to-compare-visible');
                                        stm_timeout = setTimeout(function() {
                                            $('.single-add-to-compare').removeClass('single-add-to-compare-visible');
                                            $('.single-add-to-compare').removeClass('overadded');
                                            $('.compare-remove-all').remove();
                                        }, 5000);
                                        $('.single-add-to-compare').addClass('overadded');
                                        $('.compare-remove-all').remove();
                                        $('.single-add-to-compare .compare-fixed-link').before('<a href="#" class="compare-fixed-link compare-remove-all pull-right heading-font">' + resetAllTxt + '</a>');
                                    }
                                } else {
                                    $.removeCookie('compare_ids[' + stm_car_add_to + ']', {
                                        path: '/'
                                    });
                                    $(this).removeClass('active');
                                    stm_compare_cars_counter--;
                                    clearTimeout(stm_timeout);
                                    $('.single-add-to-compare .stm-title').text(stm_car_title + ' ' + stm_removed_from_compare_text);
                                    $('.single-add-to-compare').addClass('single-add-to-compare-visible');
                                    stm_timeout = setTimeout(function() {
                                        $('.single-add-to-compare').removeClass('single-add-to-compare-visible');
                                    }, 5000);
                                    $('.single-add-to-compare').removeClass('overadded');
                                    $('.compare-remove-all').remove();
                                }
                                $('.stm-current-cars-in-compare').text(stm_compare_cars_counter);
                            });
                            $(document).on('click', '.compare-remove-all', function() {
                                var stm_cookies = $.cookie();
                                for (var key in stm_cookies) {
                                    if (stm_cookies.hasOwnProperty(key)) {
                                        if (key.indexOf('compare_ids') > -1) {
                                            $.removeCookie(key, {
                                                path: '/'
                                            });
                                        }
                                    }
                                }
                                location.reload();
                            });
                        }

                        function stm_favourites() {
                            $('body.logged-in').on('click', '.stm-listing-favorite, .stm-listing-favorite-action', function(e) {
                                e.preventDefault();
                                if ($(this).hasClass('disabled')) {
                                    return false;
                                }
                                $(this).toggleClass('active');
                                var stm_car_add_to = $(this).data('id');
                                $.ajax({
                                    url: ajaxurl,
                                    type: "POST",
                                    dataType: 'json',
                                    data: '&car_id=' + stm_car_add_to + '&action=stm_ajax_add_to_favourites',
                                    context: this,
                                    beforeSend: function(data) {
                                        $(this).addClass('disabled');
                                    },
                                    success: function(data) {
                                        if (data.count) {
                                            $('.stm-my-favourites span').text(data.count);
                                        }
                                        $(this).removeClass('disabled');
                                    }
                                });
                            });
                            $('body.stm-user-not-logged-in').on('click', '.stm-listing-favorite, .stm-listing-favorite-action', function(e) {
                                e.preventDefault();
                                $(this).toggleClass('active');
                                var stm_cookies = $.cookie();
                                var stm_car_add_to = $(this).data('id');
                                var stm_car_favourites = [];
                                if (typeof(stm_cookies['stm_car_favourites']) != 'undefined') {
                                    stm_car_favourites = stm_cookies['stm_car_favourites'].split(',');
                                    var index = stm_car_favourites.indexOf(stm_car_add_to.toString());
                                    if (index !== -1) {
                                        stm_car_favourites.splice(index, 1);
                                    } else {
                                        stm_car_favourites.push(stm_car_add_to.toString());
                                    }
                                    stm_car_favourites = stm_car_favourites.join(',');
                                    $.cookie('stm_car_favourites', stm_car_favourites, {
                                        expires: 7,
                                        path: '/'
                                    });
                                } else {
                                    $.cookie('stm_car_favourites', stm_car_add_to.toString(), {
                                        expires: 7,
                                        path: '/'
                                    });
                                }
                            });
                        }

                        function stm_ajax_remove_from_compare() {
                            $(document).on('click', '.remove-from-compare', function(e) {
                                e.preventDefault();
                                var dataId = $(this).attr('data-id');
                                var dataAction = $(this).attr('data-action');
                                if (typeof dataId != 'undefined') {
                                    $.ajax({
                                        url: ajaxurl,
                                        type: "POST",
                                        dataType: 'json',
                                        data: '&post_id=' + dataId + '&post_action=' + dataAction + '&action=stm_ajax_add_to_compare',
                                        context: this,
                                        beforeSend: function(data) {
                                            $(this).addClass('loading');
                                            if (parseFloat($('.stm-current-cars-in-compare').text()) > 0) {
                                                $('.stm-current-cars-in-compare').text(parseFloat($('.stm-current-cars-in-compare').text()) - 1);
                                            }
                                            $('.car-listing-row .compare-col-stm-' + dataId).hide('slide', {
                                                direction: 'left'
                                            }, function() {
                                                $('.car-listing-row .compare-col-stm-' + dataId).remove();
                                                $('.car-listing-row').append($('.compare-empty-car-top').html());
                                            });
                                            $('.stm-compare-row .compare-col-stm-' + dataId).hide('slide', {
                                                direction: 'left'
                                            }, function() {
                                                $('.stm-compare-row .compare-col-stm-' + dataId).remove();
                                                $('.stm-compare-row').append($('.compare-empty-car-bottom').html());
                                            });
                                            $('.row-compare-features .compare-col-stm-' + dataId).hide('slide', {
                                                direction: 'left'
                                            }, function() {
                                                $('.row-compare-features .compare-col-stm-' + dataId).remove();
                                                if ($('.row-compare-features .col-md-3').length < 2) {
                                                    $('.row-compare-features').slideUp();
                                                }
                                            });
                                        },
                                    });
                                }
                            });
                        }

                        function stm_ajax_add_test_drive() {
                            $('#test-drive form').on("submit", function(event) {
                                event.preventDefault();
                                $.ajax({
                                    url: ajaxurl,
                                    type: "POST",
                                    dataType: 'json',
                                    context: this,
                                    data: $(this).serialize() + '&action=stm_ajax_add_test_drive',
                                    beforeSend: function() {
                                        $('.alert-modal').remove();
                                        $(this).closest('form').find('input').removeClass('form-error');
                                        $(this).closest('form').find('.stm-ajax-loader').addClass('loading');
                                    },
                                    success: function(data) {
                                        $(this).closest('form').find('.stm-ajax-loader').removeClass('loading');
                                        $(this).closest('form').find('.modal-body').append('<div class="alert-modal alert alert-' + data.status + ' text-left">' + data.response + '</div>')
                                        for (var key in data.errors) {
                                            $('#request-test-drive-form input[name="' + key + '"]').addClass('form-error');
                                        }
                                    }
                                });
                                $(this).closest('form').find('.form-error').live('hover', function() {
                                    $(this).removeClass('form-error');
                                });
                            });
                        }

                        function stm_ajax_add_trade_offer() {
                            $('#trade-offer form').on("submit", function(event) {
                                event.preventDefault();
                                $.ajax({
                                    url: ajaxurl,
                                    type: "POST",
                                    dataType: 'json',
                                    context: this,
                                    data: $(this).serialize() + '&action=stm_ajax_add_trade_offer',
                                    beforeSend: function() {
                                        $('.alert-modal').remove();
                                        $(this).closest('form').find('input').removeClass('form-error');
                                        $(this).closest('form').find('.stm-ajax-loader').addClass('loading');
                                    },
                                    success: function(data) {
                                        $(this).closest('form').find('.stm-ajax-loader').removeClass('loading');
                                        $(this).closest('form').find('.modal-body').append('<div class="alert-modal alert alert-' + data.status + ' text-left">' + data.response + '</div>')
                                        for (var key in data.errors) {
                                            $('#request-trade-offer-form input[name="' + key + '"]').addClass('form-error');
                                        }
                                    }
                                });
                                $(this).closest('form').find('.form-error').live('hover', function() {
                                    $(this).removeClass('form-error');
                                });
                            });
                        }

                        function stm_ajax_get_car_price() {
                            $('#get-car-price form').on("submit", function(event) {
                                event.preventDefault();
                                $.ajax({
                                    url: ajaxurl,
                                    type: "POST",
                                    dataType: 'json',
                                    context: this,
                                    data: $(this).serialize() + '&action=stm_ajax_get_car_price',
                                    beforeSend: function() {
                                        $('.alert-modal').remove();
                                        $(this).closest('form').find('input').removeClass('form-error');
                                        $(this).closest('form').find('.stm-ajax-loader').addClass('loading');
                                    },
                                    success: function(data) {
                                        $(this).closest('form').find('.stm-ajax-loader').removeClass('loading');
                                        $(this).closest('form').find('.modal-body').append('<div class="alert-modal alert alert-' + data.status + ' text-left">' + data.response + '</div>')
                                        for (var key in data.errors) {
                                            $('#get-car-price input[name="' + key + '"]').addClass('form-error');
                                        }
                                    }
                                });
                                $(this).closest('form').find('.form-error').live('hover', function() {
                                    $(this).removeClass('form-error');
                                });
                            });
                        }

                        function clearFilter() {
                            $('.reset-all').click(function(e) {

                                    e.preventDefault();
                                    $(this).closest('.filter').find('select').trigger('reset');

                                    /*if($('.filter-price').length>0){
                                         $('.stm-price-range').slider('values',[stmOptions_price.min,stmOptions_price.max]);
                                         $("#stm_filter_min_price").val(stmOptions_price.min);$("#stm_filter_max_price").val(stmOptions_price.max);
                                         }*/

                                }

                            );
                        }

                        function stm_sort_listing_cars() {
                            if ($('#modern-filter-listing .stm-isotope-sorting').length) {
                                if (typeof imagesLoaded == 'function') {
                                    $('.stm-isotope-sorting').imagesLoaded(function() {
                                        stmIsotope = $container.isotope({
                                            itemSelector: '.stm-isotope-listing-item',
                                            layoutMode: 'fitRows',
                                            hiddenStyle: {
                                                opacity: 0
                                            },
                                            visibleStyle: {
                                                opacity: 1
                                            },
                                            transitionDuration: '0.5s',
                                            getSortData: {
                                                price: function(itemElem) {
                                                    var price = $(itemElem).data('price');
                                                    return parseFloat(price);
                                                },
                                                date: function(itemElem) {
                                                    var date = $(itemElem).data('date');
                                                    return parseFloat(date);
                                                },
                                                mileage: function(itemElem) {
                                                    var mileage = $(itemElem).data('mileage');
                                                    return parseFloat(mileage);
                                                }
                                            }
                                        });
                                    });
                                }

                                $('#modern-filter-listing .stm-select-sorting select').select2().on('change', function() {
                                    stm_isotope_sort_function($(this).select2('val'));
                                })
                            }
                        }

                        function stm_modern_filter_isotope() {
                            if ($('#modern-filter-listing').length > 0) {

                                $('body').on('click', '.modern-filter-badges ul li i', function() {
                                    var tab_reset = $(this).data('select');
                                    if (tab_reset == 'price') {

                                        /*	 $('.stm-price-range').slider('values',[stmOptions_price.min,stmOptions_price.max]);
                                        	 $("#stm_filter_min_price").val(stmOptions_price.min);

                                        	 $("#stm_filter_max_price").val(stmOptions_price.max);*/

                                        stmIso.isotope({
                                            filter: function() {
                                                var itemPrice = $(this).data('price');

                                                return parseInt(itemPrice, 10) >= stmOptions_price.min && parseInt(itemPrice, 10) <= stmOptions_price.max;
                                            }
                                        });

                                        price_string = '';

                                        $(this).closest('li').remove();
                                        var badges_length = $(".stm-filter-chosen-units-list li").length;
                                        if (badges_length < 1) $('.stm-filter-chosen-units-list').css({
                                            height: 0
                                        });

                                    } else if (typeof stmOptionsObj[tab_reset] !== 'undefined') {

                                        /*$('.stm-'+tab_reset+'-range').slider('values',[stmOptionsObj[tab_reset].min,stmOptionsObj[tab_reset].max]);
                                        $("#stm_filter_min_"+tab_reset).val(stmOptionsObj[tab_reset].min);
                                        $("#stm_filter_max_"+tab_reset).val(stmOptionsObj[tab_reset].max);*/

                                        stmIso.isotope({
                                            filter: function() {
                                                var itemPrice = $(this).data(tab_reset);
                                                return parseInt(itemPrice, 10) >= stmOptionsObj[tab_reset].min && parseInt(itemPrice, 10) <= stmOptionsObj[tab_reset].max;
                                            }
                                        });
                                        dynamic_string[tab_reset] = '';
                                        $(this).closest('li').remove();
                                        var badges_length = $(".stm-filter-chosen-units-list li").length;
                                        if (badges_length < 1) $('.stm-filter-chosen-units-list').css({
                                            height: 0
                                        });
                                    } else {
                                        $('#' + tab_reset + ' input[type=checkbox]').each(function() {
                                            if ($(this).prop('checked')) {
                                                $(this).trigger('click');
                                            }
                                        })
                                    }
                                    if (typeof stmIsotope != 'undefined') {
                                        var stmIsoData = stmIsotope.data('isotope');
                                        if (typeof stmIsoData != 'undefined') {
                                            if (typeof stmIsoData.filteredItems != 'undefined') {
                                                $('.stm-modern-filter-found-cars span').text(stmIsoData.filteredItems.length);
                                            }
                                        }
                                    }
                                });
                                var stmSortClasses = '';
                                var main_string = '';
                                var price_string = '';
                                var dynamic_string = new Object();
                                var dynamic_string_html = '';
                                var string = '';
                                var stmIso = $('.stm-isotope-sorting');
                                var stmFilterGroups = {};
                                $('#modern-filter-listing input[type=checkbox]').click(function() {
                                    var badges = {};
                                    var badges_reset = {};
                                    stmFilterGroups = {};
                                    $(window).scroll();
                                    var stmFirst = 0;
                                    stmSortClasses = '';
                                    var numberOfCats = 0;
                                    $('#modern-filter-listing input[type=checkbox]').each(function() {
                                        var stmChecked = $(this).prop('checked');
                                        var stmCurrentClass = $(this).attr('name');
                                        var stmBadgeValue = $(this).data('name');
                                        var stmBadgeId = $(this).closest('.content').attr('id');
                                        var stmFilterCurrentGroup = $(this).closest('.collapse').attr('id');
                                        if (stmChecked) {
                                            var tab = $(this).closest('.stm-accordion-single-unit').find('.title h5').text();
                                            if (typeof badges[tab] == 'undefined') {
                                                badges[tab] = [];
                                            }
                                            if (typeof badges_reset[tab] == 'undefined') {
                                                badges_reset[tab] = '';
                                            }
                                            badges[tab].push(stmBadgeValue);
                                            badges_reset[tab] = stmBadgeId;
                                            if (stmFirst == 0) {
                                                stmSortClasses += '.' + stmCurrentClass;
                                            } else {
                                                stmSortClasses += '.' + stmCurrentClass;
                                            }
                                            stmFirst++;
                                            if (typeof(stmFilterGroups[stmFilterCurrentGroup]) == 'undefined') {
                                                stmFilterGroups[stmFilterCurrentGroup] = [];
                                            }
                                            stmFilterGroups[stmFilterCurrentGroup].push(stmCurrentClass);
                                        }
                                        if (stmSortClasses == '') {
                                            stmSortClasses = '.all';
                                        }
                                    });
                                    if ($('.stm-isotope-sorting').length > 0 && stmSortClasses != '') {
                                        var matches = [];
                                        stmIso.isotope({
                                            filter: function() {
                                                matches = [];
                                                var itemPrice = $(this).data('price');
                                                var minPrice = $('#stm_filter_min_price').val();
                                                var maxPrice = $('#stm_filter_max_price').val();
                                                if (Object.keys(stmFilterGroups).length > 0) {
                                                    for (var key in stmFilterGroups) {
                                                        if (stmFilterGroups.hasOwnProperty(key)) {
                                                            for (var k = 0; k < stmFilterGroups[key].length; k++) {
                                                                var match = false;
                                                                if ($(this).hasClass(stmFilterGroups[key][k])) {
                                                                    matches[key] = true;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    var final_match = false;
                                                    if (Object.keys(matches).length == Object.keys(stmFilterGroups).length) {
                                                        if (Object.keys(matches).length > 0) {
                                                            for (var m_key in matches) {
                                                                if (matches.hasOwnProperty(m_key)) {
                                                                    if (matches[m_key]) {
                                                                        final_match = true;
                                                                    } else {
                                                                        final_match = false;
                                                                    }
                                                                }
                                                            }
                                                        } else {
                                                            final_match = false;
                                                        }
                                                    }
                                                    if (final_match) {
                                                        if (typeof minPrice != 'undefined' && typeof maxPrice != 'undefined' && typeof itemPrice != 'undefined') {
                                                            return parseInt(itemPrice, 10) >= minPrice && parseInt(itemPrice, 10) <= maxPrice;
                                                        } else {
                                                            return ($(this));
                                                        }
                                                    }
                                                } else {
                                                    return ($(this));
                                                }
                                            }
                                        })
                                    }
                                    string = '';
                                    for (var key in badges) {
                                        if (badges.hasOwnProperty(key)) {
                                            if (badges.hasOwnProperty(key)) {
                                                string += '<li><span>' + key + ':</span> ' + badges[key].join(', ');
                                                if (badges_reset.hasOwnProperty(key)) {
                                                    string += '<i class="fa fa-close stm-clear-listing-one-unit" data-select="' + badges_reset[key] + '"></i>';
                                                }
                                                string += '</li>';
                                                main_string = get_dynamic_badge_html(dynamic_string) + price_string + string;
                                                $('.modern-filter-badges ul.stm-filter-chosen-units-list').html(main_string);
                                            }
                                        }
                                    }
                                    if ($.isEmptyObject(badges)) {
                                        main_string = get_dynamic_badge_html(dynamic_string) + price_string + string;
                                        $('.modern-filter-badges ul.stm-filter-chosen-units-list').html(main_string);
                                    };
                                    var badges_length = $(".stm-filter-chosen-units-list li").length;
                                    if (badges_length > 0) {
                                        var badgesWidth = 0;
                                        var badgesMargin = 15;
                                        var badgesRowWidth = $('.stm-filter-chosen-units-list').outerWidth();
                                        $('.stm-filter-chosen-units-list li').each(function() {
                                            badgesWidth += $(this).outerWidth();
                                        });
                                        badgesWidth += badgesMargin * (badges_length - 1);
                                        var row_number = (badgesWidth / badgesRowWidth) + 1;
                                        $('.stm-filter-chosen-units-list').css({
                                            height: (parseInt(row_number) * 47) + 'px'
                                        });
                                    } else {
                                        $('.stm-filter-chosen-units-list').css({
                                            height: 0
                                        });
                                    }
                                    if (typeof stmIsotope != 'undefined') {
                                        var stmIsoData = stmIsotope.data('isotope');
                                        if (typeof stmIsoData != 'undefined') {
                                            if (typeof stmIsoData.filteredItems != 'undefined') {
                                                $('.stm-modern-filter-found-cars span').text(stmIsoData.filteredItems.length);
                                            }
                                        }
                                    }
                                });


                                $(".stm-modern-dynamic-slider").each(function() {
                                    var sliderIdent = $(this).data("slider-name");
                                    $(".stm-" + sliderIdent + "-range").on('slide', function(event, ui) {
                                        var minMileage = ui.values[0];
                                        var maxMileage = ui.values[1];
                                        stmIso.isotope({
                                            filter: function() {
                                                var matches = [];
                                                var itemMileage = $(this).data(sliderIdent);
                                                if (Object.keys(stmFilterGroups).length > 0) {
                                                    for (var key in stmFilterGroups) {
                                                        if (stmFilterGroups.hasOwnProperty(key)) {
                                                            for (var k = 0; k < stmFilterGroups[key].length; k++) {
                                                                var match = false;
                                                                if ($(this).hasClass(stmFilterGroups[key][k])) {
                                                                    matches[key] = true;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    var final_match = false;
                                                    if (Object.keys(matches).length == Object.keys(stmFilterGroups).length) {
                                                        if (Object.keys(matches).length > 0) {
                                                            for (var m_key in matches) {
                                                                if (matches.hasOwnProperty(m_key)) {
                                                                    if (matches[m_key]) {
                                                                        final_match = true;
                                                                    } else {
                                                                        final_match = false;
                                                                    }
                                                                }
                                                            }
                                                        } else {
                                                            final_match = false;
                                                        }
                                                    }
                                                    if (final_match) {
                                                        if (typeof minMileage != 'undefined' && typeof maxMileage != 'undefined' && typeof itemMileage != 'undefined') {
                                                            return parseInt(itemMileage, 10) >= minMileage && parseInt(itemMileage, 10) <= maxMileage;
                                                        } else {
                                                            return parseInt(itemMileage, 10) >= minMileage && parseInt(itemMileage, 10) <= maxMileage;
                                                        }
                                                    }
                                                } else {
                                                    return parseInt(itemMileage, 10) >= minMileage && parseInt(itemMileage, 10) <= maxMileage;
                                                }
                                            }
                                        });
                                        if (typeof stmIsotope != 'undefined') {
                                            var stmIsoData = stmIsotope.data('isotope');
                                            if (typeof stmIsoData != 'undefined') {
                                                if (typeof stmIsoData.filteredItems != 'undefined') {
                                                    $('.stm-modern-filter-found-cars span').text(stmIsoData.filteredItems.length);
                                                }
                                            }
                                        }
                                        dynamic_string_html = '<li><span>' + sliderIdent + ':</span> ' + minMileage + ' - ' + maxMileage;
                                        dynamic_string_html += '<i class="fa fa-close stm-clear-listing-one-unit" data-select="' + sliderIdent + '"></i></li>';
                                        dynamic_string[sliderIdent] = dynamic_string_html;
                                        main_string = get_dynamic_badge_html(dynamic_string) + price_string + string;
                                        $('.modern-filter-badges ul.stm-filter-chosen-units-list').html(main_string);
                                        $('.stm-filter-chosen-units-list').height('47');
                                    });
                                });
                            }
                        }

                        function get_dynamic_badge_html(dynamic_string) {
                            var dynamic_string_html = '';
                            $.each(dynamic_string, function(key, event) {
                                dynamic_string_html += event;
                            });
                            return dynamic_string_html;
                        }

                        function stm_filter_links() {
                            $('body').on('click', '.stm-single-filter-link', function() {
                                stm_single_filter_link = true;
                                var stm_name = $(this).data('slug');
                                var stm_value = $(this).data('value');
                                if (typeof stm_name !== 'undefined' && typeof stm_value !== 'undefined') {
                                    $('.reset-all').trigger('click');
                                    $('#stm-filter-links-input').attr('name', stm_name);
                                    $('#stm-filter-links-input').val(stm_value);
                                }
                            })
                        }
                        STMListings.save_user_settings = function() {
                            $('#stm_user_settings_edit.stm_save_user_settings_ajax').submit(function(e) {
                                var formData = new FormData();
                                formData.append('stm-avatar', $('input[name="stm-avatar"]')[0].files[0]);
                                var formInputs = $(this).serializeArray();
                                for (var key in formInputs) {
                                    if (formInputs.hasOwnProperty(key)) {
                                        formData.append(formInputs[key]['name'], formInputs[key]['value']);
                                    }
                                }
                                formData.append('action', 'stm_listings_ajax_save_user_data');
                                e.preventDefault();
                                $.ajax({
                                    type: "POST",
                                    url: ajaxurl,
                                    dataType: 'json',
                                    context: this,
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    beforeSend: function() {
                                        $('.stm-user-message').empty();
                                        $(this).find('.stm-listing-loader').addClass('visible');
                                    },
                                    success: STMListings.save_user_settings_success
                                });
                            })
                        };
                        STMListings.save_user_settings_success = function(data) {
                            $(this).find('.stm-listing-loader').removeClass('visible');
                            $('.stm-user-message').text(data.error_msg);
                            $('.stm-image-avatar img, .stm-dropdown-user-small-avatar img').attr('src', data.new_avatar);
                            if (data.new_avatar === '') {
                                $('.stm-image-avatar').removeClass('hide-empty').addClass('hide-photo');
                            } else {
                                $('.stm-image-avatar').addClass('hide-empty').removeClass('hide-photo');
                            }
                        };
                        STMListings.stm_logout = function() {
                            $('body').on('click', '.stm_logout a', function(e) {
                                e.preventDefault();
                                $.ajax({
                                    url: ajaxurl,
                                    type: "POST",
                                    dataType: 'json',
                                    context: this,
                                    data: {
                                        'action': 'stm_logout_user'
                                    },
                                    beforeSend: function() {
                                        $('.stm_add_car_form .stm-form-checking-user .stm-form-inner').addClass('activated');
                                    },
                                    success: function(data) {
                                        if (data.exit) {
                                            $('#stm_user_info').slideUp('fast', function() {
                                                $(this).empty();
                                                $('.stm-not-enabled, .stm-not-disabled').slideDown('fast');
                                                $("html, body").animate({
                                                    scrollTop: $('.stm-form-checking-user').offset().top
                                                }, "slow");
                                            });
                                            $('.stm-form-checking-user button[type="submit"]').removeClass('enabled').addClass('disabled');
                                        }
                                        $('.stm_add_car_form .stm-form-checking-user .stm-form-inner').removeClass('activated');
                                    }
                                });
                            })
                        };
                        STMListings.stm_ajax_login = function() {
                            $('.lOffer-account-unit').mouseout(function() {
                                $('.stm-login-form-unregistered').removeClass('working');
                            });
                            $('.stm-forgot-password a').click(function(e) {
                                e.preventDefault();
                                $('.stm_forgot_password_send').slideToggle();
                                $('.stm_forgot_password_send input[type=text]').focus();
                                $(this).toggleClass('active');
                            })
                            $(".stm-login-form-mobile-unregistered form,.stm-login-form form:not(.stm_password_recovery), .stm-login-form-unregistered form").submit(function(e) {
                                e.preventDefault();
                                if (!$(this).hasClass('stm_forgot_password_send')) {
                                    $.ajax({
                                        type: "POST",
                                        url: ajaxurl,
                                        dataType: 'json',
                                        context: this,
                                        data: $(this).serialize() + '&action=stm_custom_login',
                                        beforeSend: function() {
                                            $(this).find('input').removeClass('form-error');
                                            $(this).find('.stm-listing-loader').addClass('visible');
                                            $('.stm-validation-message').empty();
                                            if ($(this).parent('.lOffer-account-unit').length > 0) {
                                                $('.stm-login-form-unregistered').addClass('working');
                                            }
                                        },
                                        success: function(data) {
                                            if ($(this).parent('.lOffer-account-unit').length > 0) {
                                                $('.stm-login-form-unregistered').addClass('working');
                                            }
                                            if (data.user_html) {
                                                var $user_html = $(data.user_html).appendTo('#stm_user_info');
                                                $('.stm-not-disabled, .stm-not-enabled').slideUp('fast', function() {
                                                    $('#stm_user_info').slideDown('fast');
                                                });
                                                $("html, body").animate({
                                                    scrollTop: $('.stm-form-checking-user').offset().top
                                                }, "slow");
                                                $('.stm-add-a-car-login-overlay,.stm-add-a-car-login').toggleClass('visiblity');
                                                $('.stm-form-checking-user button[type="submit"]').removeClass('disabled').addClass('enabled');
                                            }
                                            $(this).find('.stm-listing-loader').removeClass('visible');
                                            for (var err in data.errors) {
                                                $(this).find('input[name=' + err + ']').addClass('form-error');
                                            }
                                            if (data.message) {
                                                var message = $('<div class="stm-message-ajax-validation heading-font">' + data.message + '</div>').hide();
                                                $(this).find('.stm-validation-message').append(message);
                                                message.slideDown('fast');
                                            }
                                            if (typeof(data.redirect_url) !== 'undefined') {
                                                window.location = data.redirect_url;
                                            }
                                        }
                                    });
                                } else {
                                    $.ajax({
                                        type: "POST",
                                        url: ajaxurl,
                                        dataType: 'json',
                                        context: this,
                                        data: $(this).serialize() + '&action=stm_restore_password',
                                        beforeSend: function() {
                                            $(this).find('input').removeClass('form-error');
                                            $(this).find('.stm-listing-loader').addClass('visible');
                                            $('.stm-validation-message').empty();
                                        },
                                        success: function(data) {
                                            $(this).find('.stm-listing-loader').removeClass('visible');
                                            if (data.message) {
                                                var message = $('<div class="stm-message-ajax-validation heading-font">' + data.message + '</div>').hide();
                                                $(this).find('.stm-validation-message').append(message);
                                                message.slideDown('fast');
                                            }
                                            for (var err in data.errors) {
                                                $(this).find('input[name=' + err + ']').addClass('form-error');
                                            }
                                        }
                                    });
                                }
                            });
                            $('.user_validated_field').hover(function() {
                                $(this).removeClass('form-error');
                            });
                            $('input[name="stm_accept_terms"]').on('click', function() {
                                if ($(this).is(':checked')) {
                                    $('.stm-login-register-form .stm-register-form form input[type="submit"]').removeAttr('disabled');
                                } else {
                                    $('.stm-login-register-form .stm-register-form form input[type="submit"]').attr('disabled', '1');
                                }
                            });
                        };

                        function loadMoreDealerCars() {
                            $('body').on('click', '.stm-load-more-dealer-cars a', function(e) {
                                e.preventDefault();
                                if ($(this).closest('.stm-load-more-dealer-cars').hasClass('not-clickable')) {
                                    return false;
                                }
                                var offset = $(this).attr('data-offset');
                                var user_id = $(this).data('user');
                                var popular = $(this).data('popular');
                                var view_type = $('#stm_dealer_view_type').val();
                                $.ajax({
                                    url: ajaxurl,
                                    data: {
                                        action: 'stm_ajax_dealer_load_cars',
                                        offset: offset,
                                        user_id: user_id,
                                        popular: popular,
                                        view_type: view_type
                                    },
                                    method: 'POST',
                                    dataType: 'json',
                                    context: this,
                                    beforeSend: function() {
                                        $(this).closest('.stm-load-more-dealer-cars').addClass('not-clickable');
                                    },
                                    success: function(data) {
                                        $(this).closest('.stm-load-more-dealer-cars').removeClass('not-clickable');
                                        if (data.html) {
                                            $(this).closest('.tab-pane').find('.car-listing-row').append(data.html);
                                        }
                                        if (data.new_offset) {
                                            $(this).attr('data-offset', data.new_offset);
                                        }
                                        if (data.button == 'hide') {
                                            $(this).closest('.stm-load-more-dealer-cars').slideUp();
                                            $(this).closest('.tab-pane').find('.row-no-border-last').removeClass('row-no-border-last');
                                        }
                                        $('img.lazy').lazyload({
                                            effect: "fadeIn",
                                            failure_limit: Math.max('img'.length - 1, 0)
                                        });
                                    }
                                });
                            })
                        }

                        function loadMoreDealerReviews() {
                            $('body').on('click', '.stm-load-more-dealer-reviews a', function(e) {
                                e.preventDefault();
                                if ($(this).closest('.stm-load-more-dealer-reviews').hasClass('not-clickable')) {
                                    return false;
                                }
                                var offset = $(this).attr('data-offset');
                                var user_id = $(this).data('user');
                                $.ajax({
                                    url: ajaxurl,
                                    data: {
                                        action: 'stm_ajax_dealer_load_reviews',
                                        offset: offset,
                                        user_id: user_id,
                                    },
                                    method: 'POST',
                                    dataType: 'json',
                                    context: this,
                                    beforeSend: function() {
                                        $(this).closest('.stm-load-more-dealer-reviews').addClass('not-clickable');
                                    },
                                    success: function(data) {
                                        $(this).closest('.stm-load-more-dealer-reviews').removeClass('not-clickable');
                                        if (data.html) {
                                            $(this).closest('.tab-pane').find('#stm-dealer-reviews-units').append(data.html);
                                        }
                                        if (data.new_offset) {
                                            $(this).attr('data-offset', data.new_offset);
                                        }
                                        if (data.button == 'hide') {
                                            $(this).closest('.stm-load-more-dealer-reviews').slideUp();
                                        }
                                    }
                                });
                            })
                        }
                        $('#stm_submit_review .button').on('click', function(e) {
                            e.preventDefault();
                            if (!$(this).hasClass('disabled')) {
                                $.ajax({
                                    url: ajaxurl,
                                    dataType: 'json',
                                    context: this,
                                    data: $(this).closest('form').serialize() + '&action=stm_submit_review',
                                    beforeSend: function() {
                                        $(this).closest('form').find('.stm-icon-load1').addClass('activated');
                                        $('#write-review-message ').slideUp();
                                    },
                                    success: function(data) {
                                        $(this).closest('form').find('.stm-icon-load1').removeClass('activated');
                                        if (data.message) {
                                            $('#write-review-message ').text(data.message).slideDown();
                                        }
                                        if (data.updated) {
                                            window.location.href = data.updated;
                                            location.reload();
                                        }
                                    }
                                });
                            }
                        })
                        $('.stm-comment-dealer-wrapper .stm-bottom .stm-report-review a').click(function(e) {
                            e.preventDefault();
                            if (!$(this).hasClass('reported')) {
                                var stmID = $(this).data('id');
                                $.ajax({
                                    type: "POST",
                                    url: ajaxurl,
                                    dataType: 'json',
                                    context: this,
                                    data: {
                                        'id': stmID,
                                        'action': 'stm_report_review'
                                    },
                                    beforeSend: function() {
                                        $(this).addClass('reported');
                                    },
                                    success: function(data) {
                                        if (data.message) {
                                            $(this).text(data.message);
                                        }
                                    }
                                });
                            }
                        });
                        $('.dealer-search-title select').on('change', function() {
                            $('input[name="stm_sort_by"]').val($(this).val());
                            $("#stm_all_listing_tab").find("form").submit();
                        });
                        $('.stm-load-more-dealers').click(function(e) {
                            e.preventDefault();
                            if ($(this).hasClass('not-clickable')) {
                                return false;
                            }
                            var offset = $(this).attr('data-offset');
                            $.ajax({
                                url: currentAjaxUrl,
                                dataType: 'json',
                                context: this,
                                data: $('.stm_dynamic_listing_dealer_filter form').serialize() + '&offset=' + offset + '&ajax_action=stm_load_dealers_list',
                                beforeSend: function() {
                                    $(this).addClass('not-clickable');
                                },
                                success: function(data) {
                                    $(this).removeClass('not-clickable');
                                    if (data.user_html) {
                                        $('.dealer-search-results table tbody').append(data.user_html);
                                    }
                                    if (data.new_offset) {
                                        $('.stm-load-more-dealers').attr('data-offset', data.new_offset);
                                    }
                                    if (data.remove && data.remove === 'hide') {
                                        $(this).remove();
                                    }
                                }
                            });
                        });
                        $('.stm-show-number').on("click", function() {
                            var parent = $(this).parent();
                            var phone_owner_id = $(this).attr("data-id");
                            $.ajax({
                                url: ajaxurl,
                                type: "GET",
                                dataType: 'json',
                                context: this,
                                data: 'phone_owner_id=' + phone_owner_id + '&action=stm_ajax_get_seller_phone',
                                success: function(data) {
                                    parent.find(".stm-show-number").hide();
                                    parent.find(".phone").html('<a href="tel:' + data + '">' + data + '</a>');
                                }
                            });
                        });
                    })(jQuery)
                    /**/
                })



                $(document).ready(function() {

                    render_price({
                        {
                            $search_filterable['price']['min']
                        }
                    }, {
                        {
                            !empty($_GET['max_price']) ? $_GET['max_price'] : $search_filterable['price']['max']
                        }
                    })

                    $(document).on('change', 'input[name="transmission[]"]', function() {
                        let selected = [];
                        $('input[name="transmission[]"]:checked').each(function() {
                            selected.push($(this).val())
                        });
                        data.search.transmission = selected.join(',');
                        vm.fetchProduct();
                    })

                    $(document).on('change', 'input[name="transmission_speed[]"]', function() {
                        let selected = [];
                        $('input[name="transmission_speed[]"]:checked').each(function() {
                            selected.push($(this).val())
                        });
                        data.search.transmission_speed = selected.join(',');
                        vm.fetchProduct();
                    })



                    $(document).on('change', 'input[name="fule[]"]', function() {
                        let selected = [];
                        $('input[name="fule[]"]:checked').each(function() {
                            selected.push($(this).val())
                        });
                        data.search.fuel_type = selected.join(',');
                        vm.fetchProduct();
                    })

                    $(document).on('change', 'input[name="certified[]"]', function() {
                        let selected = [];
                        $('input[name="certified[]"]:checked').each(function() {
                            selected.push($(this).val())
                        });
                        data.search.certified = selected.join(',');
                        vm.fetchProduct();
                    })

                    $(document).on('change', 'input[name="passengercapacity[]"]', function() {
                        let selected = [];
                        $('input[name="passengercapacity[]"]:checked').each(function() {
                            selected.push($(this).val())
                        });
                        data.search.passengercapacity = selected.join(',');
                        vm.fetchProduct();
                    })

                    $(document).on('change', 'input[name="year[]"]', function() {
                        let selected = [];
                        $('input[name="year[]"]:checked').each(function() {
                            selected.push($(this).val())
                        });
                        data.search.year = selected.join(',');
                        vm.fetchProduct();
                    })

                    $(document).on('change', 'input[name="drivetrain[]"]', function() {
                        let selected = [];
                        $('input[name="drivetrain[]"]:checked').each(function() {
                            selected.push($(this).val())
                        });
                        data.search.drivetrain = selected.join(',');
                        vm.fetchProduct();
                    })

                    $(document).on('change', 'input[name="extcolor[]"]', function() {
                        let selected = [];
                        $('input[name="extcolor[]"]:checked').each(function() {
                            selected.push($(this).val())
                        });
                        data.search.extcolorhexcode = selected.join(',');
                        vm.fetchProduct();
                    })

                    $(document).on('change', 'input[name="intcolor[]"]', function() {
                        let selected = [];
                        $('input[name="intcolor[]"]:checked').each(function() {
                            selected.push($(this).val())
                        });
                        data.search.interiorcolor = selected.join(',');
                        vm.fetchProduct();
                    })

                    $(document).on('change', 'select[name="sortBy"]', function() {
                        data.search.sortBy = $(this).val();
                        vm.fetchProduct();
                    })

                    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {

                        let field = $(this).data('type');
                        let value = $(this).data('value');

                        switch (field) {
                            case 'type':
                                data.search.search_type = value
                                break;

                        }

                    })



                    $("select").change(function(e) {
                        switch ($(this).data('change')) {
                            case 'searchmodel':
                                searchmodel(this);
                                break;
                            case 'searchmake':
                                searchmake(this);
                                break;
                            case 'searchbody':
                                searchbody(this);
                                break;
                            case 'searchdistance':
                                searchdistance(this);
                                break;
                        }
                    })

                    $('input[name="searchzip"]').blur(function() {
                        searchzip(this);
                    });

                    // $(".listing-list-loop a").click(function(e){
                    //     e.preventDefault();
                    //     let id = $(this).data('id')
                    //   if(id)
                    //     window.location.href = '{{ url("/") }}'+'/'+id+'/details';

                    // })

                });





                /*jQuery(document).ready(function($){
                        var data=[];
                        data={!! json_encode($search_filterable['makes_model']) !!};

                        console.log(data);

                        $("select[id$='make']").change(function(e){

                            var prefix = (this.id ==='usedmake')?'used':'new';

                            var make = this.value;

                            model=models(data,make);
                            if(make =='0' || make == '')
                            {
                                select=$('#'+prefix+'model');

                                for (var k=0;k<vm.model.length;k++) {
                                    select.append('<option value="' + vm.model[k].model + '">' + vm.model[k].model || "All Models"  + '</option>')
                                }
                            } else {
                                select=$('#'+prefix+'model');

                                select.html('<option value="">All Models</option>');
                                for (k in model) {
                                    select.append('<option value="' + model[k] + '">' + model[k] + '</option>')
                                }
                            }
                        });

                        $("select[id$='model']").change(function(e){
                            var prefix = (this.id==='usedmodel')?'used':'new';
                            var model = this.value;
                            if(model!=='0'){
                                make =data[model];

                                console.log(make)
                                select=$('#'+prefix+'make')
//                                .html('<option value="'+make+'">'+make+'</option>')
                                select.find('option:selected').removeAttr("selected");
                                $('#'+prefix+'make'+' option[value="'+make+'"]').attr('selected', 'selected');
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

                    }) ;*/
            })
        },

        app_base_url(row) {
            if ($.isEmptyObject(row.dealer))
                return this.base_url;
            dealername = row.dealer['dealer_slug'].value === null ? 'car-dealer-solution' : row.dealer['dealer_slug'];

            return this.base_url + '/car/' + this.convertToSlug(row['make'], "make") + '/' + this.convertToSlug(row['model'], "model") + '/' + this.convertToSlug(row.dealer['city'], "city") + '/' + (dealername) + '/' + row.vin;

        },
        noimage() {
            return data.base_url + "/" + 'images/no-car.png';
        },
        convertToSlug(value, type) {
            if (!value || (value === undefined) || (value === "") || (value.length === 0)) {
                return 'car-dealer-' + type;
            }

            return value
                .toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
        },
        loadmoreproducts(e) {
            //console.log(this.product.next_page_url)
            let that = this;
            let oldtext = $(e.target).text();
            $(e.target).text("Loading...")
            console.log(this.product.next_page_url + "&" + this.serialize())
            $.getJSON(this.product.next_page_url + "&" + this.serialize(), function(response) {

                for (var field in response.product) {
                    if (field == 'data') {
                        if (that.product['data'].length) {
                            response.product.data = response.product.data.filter(function(row) {
                                return !$.isEmptyObject(row.dealer);
                            });
                            response.product.data.map(function(o) {
                                o.images.map(function(i) {
                                    i.image = i.image.replace(/^http:/i, "https:");
                                    //i.image = 'images/no-car.png';
                                    return i;
                                });
                                return o;
                            });

                            that.product['data'] = that.product['data'].concat(response.product.data);

                        }
                    } else {
                        if (field !== 'total')
                            that.product[field] = response.product[field];
                    }
                }
                if (that.product['data'].length == 0) {
                    $(e.target).text("No More Results");
                    return;
                }
                $(e.target).text(oldtext);
            })
        }

        ,
        searchmodel(ele) {
            console.log(ele)
        },

        searchmake() {
            console.log("ok")
        },
        searchbody(ele) {
            console.log(ele)
        },

        searchdistance(ele) {
            console.log(ele)
        },

        searchzip(ele) {
            console.log(ele)
        },

        price_change(price_min, price_max) {
            // console.log(price_min,price_max);
            // this.search.price_min = price_min;
            // this.search.price_max = price_max;
        },

        serialize() {
            var str = [];
            var obj = Object.assign({}, this.search);
            for (var p in obj)

                if (obj.hasOwnProperty(p)) {
                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                }
            return str.join("&");
        },

        fetchProduct() {
            let that = this;
            let nocarfound = base_url + '/images/car_not_found.png';
            $(".nocarfound").attr('src', base_url + '/images/CARloader.gif');

            $('.stm-ajax-row').addClass('stm-loading');
            $('.classic-filter-row .filter-sidebar .select2-container--default .select2-selection--single .select2-selection__arrow b').addClass('stm-preloader');

            $.getJSON('{{  url()->current() }}' + "?" + this.serialize(), function(response) {
                $(".nocarfound").attr('src', nocarfound);
                that.product = response.product;
                $('.stm-ajax-row').removeClass('stm-loading');
                $('.classic-filter-row .filter-sidebar .select2-container--default .select2-selection--single .select2-selection__arrow b').removeClass('stm-preloader');
                $('.classic-filter-row .filter-sidebar select').prop("disabled", false);

                that.selected_location = formatted_address;
            })


        }
    }
})

$(document).ready(function() {
    $(".cd-nav-trigger").click(function() {
        $('.sm-stm-ajax-row').toggle();
    });

    $(document).on('change', ".custom-checkbox", function() {
        $(this).parent().toggleClass('checked');
    });

});

$(document).ready(function() {

    $(".cd-nav-trigger").click(function() {
        $('#footer').toggle();
    });



    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        let search_type = $(e.target).data('type');
        let value = $(e.target).data('value');

        if (search_type)
            vm.search[search_type] = value;

    })



});

function searchmodel(ele) {
    data.search.search_model = $(ele).val();
    data.selected_model = $(ele).val();
    if (data.search.search_model === 'all') {
        data.search.search_model = '';
        data.selected_model = '';
    }

    data.search.search_body = '';
    data.search.body = '';
}

function searchmake(ele) {

    let l = $(ele).val();
    if (l == 'all') {
        l = '';
    }
    data.search.search_make = l;
    data.selected_make = l;
    data.search.search_model = '';
    data.selected_model = '';
    data.search.search_body = '';
    data.search.body = '';

    $("select[name=searchmodel]").select2('destroy').select2({
        maximumSelectionSize: 1,
        placeholder: "choose a model"
    });

    $.ajax({
        type: 'POST',
        url: '{{route('
        getmodel ')}}',
        data: {
            "_token": "{{ csrf_token() }}",
            "make": l,
        },
        beforeSend: function() {

            vm.model = [];
            vm.$forceUpdate();
        },
        success: function(mdl) {
            mdl.unshift({
                model: 'all'
            });
            mdl.unshift({
                model: ''
            });
            vm.model = mdl;
            vm.$forceUpdate();
            //                                data.search.search_model = data.model[0].model;
        },
        error: function() {
            data.search.search_model = '';
        }
    });


}

function searchbody(ele) {
    data.search.body = $(ele).val();
    vm.selected_body = data.search.body;
}

function searchdistance(ele) {
    data.search.search_distance = $(ele).val();
}

function searchzip(ele) {
    data.search.search_zip = $(ele).val();
}

function search() {
    let e = $("#exTab1 li.active").find('a[data-toggle="tab"]');
    let e2 = $("#exTab2 li.active").find('a[data-toggle="tab"]');

    if (e2.attr('id') == 'bycarused') {
        vm.search.body = '';
        vm.search.search_make = data.selected_make;
        vm.search.search_model = data.selected_model;
        //$("select[name=searchbody]").val('').trigger('change');
    } else if (e2.attr('id') == 'bybodyused') {
        vm.search.make = '';
        vm.search.model = '';
        vm.search.body = vm.selected_body;
        //                            vm.search.stm_lat = '';
        //                            vm.search.stm_lng = '';
        //vm.search.body = vm.selected_body;
        //stm_lat=43.9785759&stm_lng=-90.5040214
    }

    if (($("#stm-car-location-stm_all_listing_tab").val() == '') && (window.localStorage.getItem('latitude') === null) && (window.localStorage.getItem('longitude') === null)) {
        vm.search.stm_lat = '';
        vm.search.stm_lng = '';
        formatted_address = '';
    }

    let search_type = e.data('type');
    let value = e.data('value');

    if (search_type) {
        vm.search[search_type] = value;
        vm.search["search_type"] = value;
    }




    vm.fetchProduct();
}


function render_price(min, max) {function render_price(min,max){
                        var affix = "";
                        var stmMinValue = min;
                        var stmMaxValue = max;
                        stmOptions_price = {
                            range: true,
                            min: min,
                            max: max,
                            values: [min, max],
                            step: 1,
                            slide: function (event, ui) {
                                $("#stm_filter_min_price").val(ui.values[0]);
                                $("#stm_filter_max_price").val(ui.values[1]);

                               /* var stmText = stm_get_price_view(ui.values[0], stmCurrency, stmCurrencyPos, stmPriceDel ) + ' - ' + stm_get_price_view(ui.values[1], stmCurrency, stmCurrencyPos, stmPriceDel );

                                $('.filter-price .stm-current-slider-labels').html(stmText);*/
                            },
                            stop:function (event, ui) {


                                    $("#stm_filter_min_price").val(ui.values[0]);
                                    $("#stm_filter_max_price").val(ui.values[1]);


                                data.search.sellingprice = ui.values[0]+','+ui.values[1];
                                console.log(ui.values[0]+','+ui.values[1]);
                                vm.fetchProduct();
                            }
                        };
                        $(".stm-price-range").slider(stmOptions_price);


                        $("#stm_filter_min_price").val($(".stm-price-range").slider("values", 0));
                        $("#stm_filter_max_price").val($(".stm-price-range").slider("values", 1));

                        $("#stm_filter_min_price").keyup(function () {
                            $(".stm-price-range").slider("values", 0, $(this).val());
                        });

                        $("#stm_filter_min_price").focusout(function () {
                            if ($(this).val() < stmMinValue) {
                                $(".stm-price-range").slider("values", 0, stmMinValue);
                                $(this).val(stmMinValue);
                            }
                        });

                        $("#stm_filter_max_price").keyup(function () {
                            $(".stm-price-range").slider("values", 1, $(this).val());
                        });

                        $("#stm_filter_max_price").focusout(function () {
                            if ($(this).val() > stmMaxValue) {
                                $(".stm-price-range").slider("values", 1, stmMaxValue);
                                $(this).val(stmMaxValue);
                            }
                        });
                    }
jQuery(document).ready(function($) {
    $("#bycarused").click(function($) {
        data.search.body = '';
    });

    $("#bybodyused").click(function($) {
        data.search.search_make = '';
        data.search.search_model = '';
        data.search.body = vm.selected_body;
    });
    $("input[name='stm_lng']").val(pos ? pos.lng : '');
    $("input[name='stm_lat']").val(pos ? pos.lat : '');
});
                

</script>
@endpush


