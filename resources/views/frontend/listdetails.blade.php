@extends('layouts1.master')
@section('content')


<?php
use \App\Http\Controllers\Frontend\InventoryController;
$title=ucfirst($product->type)." ".$product->year." ".$product->make." ".$product->model." overview from ". $product->dealer->name." | ".$product->dealer->city." ".$product->dealer->state." ".$product->dealer->zip." VIN - ".$product->vin;
$description='Research the ' . $product->year . ' ' . $product->make . ' ' .$product->model.' of '.$product->dealer->city.", ".$product->dealer->state.", ".$product->dealer->zip." online at CarDesta.com. View pictures, specs, and pricing on our huge selection of vehicles. Vin - ".$product->vin;

?>
@section('title',$title )
@section('description',$description)

@if(!empty($product->dealer->ga_tag))
@section('googleanalytics')
    <script async src="https://www.googletagmanager.com/gtag/js?id={{$product->dealer->ga_tag}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{$product->dealer->ga_tag}}');
    </script>
@endsection
@endif


@if(!empty($product->dealer->google_conversion_id) && !empty($product->dealer->google_conversion_id))
@section('googleadwords')
    <!-- Google Code for VDP Traffic Conversion Page -->
    <script type="text/javascript">
         <![CDATA[
        var google_conversion_id = {{$product->dealer->google_conversion_id}};
        var google_conversion_label = '{{$product->dealer->google_conversion_label}}';
        var google_remarketing_only = false;
         ]]>
    </script>
    <script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
        <div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/{{$product->dealer->google_conversion_id}}/?label={{$product->dealer->google_conversion_label}}&amp;guid=ON&amp;script=0"/>
        </div>
    </noscript>
@endsection
@endif
@if(!empty($product->dealer->google_conversion_id) && !empty($product->dealer->google_conversion_id))
@section('googleadwords')
    <!-- Google Code for VDP Traffic Conversion Page -->
    <script type="text/javascript">
         <![CDATA[
        var google_conversion_id = {{$product->dealer->google_conversion_id}};
        var google_conversion_label = '{{$product->dealer->google_conversion_label}}';
        var google_remarketing_only = false;
         ]]>
    </script>
    <script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
        <div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/{{$product->dealer->google_conversion_id}}/?label={{$product->dealer->google_conversion_label}}&amp;guid=ON&amp;script=0"/>
        </div>
    </noscript>
@endsection
@endif
<div class="fullwrap">
<section class="pt-5 pb-4 gray-lght-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="clicks-away">
                    <li class=" blue-lght-gradient-bg">
                        <a class="d-flex justify-content-center" href="#">
                            <div class="media">
                                <div class="media-body text-white">
                                    <h3 class="mt-0 mb-0 text-uppercase ">2 CLICKS AWAY</h3>
                                    <span class="text-white">From Our Lowest Price</span>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li class="">
                        <a href="#" class="d-flex justify-content-center ">
                            <div class="media">
                                <div class="media-icon">
                                    <span>1</span>
                                </div>
                                <div class="media-body">
                                    <h3 class="mt-0 mb-0 text-uppercase text-blue">CLICK THE BUTTON</h3>
                                    <span>Get Our Lowest Price</span>
                                </div>
                            </div>

                        </a>
                    </li>

                    <li class="">
                        <a href="#" class="d-flex justify-content-center">
                            <div class="media">
                                <div class="media-icon">
                                    <span>2</span>
                                </div>
                                <div class="media-body">
                                    <h3 class="mt-0 mb-0 text-uppercase text-blue">OUR BEST PRICE</h3>
                                    <span>Shown Instantly!</span>
                                </div>
                            </div>

                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="gray-lght-bg pb-5">
            <div class="container">
                <div class="row">
                <div class="col-lg-12 col-xl-12 mb-3 mt-2">
                <div class="title"><span class="car-name"><h2 class="mb-0">{{ucfirst($product->type)}} {{$product->year}} {{$product->make}} {{$product->model}}</h2></span></div>
                </div>
                    <div class="col-lg-7 col-xl-7 mb-4 mb-lg-0">
                    
                                   
                        <div class="slider-slick">
                            <?php //dd($product->images);?> @if(count($product->images)>0)

                            <div class="slider slider-for detail-big-car-gallery box-shadow">
                                @foreach($product->images as $image)
                                <img class="img-responsive" src="{{ !empty($image['image'])? preg_replace(" /^http:/i ", "https:", $image['image']) :remote_asset('images/no-car.png',\App::environment() == 'production')}}" alt=""> @endforeach
                            </div>

                            @else
                            <div class="slider slider-for detail-big-car-gallery box-shadow">
                                <img class="img-responsive" src="{{asset('images/no-car.png')}}" alt="">
                            </div>
                            @endif @if(count($product->images)>0)

                            <div class="slider slider-nav">
                                @foreach($product->images as $image)
                                <img class="img-responsive" src="{{ !empty($image['image'])? preg_replace(" /^http:/i ", "https:", $image['image']) :remote_asset('images/no-car.png',\App::environment() == 'production')}}" alt=""> @endforeach
                            </div>

                            @else
                            <div class="slider slider-nav">
                                <img class="img-responsive" src="{{asset('images/no-car.png')}}" alt="">

                            </div>
                            @endif
                        </div>
                     
                    </div>
                    <div class="col-lg-5 col-xl-5">
						
                        <div class="cardetail-info ">
                            <div class="left-info">
						
                                <div class="internetprice">
									@php 		$deal=InventoryController::getMarketValue($product->vin,$product->sellingprice); 
								@endphp
								<span class="car-deal"><strong>
								<?php
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
									echo '<i class="fa fa-hand-o-right" aria-hidden="true"></i>';
								
								}else{
									echo '';
								}
								
								?>
								{{$deal}}
								</strong></span>
                                    <div class="price-text">
                                        <span>Internet Price</span>
                                        <span class="pricecurrency">
										${{number_format($product->sellingprice,0)}}</span>
                                    </div>
									 
                                    <div class="price-btn">
                                        <a href="#" data-toggle="modal" data-url="{{ BasicHelper::getURL('list_details', $product) }}" data-product-id="{{ $product->id }}" data-name="{{ $product->type.' '.$product->year.' '.$product->make.' '.$product->model }}" data-body-type="{{ $product->body }}"
                                            data-model="{{ $product->model }}" data-drive-train="{{ $product->drivetrain }}" data-ext-color="{{ $product->ext_color_generic }}" data-engine-displacement="{{ $product->enginedisplacement }}" data-transmission="{{ $product->transmission }}"
                                            data-citympg="{{ $product->citympg }}" data-stock="{{ $product->stock }}" data-vin="{{ $product->vin }}" data-image="{{ isset($product->images) ?( isset($product->images[0]->image) && $product->images[0]->image !=='' ? $product->images[0]->image : BasicHelper::getDefaultImage()) : BasicHelper::getDefaultImage() }}"
                                            data-target="#lowestpriceModal"><img src="{{asset('new_ui/images/price.gif')}}" class="img-fluid"></a>
                                    </div>
                                </div>
                                <div class="hotline d-none d-md-block">

                                    <div class="media">
                                        <div class="media-icon align-self-center">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </div>
                                        <div class="media-body">
                                            <span>CALL or TEXT Our Sales Hotline</span>
                                            <h3 class="mb-0 mt-2"><a href="tel:+{{$product->dealer->call_tracking_no}}" class="mt-0 mb-0 text-uppercase text-blue">{{$product->dealer->call_tracking_no}}</a></h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="efficiency-rating w-100 mt-2 ">

                                    <ul>
                                        <li class="city_mpg"><small>City</small> <strong>{{$product->citympg}}</strong></li>
                                        <li class="fuel"><img class="img-fluid" src="{{asset('new_ui/images/fuel-icon.png')}}" alt=""></li>
                                        <li class="hwy_mpg"><small>Hwy</small> <strong>{{$product->highwaympg}}</strong></li>
                                    </ul>
                                    <p>MPG Disclaimer: *Based on 2013 EPA mileage and driving range ratings. Use for comparison purposes only. Your MPGe/MPG and driving range will vary depending on driving conditions, how you drive and maintain your vehicle,
                                        battery age/condition, and other factors.</p>
                                </div>
                             

                            </div>


                        </div>






                    </div>
                    <div class="col-lg-7 col-xl-7 mb-4 mb-lg-0 order-md-2 order-lg-1">
                     
                        <div class="detail-tab">
                        <div class="title"><span class="car-name mb-3"><h3 class="mb-0">Description</h3></span></div>
                        <div class="" id="description"> 
                                    <div class="section-content">
                                        <p>{{$product->description}}</p>
                                    </div>
                                </div>
                                </div>
                                <div class="detail-tab">
                                <div class="title"><span class="car-name mb-3"><h3 class="mb-0">Specs</h3></span></div>
                        <div class="" id="description" > 
                                    <ul class="detailtab-content-list">
                                        @foreach($product->product_options as $category => $options) @foreach($options as $option)
                                        <li>{{ $option['name'] }}</li>
                                        @endforeach @endforeach
                                    </ul>
                                </div>
                                </div>
</div>
                     
                    <div class="col-lg-5 col-xl-5 order-md-1 order-lg-2">
                        <div class="cardetail-info ">
                            <div class="left-info">
                                <div class="info-content-wrapper">
                                  <div class="info-content listing_detail_single">
                                        <ul class="w-100">
                                            <li><span><strong class="mr-2">Body Style:</strong>{{$product->body}}</span></li>
                                            <li><span><strong class="mr-2">Model Code:</strong>{{$product->modelnumber}}</span></li>
                                            <li><span><strong class="mr-2">Drive Type:</strong>{{$product->drivetrain}}</span></li>
                                            <li><span><strong class="mr-2">Ext. Color:</strong>{{$product->exteriorcolor}}</span></li>
                                            <li><span><strong class="mr-2">Engine:</strong>{{$product->enginecylinders}} Cyl - {{$product->enginedisplacement}}</span></li>
                                            <li><span><strong class="mr-2">Transmission:</strong>{{$product->transmission}}</span></li>
                                            <li><span><strong class="mr-2">Mileage:</strong>{{$product->miles}}</span></li>
                                            <li><span><strong class="mr-2">Stock #:</strong>{{$product->stock}}</span></li>
                                            <li><span><strong>VIN: {{$product->vin}}</strong></span></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="right-info">
                                <div class="cardetailinfo-btn">

                                    <a id="call-number" data-toggle="modal" data-url="{{ BasicHelper::getURL('list_details', $product) }}" data-product-id="{{ $product->id }}" data-name="{{ $product->type.' '.$product->year.' '.$product->make.' '.$product->model }}" data-body-type="{{ $product->body }}"
                                        data-model="{{ $product->model }}" data-drive-train="{{ $product->drivetrain }}" data-ext-color="{{ $product->ext_color_generic }}" data-engine-displacement="{{ $product->enginedisplacement }}" data-transmission="{{ $product->transmission }}"
                                        data-citympg="{{ $product->citympg }}" data-stock="{{ $product->stock }}" data-vin="{{ $product->vin }}" data-image="{{ isset($product->images) ?( isset($product->images[0]->image) && $product->images[0]->image !=='' ? $product->images[0]->image : BasicHelper::getDefaultImage()) : BasicHelper::getDefaultImage() }}"
                                        data-target="#lowestpriceModal" href="#" class="btn btn-block border-color-1 Blondie">Get Our Lowest Price</a>
                                        
                                    <a href="#" class="btn btn-block border-color-2 make-us-offer" data-toggle="modal" data-target="#makeusanofferModal">Make Us An Offer</a>
                                    
                                    <a href="#" class="btn btn-block border-color-3 mb-0" data-toggle="modal" data-product-id="{{ $product->id }}" data-target="#availabilityModal">Check Availability</a>
                                   
                                </div>
                               <div class="brands">
                                    <a href="https://www.carfax.com/VehicleHistory/p/Report.cfx?vin={{$product->vin}}&partner=CDM_O
" target="_blank"><img class="img-fluid" src="{{asset('new_ui/images/brands1.jpg')}}" alt="" ></a>
                                    <a href="https://vinrcl.safercar.gov/vin/?vin={{$product->vin}}" target="_blank"><img class="img-fluid" src="{{asset('new_ui/images/brands2.jpg')}}" alt="" ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<section class="gray-lght-bg pb-5 similar-vehicles">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-none d-md-block">
                    <div class="media">
                        <div class="media-icon">
                            <i class="fa fa-car" aria-hidden="true"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="mt-0 text-uppercase text-blue">Similar Vehicles</h4>
                            You may like thoose too
                        </div>
                    </div>
                    <div class="similar-car row">
                       @foreach($featuredproduct as $prod)
                       <div class="col-md-3 col-sm-12">
                            <div class="card">
                                <a href="{{route('list_details',['dealername'=> $prod->dealer->dealer_slug,'city'=> makeslug($prod->dealer->city,"city"),'vin'=>$prod->vin,'make'=>makeslug($prod->make,"make"),'model'=>makeslug($prod->model,"model")])}}">
                                    <img class="card-img-top" src="{{ $prod->images->count() > 0 ? preg_replace("/^http:/i", "https:", $prod->images[0]->image) :remote_asset('images/no-car.png',\App::environment() == 'production')}}" alt="Card image cap">
                                </a>
                                <div class="card-body gray-lght-bg text-center">
                                    <h4 class="card-title text-uppercase"><a href="#"> {{ucfirst($prod->type)}} {{$prod->year}} {{$prod->make}} {{$prod->model}}</a></h4>
                                    <p class="card-text">Swapping Cars at Flexdrive</p>
                                    <a href="{{route('list_details',['dealername'=> $prod->dealer->dealer_slug,'city'=> makeslug($prod->dealer->city,"city"),'vin'=>$prod->vin,'make'=>makeslug($prod->make,"make"),'model'=>makeslug($prod->model,"model")])}}" class="btn btn-blue-bg btn-block">Shop Now</a>
                                </div>
                            </div>
         </div>
                        @endforeach
                    </div>
                </div>
				<?php 
				$status=InventoryController::gettrialClientStatus($product->dealer_id);
				$trial_status=$status->trial_status;
				$client_status=$status->client_status;
				if($trial_status==1 || $client_status==1){
				?>
                <div class="hotline d-sm-block  d-md-none  border p-3">
                    <div class="hotline-content text-center w-100 inline-block mb-4">
                        <span>CALL or TEXT Our Sales Hotline</span>
                        <h3 class="mb-0 mt-2"><a id="call-number" href="tel:{{$product->dealer->call_tracking_no}}" class="mt-0 mb-0 text-uppercase text-blue Blondie" class=""><i class="fa fa-phone mr-2" aria-hidden="true"></i>{{$product->dealer->call_tracking_no}}</a></h3>
                    </div>
                    <div class="click-btn ">
                        <a id="call-number" href="tel:{{$product->dealer->call_tracking_no}}" class="btn btn-blue-bg Blondie">Click to Call</a>
                        <a href="#" class="btn btn-red-bg mr-0" data-toggle="modal" data-target="#makeusanofferModal">Make Us An Offer</a>
                    </div>
                </div>
				<?php } ?>
            </div>
        </div>
    </div>
</div>
</section>
@include("frontend.partials.listdetails_popup")
@stop
@section('footer-script')
<link rel="stylesheet" type="text/css" href="{{asset('new_ui/css/slick.css',Request::secure())}}" />
<link rel="stylesheet" type="text/css" href="{{asset('new_ui/css/slick-theme.css',Request::secure())}}" />
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="{{asset('js/frontend/inventory-custom.js',Request::secure())}}"></script>
<script type="text/javascript" src="{{asset('new_ui/js/slick.min.js',Request::secure())}}"></script>
<script type="text/javascript">
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        asNavFor: '.slider-nav'
    });

    $('.slider-nav').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      asNavFor: '.slider-for',
      dots: false,
      centerMode: true,
      focusOnSelect: true
    });
</script>
@include('includes.detail_listing')
@stop