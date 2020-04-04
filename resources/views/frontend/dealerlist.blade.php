@extends('layouts1.master')
@section('title',"Find Your Closest Dealer" )
@section('description','Research and compare cars, find local dealers/sellers, calculate loan payments, find your car\'s value, sell or trade your car, get a service estimate, and much more on CarDesta.com.')
@section('content')
<section class="section gray-lght-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 mt-4 text-center">
                <div class="page-title">Dealers</div>
            </div>
        </div>
    </div>
</section>
<section class="section gray-lght-bg page-section-ptb">
    <div class="container">
        <div class="row">
            <div class="col-lg-1 col-md-2 mb-4">
                <ul class="refine">
                    <li>
                        <a href="#" data-toggle="modal" data-target="#exampleModal1">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span>Location</span>
<!--                            <span class="location-zip">50505</span>-->
                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#exampleModal2">
                            <i class="fa fa-shield" aria-hidden="true"></i>
                            <span>Make</span>

                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#exampleModal3">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>Dealer Name</span>

                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-7 col-md-6 mb-4">
                <div class="dealer-listing">
                    <!-- dealer-list 1 -->
                    @if(!$featured->isEmpty() || !$dealers->isEmpty())
                    @foreach($featured as $feature)
                    <div class="dealer-content white-bg feactured-dealers" style="border: 2px solid #418edd;">
                        <div class="media">
                            <a href="{{route('list',['dealername'=>empty($feature->name)?'car-dealer-solutions':strtolower(str_replace(' ','-',$feature->name)),'id'=>$feature->dealer_id,'zip'=>makeslug($feature->zip,"zip")])}}" class="dealer-img"><img class="mr-3 img-fluid" src="{{asset('new_ui/images/dealer1.jpg')}}" alt=""></a>
                            <div class="media-body">
                                <div class="title"><span class="dealer-name"><a href="{{route('list',['dealername'=>empty($feature->name)?'car-dealer-solutions':strtolower(str_replace(' ','-',$feature->name)),'id'=>$feature->dealer_id,'zip'=>makeslug($feature->zip,"zip")])}}">{{ !empty($feature->name) ? $feature->name : 'Car Dealer Solutions'}}</a></span></div>

                                <div class="dealer-info mt-3 clearfix">
                                    <a href="#">
                                        <address>
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <div>
                                                <span itemprop="streetAddress">
                                                    {{$feature->address}},
                                                </span>

                                                <span itemprop="addressCity">{{$feature->city}}</span>
                                                <span itemprop="addressRegion">{{$feature->state}}</span>
                                                <span itemprop="postalCode">{{$feature->zip}}</span>
<!--                                                <span class="distance">0 miles away </span>-->
                                            </div>
                                        </address>
                                    </a>
                                </div>
                                <div class="tagline"><em>"#{{$feature->dealer_slug}}"</em></div>
                                <div class="sales-contact">
                                    <ul>
                                        <li><span><strong>Phone</strong></span><a href="tel:{{$feature->call_tracking_no}}">{{$feature->call_tracking_no}}</a></li>
                                        <li><span><strong>New/Used Cars</strong></span><a href="#">{{$feature->dealerproduct_count}}</a></li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                        <div class="all_dealers">
                            @include('frontend.partials.dealers_page_list', ['dealers' => $dealers])
                            <!--  Pagination  -->
                            <div class="pagination">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        {{$dealers->appends($_GET)->links()}}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    @else
                        <img src="{{remote_asset('new_ui/images/vendor_not_found.png')}}" class="img-responsive middle">
                    @endif
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="dealer-map">
                    <div id="map-layer" style="width:430px;height:400px;"></div>
                </div>
            </div>
        </div>
    </div>
</div> 
</section>

@include("frontend.partials.dealers_popup")
@stop
@section('footer-script')
@include('includes.dealers_listing')
@stop

