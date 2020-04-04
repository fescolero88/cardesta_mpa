@extends("layouts/frontendlayout")
<?php
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
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
        <div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/{{$product->dealer->google_conversion_id}}/?label={{$product->dealer->google_conversion_label}}&amp;guid=ON&amp;script=0"/>
        </div>
    </noscript>
@endsection
@endif

@section("frontend")
    <div id="wrapper" style="padding-top: 112px; min-height: 399px;">

        @include('layouts.header')

        <div class="clearfix"> </div>

                <div id="main">
            <div class="title-box-disabled"></div>

            <div class="stm-single-car-page" style="background-position: 0px 200px;">


                <div class="container">
                    <div class="vc_row wpb_row vc_row-fluid">
                        <div class="stm-vc-single-car-content-left wpb_column vc_column_container vc_col-sm-12 vc_col-lg-9">
                            <div class="vc_column-inner ">
                                <div class="wpb_wrapper">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12">
                                        <div class="stm-listing-single-price-title heading-font sm-mar-zero clearfix min-m-bot">

                               <div class="col-lg-12 col-xs-6 lg-pull-right lg-pad-zero">
                                            <div class="price sm-price ">
                                                @if(!$product->dealer['price_off'] && ($product->sellingprice!=='') && (floatval($product->sellingprice)>0))
                                                 {{ money_format("Price: %n",$product->sellingprice)}}
                                                    @else
                                                    Call for price
                                                    @endif


                                            </div>
                                           </div>
                                            <div class="col-xs-6 visible-sm visible-xs" display="style:none">
                                                <a id="check-aviliblity" href="javascript:;">
                                                    <input type="submit" id="" value="Check Availability" class="wpcf7-form-control  interset-btn col-sm-4 btn-block wpcf7-submit">
                                                </a>
                                            </div>
                                            <h1 class="title col-lg-6 lg-pad-zero">
                                                {{ucfirst($product->type)}} {{$product->year}} {{$product->make}} {{$product->model}}
                                            </h1>
                                        </div>



                                    <div class="clearfix"></div>


                                    <div class="stm-car-carousels stm-listing-car-gallery">
                                            <div class="stm-gallery-actions">
                                            @if($product->certified == 'True')
                                                <!--Hover blocks-->
                                                    <div class="stm-badge-directory heading-font ">
                                                        Certified
                                                    </div>
                                                @endif
                                                </div>

                                                    <div class="stm-car-medias">

                                            </div>

                                            <div class="stm-big-car-gallery">

                                                @if(count($product->images)>0)
                                                    @foreach($product->images as $image)
                                            <div class="item stm-single-image">
                                                <img src="{{ !empty($image['image'])? preg_replace("/^http:/i", "https:", $image['image']) :remote_asset('images/no-car.png',\App::environment() == 'production')}}" alt="Owl Image">
                                            </div>
                                                    @endforeach
                                                    @else
                                                    <div class="item stm-single-image">
                                                        <img src="{{ asset('images/no-car.png')}}" alt="Owl Image">
                                                    </div>
                                                @endif
                                            </div>

                                        <div class="stm-thumbs-car-gallery">

                                            @if(count($product->images)>0)
                                                @foreach($product->images as $image)
                                                <div class="item stm-single-image">
                                                    <img src="{{ !empty($image['image'])? preg_replace("/^http:/i", "https:", $image['image']) :remote_asset('images/no-car.png',\App::environment() == 'production')}}" alt="Owl Image">
                                                </div>
                                                @endforeach
                                                @else
                                                <div class="item stm-single-image">
                                                <img src="{{ asset('images/no-car.png')}}" alt="Owl Image">
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="clearfix">

                                    </div>



                                    <div class="">

                                        <div class="stm-single-car-listing-data">
                                            <h4 class="title heading-font">Car Details</h4>
                                            <table class="stm-table-main">
                                                <tbody><tr>


                                                    <td>
                                                        <table class="inner-table">
                                                            <tbody>
                                                            <tr>
                                                                <td class="label-td">
                                                                    <i class="fa fa-car"></i>Body Style :  <strong class="clr-ash1">{{$product->body}}</strong></td>
                                                                {{--<td class="heading-font"><strong class="clr-ash1">{{$product[0]->body}}</strong></td>--}}
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td class="divider-td"></td>
                                                    <td>
                                                        <table class="inner-table">
                                                            <tbody>
                                                            <tr>
                                                                <td class="label-td"><i class="fab fa-autoprefixer"></i>Transmission:  <strong class="clr-ash1">{{$product->transmission}}</strong></td>
                                                                {{--<td class="heading-font"><strong class="clr-ash1">{{$product[0]->transmission}}</strong></td>--}}
                                                            </tr>
                                                            </tbody></table>
                                                    </td>
                                                    <td class="divider-td"></td>



                                                    <td>
                                                        <table class="inner-table">
                                                            <tbody><tr>
                                                                <td class="label-td">
                                                                    <i class="fa fa-car"></i>Mileage:  <strong class="clr-ash1">{{$product->miles}}</strong></td>
                                                                {{--<td class="heading-font clr-ash"><strong class="clr-ash1">{{$product[0]->citympg}}/{{$product[0]->highwaympg}}</strong></td>--}}
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td class="divider-td"></td>


                                                </tr>
                                                <tr>

                                                    {{--<td>--}}
                                                        {{--<table class="inner-table">--}}
                                                            {{--<tbody><tr>--}}
                                                                {{--<td class="label-td">--}}
                                                                    {{--<i class="fa fa-car"></i>Model Code:  <strong class="clr-ash1">{{$product->modelnumber}}</strong></td>--}}
                                                                {{--<td class="heading-font"><strong class="clr-ash1">{{$product[0]->modelnumber}}</strong></td>--}}
                                                            {{--</tr>--}}
                                                            {{--</tbody></table>--}}
                                                    {{--</td>--}}
                                                    {{--<td class="divider-td"></td>--}}
                                                    <td>
                                                        <table class="inner-table">
                                                            <tbody><tr>
                                                                <td class="label-td">
                                                                    <i class="fas fa-cogs"></i>Engine:  <strong class="clr-ash1">{{$product->enginecylinders}} Cyl - {{$product->enginedisplacement}}</strong></td>
                                                                {{--<td class="heading-font"><strong class="clr-ash1">{{$product[0]->enginecylinders}} Cyl - {{$product[0]->enginedisplacement}}</strong></td>--}}
                                                            </tr>
                                                            </tbody></table>
                                                    </td>
                                                    <td class="divider-td"></td>


                                                    <td>
                                                        <table class="inner-table">
                                                            <tbody><tr>
                                                                <td class="label-td">
                                                                    <i class="fab fa-dribbble"></i>Drive Type:  <strong class="clr-ash1">{{$product->drivetrain}}</strong></td>
                                                                {{--<td class="heading-font"><strong class="clr-ash1">{{$product[0]->drivetrain}}</strong></td>--}}
                                                            </tr>
                                                            </tbody></table>
                                                    </td>
                                                    <td class="divider-td"></td>



                                                    <td>
                                                        <table class="inner-table">
                                                            <tbody><tr>
                                                                <td class="label-td">
                                                                    <i class="far fa-calendar-check"></i>VIN #: <strong class="clr-ash1">{{$product->vin}}</strong></td>
                                                                {{--<td class="heading-font"><strong class="clr-ash1">{{$product[0]->vin}}</strong></td>--}}
                                                            </tr>
                                                            </tbody></table>
                                                    </td>
                                                    <td class="divider-td"></td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <table class="inner-table">
                                                            <tbody><tr>
                                                                <td class="label-td">
                                                                    <i class="fas fa-hashtag"></i>Int. Color:  <strong class="clr-ash1">{{$product->interiorcolor}}</strong></td>
                                                                {{--<td class="heading-font"><strong class="clr-ash1">{{$product[0]->interiorcolor}}</strong></td>--}}
                                                            </tr>
                                                            </tbody></table>
                                                    </td>
                                                    <td class="divider-td"></td>
                                                    <td>
                                                        <table class="inner-table">
                                                            <tbody><tr>
                                                                <td class="label-td"><i class="fas fa-adjust"></i>Ext. Color: <strong class="clr-ash1" style="font-size: 12px;">{{$product->exteriorcolor}}</strong></td>
                                                                {{--<td class="heading-font"><strong class="clr-ash1">{{$product[0]->exteriorcolor}}</strong></td>--}}
                                                            </tr>
                                                            </tbody></table>
                                                    </td>
                                                    <td class="divider-td"></td>



                                                    <td>
                                                        <table class="inner-table">
                                                            <tbody><tr>
                                                                <td class="label-td">
                                                                    <i class="fas fa-hashtag"></i>Stock #:  <strong class="clr-ash1">{{$product->stock}}</strong></td>
                                                                {{--<td class="heading-font"><strong class="clr-ash1">{{$product[0]->stock}}</strong></td>--}}
                                                            </tr>
                                                            </tbody></table>
                                                    </td>
                                                    <td class="divider-td"></td>
                                                </tr>

                                                </tbody></table>
                                        </div>
                                    </div>
                                    <div class="stm-car-listing-data-single stm-border-top-unit ">
                                        <div class="title heading-font">Description</div>
                                        <p style="text-align:justify">{{$product->description}}</p>
                                    </div>

                                    <div class="">


                                    </div>

                                  
                                    @foreach($product->product_options as $category => $options)
                                         <div class="stm-car-listing-data-single stm-border-top-unit ">
                                            <div class="title heading-font">{{ strstr($category,"option") ? ucfirst($category) : ucfirst($category).' Features'  }}</div>

                                        </div>

                                        <div class="">


                                            <div class="stm-single-listing-car-features">
                                                <div class="lists-inline">
                                                    <ul class="list-style-2" style="font-size: 13px;">
                                                        @foreach($options as $option)
                                                            <li>{{ $option['name'] }}</li>
                                                        @endforeach
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="clearfix">

                                    </div>

                                    




                                    <div class="clearfix">

                                    </div>

                                </div>
                                    </div>
                            </div>
                        </div>
                    </div> <!--cont-->
                    <div class="stm-vc-single-car-sidebar-right wpb_column vc_column_container vc_col-sm-12 vc_col-lg-3" id="interset-submits">
                        <div class="vc_column-inner ">
                          <div class="wpb_wrapper">
                                      <style></style>

                                      <div class="sidebar-area-vc stm-sidebar-mode-vc">
                                          <div class="vc_row wpb_row vc_row-fluid" >
                                              <div class="wpb_column vc_column_container vc_col-sm-12">
                                                  <div class="vc_column-inner ">
                                                      <div class="wpb_wrapper">
                                                          <div class="">
                                                              <div class="stm-listing-car-dealer-info price-drop-section">
                                                                  <a id="call-number" href="tel:{{$product->dealer->call_tracking_no}}" class="Blondie">
                                                                      <h3 class="title min-m-bot">Get Our Best Price Now</h3>
                                                                      <h6 class="clr-ash" style="font-size: 16px;">{{$product->dealer->call_tracking_no}}</h6>
                                                                  </a>
                                                                  <div class="clearfix"></div>
                                                              </div>
                                                             <div >
                                                              <div class="stm_listing_car_form " id="i-am-interested-div">
                                                                  <div class="stm-single-car-contact">

                                                                      <div class="title">
                                                                          <i class="fa fa-paper-plane"></i>
                                                                          I am interested</div>

                                                                      <div role="form" class="wpcf7" id="wpcf7-f1665-p494-o1" lang="en-US" dir="ltr">
                                                                          <div class="screen-reader-response"></div>
                                                                          <form action="{{route('customerrequest')}}" id="customerrequest" method="POST" class="wpcf7-form" novalidate="novalidate">
                                                                              @csrf
                                                                              <div style="display: none;">
                                                                                  <input type="hidden" name="dealer_id" value="{{$product->dealer->dealer_id}}">
                                                                                  <input type="hidden" name="product_id" value="{{$product->id}}">
                                                                              </div>

                                                                              <div class="stm-form-with-icon">
                                                                                  <i class="stm-service-icon-user-2"></i>
                                                                                  <span class="wpcf7-form-control-wrap name">
                                                                                      <input type="text" name="fname" value="{{old('fname')}}" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="First Name*">
                                                                                  </span>
                                                                              </div>
                                                                              <div class="stm-form-with-icon">
                                                                                  <i class="stm-service-icon-pin_2"></i>
                                                                                  <span class="wpcf7-form-control-wrap name">
                                                                                      <input type="text" name="lname" value="{{old('lname')}}" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Last Name">
                                                                                  </span>
                                                                              </div>
                                                                              <div class="stm-form-with-icon">
                                                                                  <i class="stm-service-icon-mail-o"></i>
                                                                                  <span class="wpcf7-form-control-wrap email">
                                                                                      <input type="email" name="email" value="{{old('email')}}" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Email*">
                                                                                  </span>
                                                                              </div>

                                                                              <div class="stm-form-with-icon">
                                                                                  <i class="stm-service-icon-phone"></i>
                                                                                  <span class="wpcf7-form-control-wrap tel">
                                                                                      <input type="tel" name="tel" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-tel" aria-invalid="false" placeholder="Phone*">
                                                                                  </span>
                                                                              </div>
                                                                              <div class="stm-form-with-icon">
                                                                                  <span class="wpcf7-form-control-wrap message">
                                                                                      <textarea name="message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" placeholder="Your personalized message to the dealer"></textarea>
                                                                                  </span>
                                                                              </div>

                                                                              <p><input type="submit" id="submit" value="Submit" class="wpcf7-form-control btn-block  wpcf7-submit"></p>
                                                                              <div class="wpcf7-response-output wpcf7-display-none"></div>
                                                                              <input type="hidden" value="6" name="stm_changed_recepient">
                                                                          </form>
                                                                      </div>

                                                                  </div>
                                                              </div>
                                                             </div>



                                                              <div class="">
                                                                  <div class="stm-border-bottom-unit"><div class="title heading-font">Vehicle Also Viewed</div></div>


                                                                  <div class="stm-similar-cars-units">
                                                                      @foreach($featuredproduct as $prod)
                                                                      <a href="{{route('list_details',['dealername'=> $prod->dealer->dealer_slug,'city'=> makeslug($prod->dealer->city,"city"),'vin'=>$prod->vin,'make'=>makeslug($prod->make,"make"),'model'=>makeslug($prod->model,"model")])}}" class="stm-similar-car clearfix">
                                                                          <div class="image">
                                                                              <img width="350" height="356" src="{{ $prod->images->count() > 0 ? preg_replace("/^http:/i", "https:", $prod->images[0]->image) :remote_asset('images/no-car.png',\App::environment() == 'production')}}" class="img-responsive wp-post-image" alt="">					</div>
                                                                          <div class="right-unit">
                                                                              <div class="title">{{ucfirst($prod->type)}} {{$prod->year}} {{$prod->make}} {{$prod->model}}</div>


                                                                              <div class="stm-dealer-name">{{empty($prod->dealer->name)?'Car Dealer Solution':$prod->dealer->name}}</div>
                                                                              <div class="clearfix">
                                                                                  <div class="stm-price heading-font">
                                                                                      @if(!$prod->dealer['price_off'] && ($prod->sellingprice!=='') && (floatval($prod->sellingprice)>0))
                                                                                          {{ money_format("Price: %n",$prod->sellingprice)}}
                                                                                      @else
                                                                                          Call for price
                                                                                      @endif</div>
                                                                                  <div class="stm-car-similar-meta">
                                                                                      <i class="stm-icon-road"></i>
                                                                                      <span>{{$prod->miles}}</span>
                                                                                  </div>

                                                                              </div>

                                                                          </div>
                                                                      </a>
                                                                          @endforeach
                                                                  </div>
                                                              </div>

                                                              <div class="clearfix"></div>
                                                              <div class="store-map">
                                                                  <h4 class="title heading-font border-bot clr-ash">Visit our Store</h4>
                                                                  <h5>{{empty($product->dealer->name)?'Car Dealer Solution':$product->dealer->name }}</h5>
                                                                  <address>
                                                                      {{$product->dealer->address}}<br>
                                                                      {{$product->dealer->state}}, {{$product->dealer->city}}<br>
                                                                      <br><br>

                                                                      Phone: <a id="call-number" href="tel:{{$product->dealer->call_tracking_no}}" class="Blondie">{{$product->dealer->call_tracking_no}}</a><br>

                                                                  </address>
                                                                  <div class="clearfix"></div>

                                                                  {{--<iframe src='https://www.google.com/maps/embed/v1/place?q="+{{$product->dealer->city}},{{$product->dealer->city}}+"&amp;key=AIzaSyD1WlC7K5CuuX55i6V45Be3o-4ic_KcG2w' width='100%' height='250' frameborder='0' style='border:0' allowfullscreen></iframe>--}}


                                                              </div><!--store-map end-->

                                                              <div class="clearfix"></div>
                                                          </div></div></div></div>
                                          </div></div></div></div>

                          <div class="clearfix"></div>

                </div> <!--single car page-->
            </div> <!--main-->
        </div> <!--wrapper-->
            </div>


        
        </div>
    </div>
    @include('layouts.footer')


@endsection

@push('scripts')
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">

	jQuery(document).ready(function($){
        $(window).scroll(function(){
            if($("#header").css('min-height') == '78px')
            {
                $(".stm-listing-car-dealer-info").css({position:'fixed',bottom:0})
            }
            else if($("#header").css('min-height') == '0px')
            {
                console.log("dsds");
                $(".stm-listing-car-dealer-info").css({position:'fixed',bottom:0,left:0,margin:0,'z-index':9999})
            }
            else
            {
                $(".stm-listing-car-dealer-info").css({position:'static',bottom:0})
            }
        })
        var big = $('.stm-big-car-gallery');
		var small = $('.stm-thumbs-car-gallery');
		var flag = false;
		var duration = 800;

		var owlRtl = false;
		if( $('body').hasClass('rtl') ) {
			owlRtl = true;
		}

		big
			.owlCarousel({
				items: 1,
				rtl: owlRtl,
				smartSpeed: 800,
				dots: false,
				nav: false,
				margin:0,
				autoplay: false,
				loop: false,
				responsiveRefreshRate: 1000
			})
			.on('changed.owl.carousel', function (e) {
				$('.stm-thumbs-car-gallery .owl-item').removeClass('current');
				$('.stm-thumbs-car-gallery .owl-item').eq(e.item.index).addClass('current');
				if (!flag) {
					flag = true;
					small.trigger('to.owl.carousel', [e.item.index, duration, true]);
					flag = false;
				}
			});

		small
			.owlCarousel({
				items: 5,
				rtl: owlRtl,
				smartSpeed: 800,
				dots: false,
				margin: 22,
				autoplay: false,
				nav: true,
				loop: false,
				navText: [],
				responsiveRefreshRate: 1000,
				responsive:{
					0:{
						items:2
					},
					500:{
						items:4
					},
					768:{
						items:5
					},
					1000:{
						items:5
					}
				}
			})
			.on('click', '.owl-item', function(event) {
				big.trigger('to.owl.carousel', [$(this).index(), 400, true]);
			})
			.on('changed.owl.carousel', function (e) {
				if (!flag) {
					flag = true;
					big.trigger('to.owl.carousel', [e.item.index, duration, true]);
					flag = false;
				}
			});

		if($('.stm-thumbs-car-gallery .stm-single-image').length < 6) {
			$('.stm-single-car-page .owl-controls').hide();
			$('.stm-thumbs-car-gallery').css({'margin-top': '22px'});
		}


        $("#customerrequest").submit(function(e) {
            e.preventDefault();
            var formdata =$("#customerrequest").serialize();            // process the form
            $.ajax({
                type        : 'POST',
                url         : '{{route('customerrequest')}}',
                data        : formdata,
                dataType    : 'json',
                encode          : true,
                processData: false,
                success: function() {
                    swal("Hey! We noted your request. We will get back sooner.");
                },
                error: function(err) {

                    swal("Oops! One or more fields are required. Or something went wrong.");
                }
            });
        });

        $("#call-number").click(function(e){
          let phone = $(this).data('phone');
           $.post('{{ route("phone-enquiry") }}',{
               product_id : {{ $product->id }},
               _token : '{{ csrf_token() }}'
           },function(data){
            console.log(data);
           });
            
        });

	})

    jQuery(document).ready(function($){

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent('Location found.');
                infoWindow.open(map);
                map.setCenter(pos);
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
        }

        $("#check-aviliblity").click(function(){
            $('html,body').animate({scrollTop: $("#i-am-interested-div").offset().top - 90}, 800);
        });
    });
</script>









@endpush