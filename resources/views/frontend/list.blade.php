@extends('layouts1.master')
@section('content')
@if($id!==null)
@section('title',"Find Cars for Sale and Reviews | New and Used Cars For Sale from {$search_filterable['product']['dealer']->name} | {$search_filterable['product']['dealer']->city}, {$search_filterable['product']['dealer']->state}, {$search_filterable['product']['dealer']->zip}")
@section('description',"Search cars for sale from {$search_filterable['product']['dealer']->name}, at {$search_filterable['product']['dealer']->city}, {$search_filterable['product']['dealer']->state}, {$search_filterable['product']['dealer']->zip} on CarDesta. Browse popular models for sale, find a car by make, model, features, mileage, certifications and get advice on your car shopping journey.")
@if(!empty($search_filterable['product']['dealer']->ga_tag))
@section('googleanalytics')
<script async src="https://www.googletagmanager.com/gtag/js?id={{$search_filterable['product']['dealer']->ga_tag}}"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag() {
dataLayer.push(arguments);
}
gtag('js', new Date());

gtag('config', '{{$search_filterable['product']['dealer']->ga_tag}}');
</script>
@endsection
@endif
@else
@section('title',"Search for New and Used Cars for Sale")
@section('description','Search cars for sale at CarDesta.com. Browse popular models for sale in your area or in proximity, find a car by make, model, features, mileage, certifications and get advice on your car shopping journey.')
@endif
<?php 
use \App\Http\Controllers\Frontend\InventoryController;
?>
<div class="hide" style="display:none">
    @foreach ($list['product']['data'] as $row)
    <a href="{{ route('list_details',['dealername' => $row->dealer->dealer_slug ?? 'car-dealer-solution','city' => $row->dealer->city ?? '','vin' => $row->vin,'make'=>$row->make,'model'=>$row->model]) }}"  class="rmv_txt_drctn">
        <div class="labels">{{ $row->type}} {{ $row->year }}</div> {{ $row->make }} {{ $row->model }}
    </a>
    {{ $pagination }}
    @endforeach
</div>
<div id="app">
    <section class="section gray-lght-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 mt-4">
                    <h3 class="text-gray">Used Cars for Sale in Colorado Springs, CO</h3>
                </div>
            </div>
        </div>
    </section>
    <section class="section gray-lght-bg page-section-pb">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0 desktop classic-filter-row sidebar-sm-mg-bt sm-head-mar sm-pad-zero">
                    <div class="cd-main-content">
                        <!-- search-widget -->
                        <form action="" method="get" data-trigger="filter">
                            <div class="left-sidebar search-widget white-bg">
                                <div class="media">
                                    <div class="media-icon">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="mt-0 text-uppercase text-blue">Search Car</h4>
                                        Search your desire car
                                    </div>
                                </div>
                                <div class="search-tabs">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#search-used" role="tab" aria-controls="pills-home" aria-selected="true" data-type="type" data-value="Used">Search Used</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#search-used" role="tab" aria-controls="pills-profile" aria-selected="false" data-type="type" data-value="New">Search New</a>
                                        </li>
                                    </ul>

                                    <!-- Search Used -->

                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="search-used" role="tabpanel" aria-labelledby="pills-home-tab">

                                            <!-- car-ditele -->

                                            <div class="second-tab">
                                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="pills-home-tab bycarused" data-toggle="pill" href="#bycar" role="tab" aria-controls="pills-home" aria-selected="true">By Car</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="pills-profile-tab bybodyused" data-toggle="pill" href="#bybody" role="tab" aria-controls="pills-profile" aria-selected="false">By Body Style</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#byprice" role="tab" aria-controls="pills-contact" aria-selected="false">By Price</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="pills-tabContent">

                                                    <!-- By Car -->

                                                    <div class="tab-pane fade show active" id="bycar" role="tabpanel" aria-labelledby="pills-home-tab">
                                                        <div class="">

                                                            <div class="form-group">
                                                                <select class="form-control" id="FormControlSelect1" name="searchmake" data-change="searchmake" id="usedmake">
                                                                    <option v-for="searchmake in searchMakeOptions" :value="searchmake.make">@{{ searchmake.make == 'all' ?  'All Makes' : searchmake.make  }}</option>
                                                                </select>
                                                                <span class="dropdown-wrapper" aria-hidden="true"></span>
                                                            </div>
                                                            <div class="form-group">
                                                                <select class="form-control select2-hidden-accessible" id="FormControlSelect2" name="searchmodel" data-change="searchmodel" id="usedmodel">
                                                                    <option v-for="searchmodel in model" :value="searchmodel.model">
                                                                        @{{ searchmodel.model == 'all' ? 'All Models' : searchmodel.model}}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleFormControlSelect1">ZIP</label>
                                                                <input type="text" name="searchzip" maxlength="7" id="newSearchHeaderForm_NewCar_zip" class=" form-control" style="margin-top: 1px;">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleFormControlSelect1">Radius</label>
                                                                <select name="searchdistance" class="form-control distance form-control select2-hidden-accessible" id="FormControlSelect3 newSearchHeaderForm_NewCar_distance" data-change="searchdistance">
                                                                    <option value="10" selected="selected">10 mi</option>
                                                                    <option value="25">25 mi</option>
                                                                    <option value="50">50 mi</option>
                                                                    <option value="75">75 mi</option>
                                                                    <option value="100" >100 mi</option>
                                                                    <option value="150">150 mi</option>
                                                                    <option value="200">200 mi</option>
                                                                    <option value="500">500 mi</option>
                                                                    <option value="50000">Nationwide</option>
                                                                </select>
                                                                <span class="dropdown-wrapper" aria-hidden="true"></span>
                                                            </div>
                                                            <div class="form-group mb-2">
                                                                <button id="searchused" type="button" class="btn btn-gradient blue-gradient-bg heading-font middle mar-bot" onclick="search()">Search</button>
                                                            </div>


                                                        </div>
                                                    </div>


                                                    <!-- By Body Style -->

                                                    <div class="tab-pane fade" id="bybody" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                        <div class="">

                                                            <div class="form-group">
                                                                <select class="form-control select2-hidden-accessible" id="FormControlSelect4" name="searchbody" data-change="searchbody">
                                                                    <option selected="selected">All Body Type </option>
                                                                    <option v-for="searchbody in body"  :value="searchbody.body">
                                                                        @{{ searchbody.body }}
                                                                    </option>
                                                                </select>
                                                                <span class="dropdown-wrapper" aria-hidden="true"></span>
                                                            </div>  
                                                            <div class="form-group">
                                                                <label for="exampleFormControlSelect1">ZIP</label>
                                                                <input type="text" name="searchzip" maxlength="7" id="newSearchHeaderForm_NewCar_zip" class=" form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleFormControlSelect1">Radius</label>
                                                                <select class="form-control select2-hidden-accessible" id="FormControlSelect21 newSearchHeaderForm_NewCar_distance" name="searchdistance" data-change="searchdistance">
                                                                    <option value="10" selected="selected">10 mi</option>
                                                                    <option value="25">25 mi</option>
                                                                    <option value="50">50 mi</option>
                                                                    <option value="75">75 mi</option>
                                                                    <option value="100" >100 mi</option>
                                                                    <option value="150">150 mi</option>
                                                                    <option value="200">200 mi</option>
                                                                    <option value="500">500 mi</option>
                                                                    <option value="50000">Nationwide</option>
                                                                </select>
                                                                <span class="dropdown-wrapper" aria-hidden="true"></span>
                                                            </div>
                                                            <div class="form-group mb-2">
                                                                <button id="searchused" type="button" class="btn btn-gradient blue-gradient-bg" onclick="search()">Search</button>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <!-- By Price -->

                                                    <div class="tab-pane fade" id="byprice" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                        <div class="form-group mb-4">
                                                            <div class="byprice">
                                                                <div class="section-title pt-0">price</div>                         
                                                                <div class="slider-content">                         
                                                                    <div class="ui-slider stm-price-range"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">ZIP</label>
                                                            <input type="text" name="searchzip" maxlength="7" id="newSearchHeaderForm_NewCar_zip" class=" form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Radius</label>
                                                            <select class="form-control select2-hidden-accessible" id="FormControlSelect21 newSearchHeaderForm_NewCar_distance" name="searchdistance" data-change="searchdistance">
                                                                <option value="10" selected="selected">10 mi</option>
                                                                <option value="25">25 mi</option>
                                                                <option value="50">50 mi</option>
                                                                <option value="75">75 mi</option>
                                                                <option value="100" >100 mi</option>
                                                                <option value="150">150 mi</option>
                                                                <option value="200">200 mi</option>
                                                                <option value="500">500 mi</option>
                                                                <option value="50000">Nationwide</option>
                                                            </select>
                                                            <span class="dropdown-wrapper" aria-hidden="true"></span>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <button id="searchused" type="button" class="btn btn-gradient blue-gradient-bg" onclick="search()">Search</button>
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

                                        <!-- Search new -->
                                    </div>
                                </div>
                            </div>


                            <!-- filter-widget -->

                            <div class="left-sidebar filter-widget white-bg">
                                <div class="media">
                                    <div class="media-icon">
                                        <i class="fa fa-filter" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="mt-0 text-uppercase text-blue">Filter Results</h4>
                                        @{{ product.data.length }} listings
                                    </div>
                                </div>

                                <!-- Selling Price -->
                                <div class="price ">
                                    <div class="section-title pt-0">Price</div>
                                    <div class="slider-content"> 
                                        <div class="ui-slider stm-price-range price-slider"></div>
                                        <div class="slider-label text-center"></div>
                                    </div>
                                </div>
                                
                                <!-- Mileage -->
                                <div class="mileage ">
                                    <div class="section-title">Mileage</div>
                                    <div class="slider-content">
                                        <div class="stm-milage-range mileage-slider"></div>
                                        <div class="slider-label text-center"></div>
                                    </div>
                                </div>

                                <!--   Transmission   -->
                                <div class="transmission ">
                                    <div class="section-title">Transmission</div>
                                    <div class="transmission-options btn-group">
                                        <button type="button" data-option="" class="btn btn-default active">Any</button>
                                        <button type="button" data-option="Manual" class="btn btn-default">Manual</button>
                                        <button type="button" data-option="Automatic" class="btn btn-default">Automatic</button>                                        
                                    </div>
                                </div>

                                <!--   Makes   -->
                                <div class="makes ">
                                    <div class="section-title">Makes</div>
                                    <div class="drivetrain make-options">
                                        <div class="custom-control custom-checkbox" v-for="item in filterMakeOptions">
                                            <input type="checkbox" class="custom-control-input color-checkbox"  name="make[]" :value="item.make">
                                            <label class="custom-control-label checkmark"> @{{ item.make }} </label>
                                        </div>                                 
                                    </div>
                                </div>

                                <!-- Days on Market -->
                                <div class="market-days ">
                                    <div class="section-title">Days on Market</div>
                                    <div class="slider-content">
                                        <div class="market-days-slider"></div>
                                        <div class="slider-label text-center"></div>
                                    </div>
                                </div>

                                <!-- Drivetrain -->
                                <div class="">
                                    <div class="section-title">Drivetrain</div>   
                                    <div class="drivetrain">
                                        <div class="custom-control custom-checkbox" v-for="drive in drivetrain">
                                            <input type="checkbox" class="custom-control-input color-checkbox"  name="drivetrain[]" :value="drive.drivetrain">
                                            <label class="custom-control-label checkmark"> @{{drive.drivetrain}} </label>
                                        </div>                                 
                                    </div>
                                </div>

                                <!-- Color -->
                                <div class="color ">
                                    <div class="section-title">Color</div>
                                    <div class="drivetrain">
                                        <div class="custom-control custom-checkbox" v-for="ext in extcolor">
                                            <input type="checkbox" class="custom-control-input color-checkbox" name="extcolor[]" :value="ext.exteriorcolor">
                                            <!--                                        <label :style="{display:'inline-block',width:'50px',height:'18px',border:'1px solid #000',background:'#'+ext.exteriorcolor,color: '#'+ext.exteriorcolor}"> @{{ext.exteriorcolor}} </label>-->
                                            <label :style="{display:'inline-block',color: '#'+ext.exteriorcolor}" class="custom-control-label checkmark"> @{{ext.exteriorcolor}} </label>
                                        </div>
                                    </div>
                                </div> 

                                <!-- Fuel Type -->
                                <div class="fueltype ">
                                    <div class="section-title">Fuel Type </div>

                                    <div class="drivetrain">
                                        <div class="custom-control custom-checkbox" v-for="fuel in fueltype">
                                            <input type="checkbox" class="custom-control-input color-checkbox"  name="fule[]" :value="fuel.fuel_type">
                                            <label class="custom-control-label checkmark"> @{{ fuel.fuel_type }} </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Engine -->
                                <div class="engine ">
                                    <div class="section-title">Engine </div>

                                    <div class="drivetrain">
                                        <div class="custom-control custom-checkbox" v-for="option in filterEngineOptions">
                                            <input type="checkbox" class="custom-control-input color-checkbox"  name="engine[]" :value="option.value">
                                            <label class="custom-control-label checkmark"> @{{ option.text }} </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Body Style -->
                                <div class="body-style ">
                                    <div class="section-title">Body Style</div>
                                    <div class="drivetrain">
                                        <div class="custom-control custom-checkbox" v-for="option in body">
                                            <input type="checkbox" class="custom-control-input color-checkbox"  name="body[]" :value="option.body">
                                            <label class="custom-control-label checkmark"> @{{ option.body }} </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Deal Rating -->
                                <div class="deal-rating ">
                                    <div class="section-title">Deal Ratings</div>
                                    <div class="drivetrain">
                                        <div class="custom-control custom-checkbox" v-for="option in dealRating">
                                            <input type="checkbox" class="custom-control-input color-checkbox"  name="body[]" :value="option.value">
                                            <label class="custom-control-label checkmark"> @{{ option.text }} </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- New/Used/CPO -->
                                <div class="vehicle-type ">
                                    <div class="section-title">New / Used / CPO</div>
                                    <div class="drivetrain">
                                        <div class="custom-control custom-checkbox" v-for="option in type">
                                            <input type="checkbox" class="custom-control-input color-checkbox" name="certified[]" :value="option.value">
                                            <label class="custom-control-label checkmark"> @{{ option.text }}</label>
                                        </div>
                                    </div>
                                </div> 

                                <!-- Transmission Speed -->
                                <div class="transmission-speed ">
                                    <div class="section-title">Transmission Speed</div>
                                    <div class="drivetrain">
                                        <div class="custom-control custom-checkbox" v-for="speed in transmission_speed">
                                            <input type="checkbox" class="custom-control-input color-checkbox"  name="transmission_speed[]" :value="speed">
                                            <label class="custom-control-label checkmark"> @{{speed}} </label>
                                        </div>
                                    </div>
                                </div>

                                

                                <!-- Seating Capacity -->
                                <div class="seatingcapacity ">
                                    <div class="section-title">Seating Capacity</div>
                                    <div class="drivetrain">
                                        <div class="custom-control custom-checkbox" v-for="seat in passengercapacity">
                                            <input type="checkbox" class="custom-control-input color-checkbox" name="passengercapacity[]" :value="seat">
                                            <label class="custom-control-label checkmark"> @{{seat}} </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="seatingcapacity ">
                                    <div class="section-title">Interior Color</div>
                                    <div class="drivetrain">
                                        <div class="custom-control custom-checkbox" v-for="ints in intcolor">
                                            <input type="checkbox" class="custom-control-input color-checkbox" name="intcolor[]" :value="ints.interiorcolor">
                                            <label class="custom-control-label checkmark"> @{{ints.interiorcolor}} </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="stm-ajax-row sm-stm-ajax-row">
                        <div class="top-bar white-bg">
                            <div class="stm-car-listing-sort-units stm-car-listing-directory-sort-units clearfix">
                                <div class="top-bar-left ">
                                    <div class="media">
                                        <div class="media-icon">
                                            <i class="fa fa-car" aria-hidden="true"></i>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="mt-0 text-uppercase text-blue">recent cars</h4>
                                            Check our all motors
                                        </div>
                                    </div>
                                </div>
                                <div class="top-bar-right stm-sort-by-options">

                                    <div class="form-group mb-0 stm-select-sorting">
                                        <select tabindex="-1" class="select2-hidden-accessible form-control" aria-hidden="true" name="sortBy">
                                            <option value="year,desc" selected="">Date: newest first</option>
                                            <option value="year,asc">Date: oldest first</option>
                                            <option value="sellingprice,asc">Price: lower first</option>
                                            <option value="sellingprice,desc">Price: highest first</option>
                                            <option value="miles,asc">Mileage: lowest first</option>
                                            <option value="miles,desc">Mileage: highest first</option>
                                        </select>
                                        <span class="dropdown-wrapper" aria-hidden="true"></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="car-detail">
                            <!--   car1  -->
                            <div class="car1 cars white-bg" v-if="product.data.length == 0">
                                <div v-if="product.data.length == 0" v-cloak>
                                    <img  class ="nocarfound" class="center-block" src="{{ remote_asset('images/car_not_found.png',\App::environment() == 'production') }}" />
                                </div>
                            </div>
                            <div v-for="row in product.data" v-cloak class="clearfix">
                                <div class="car1 cars white-bg">
                                    <div class="media">
                                        <a :href="app_base_url(row)" class="car-img"><img class="mr-3 img-fluid" :dataOriginal=" row.images.length?(row.images[0].image !=='' ? row.images[0].image : noimage()):noimage()" :src=" row.images.length?(row.images[0].image !=='' ? row.images[0].image : noimage()):noimage()" class="lazy img-responsive" :alt="row.type+' '+row.year+' '+row.make+' '+row.model" style="display: block;"></a>
                                        <div class="media-body">
                                            <div class="title"><span class="car-name"><a :href="app_base_url(row)" :data-id=row.id> @{{row.type}} @{{row.year}} @{{row.make}} @{{row.model}}</a></span>
        <!--                                        <span class="save"><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i> save</a></span>-->
                                            </div>

                                            <div class="car-info mt-3 clearfix">
                                                <div class="info-content">
                                                    <ul>
                                    <?php
                                $vin= $row->vin;
								$price= $row->sellingprice;
								$deal=InventoryController::getMarketValue($vin,$price);?>
								<span class="car-deal"><strong> <?php 
								if($deal=="Rare Deal"){
									echo '<i class="fa fa-hand-peace-o" aria-hidden="true"></i>';
								}
								else if($deal=="Great Deal"){
									echo '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
								}
								else if($deal=="Good Deal"){
									echo '<i class="fa fa-check-circle" aria-hidden="true"></i>';
								}
								else if($deal=="Fair Deal"){
									echo '<i class="fa fa-handshake-o" aria-hidden="true"></i>';
								
								}else{
									echo '';
								}
								echo " ".$deal;
								?></strong></span>
													
													
                                                        <li><span><strong class="mr-2">Price:</strong><span :title="row.dealer.price_off || row.sellingprice =='' ? row.dealer.call_tracking_no :  row.display_price" :data-original-title="row.dealer.price_off || row.sellingprice =='' ? row.dealer.call_tracking_no :  row.display_price" >@{{ row.dealer.price_off || row.sellingprice =='' ? 'Call for price' :  row.display_price }}</span></span></li>
                                                        <li><span><strong class="mr-2">Mileage:</strong>@{{row.miles}}  kmpl</span></li>
                                                        <li><span><strong class="mr-2">Location:</strong>@{{row.dealer['city']}} @{{row.dealer['state']}}</span></li>
                                                        <!--li><span><strong class="mr-2">Dealer rating:</strong></span>
                                                            <span class="text-yellow">
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                            </span>
                                                        </li-->
                                                    </ul>
                                                </div>
                                                <div class="best-btn text-center">
                                                    <a href="#" data-toggle="modal" :data-url="app_base_url(row)" :data-product-id="row.id" :data-name="row.type+' '+row.year+' '+row.make+' '+row.model" 
                                                   :data-body-type="row.body" :data-model="row.model" :data-drive-train="row.drivetrain" :data-ext-color="row.ext_color_generic" 
                                                   :data-engine-displacement="row.enginedisplacement" :data-transmission="row.transmission" :data-citympg="row.citympg" 
                                                   :data-stock="row.stock" :data-vin="row.vin" :data-image = "row.images.length?(row.images[0].image !=='' ? row.images[0].image : noimage()):noimage()" 
                                                   data-target="#lowestpriceModal"> <img src="{{asset('new_ui/images/582de586a717a.gif')}}" class="img-fluid"></a>
                                                </div>
                                 
                                            </div>
                                            <div class="info-btn">
                                                <a href="#" class="btn big-btn mb-1 showLowestPriceModalButton" data-toggle="modal" :data-url="app_base_url(row)" :data-product-id="row.id" :data-name="row.type+' '+row.year+' '+row.make+' '+row.model" 
                                                   :data-body-type="row.body" :data-model="row.model" :data-drive-train="row.drivetrain" :data-ext-color="row.ext_color_generic" 
                                                   :data-engine-displacement="row.enginedisplacement" :data-transmission="row.transmission" :data-citympg="row.citympg" 
                                                   :data-stock="row.stock" :data-vin="row.vin" :data-image = "row.images.length?(row.images[0].image !=='' ? row.images[0].image : noimage()):noimage()" data-target="#lowestpriceModal">Get Our Lowest Price Now</a>
                                                <a href="#" class="btn big-btn mb-1 showAvailabilityModalButton" data-toggle="modal" :data-product-id="row.id" data-target="#availabilityModal">Check Availability</a>
                                                <a href="#" class="btn big-btn mb-1 showTradeInValueModalButton" data-toggle="modal" :data-product-id="row.id" data-target="#valueyourtradeModalLong"
                                                   :data-make="row.make" :data-model="row.model" :data-trim="row.trim" :data-year="row.year" 
                                                   :data-mileage="row.citympg" :data-vin="row.vin" 
                                                   >Value Trade-in</a>
                                                <a href="tel:+18779390002" class="btn big-btn mobile">Click to Call</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="row" v-if="product.next_page_url">
                            <p class="home info-btn" id="loadMore">
                                <a @click="loadmoreproducts" href="javascript:;" class="btn big-btn mb-1">See More</a>
                            </p>
                        </div> 
                    </div>
                </div>
            </div>
        </div> 
    </section>
</div>
    @include("frontend.partials.home_cars_listing")
    @include("frontend.partials.listing_popup")
@stop
@section('footer-script')
<script type="text/javascript" src="{{asset('js/home.js',Request::secure())}}"></script>
<script type="text/javascript" src="{{asset('js/list.js',Request::secure())}}"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset('new_ui/js/jquery.mmenu.all.js',Request::secure())}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('new_ui/js/jquery.nicescroll.min.js',Request::secure())}}"></script>
<script type="text/javascript" src="{{asset('js/frontend/inventory-custom.js',Request::secure())}}"></script>
@include('includes.listing_script')
@stop