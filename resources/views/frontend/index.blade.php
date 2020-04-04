@extends('layouts1.master')
@section('title',"Find Cars for Sale and Reviews | New and Used Cars For Sale")
@section('description','Find used cars and new cars for sale at CarDesta.  Research and compare cars, find local dealers/sellers, get an estimate and much more on CarDesta.')
@section('content')
<section class="section">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-sm-12 ">
                    <div class="banner">
                        <img alt="" class="img-fluid w-100" src="{{asset('new_ui/images/banner-bg.jpg')}}" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="search">
        <div class="container">
            <div class="search-block white-bg box-shadow">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h2 class="text-black">
                            Shop For Cars
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
					<input type="hidden" class="makevalue" value="Used"/>
                        <ul class="nav nav-tabs d-flex justify-content-center" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a aria-controls="home" aria-selected="true" data-slug="condition" class="nav-link active tabvalue" data-toggle="tab" data-type="search_type" value="Used" href="#usedcar" data-value="Used" id="home-tab" role="tab">
                                    Search Used
                                </a>
                            </li>
                            <li class="nav-item">
                                <a aria-controls="new-cars" data-type="search_type" data-value="New" aria-selected="false" class="nav-link tabvalue" data-toggle="tab" href="#newcar" id="profile-tab" role="tab" data-value="new-cars" value="New" data-slug="condition">
                                    Search New
                                </a>
                            </li>
                            <li class="nav-item">
                                <a aria-controls="contact" aria-selected="false" data-type="certified_used" class="nav-link tabvalue" data-toggle="tab" href="#certified" id="contact-tab" data-value="certified-used" data-slug="condition" role="tab">
                                    Certified Pre-Owned
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            @php
                                if($check){
                                    $action=   route('list',['dealername'=>$googledealer->dealer->dealer_slug,'id'=>$googledealer->dealer->dealer_id,'zip'=>$googledealer->dealer->zip]) ;
                                }else{
                                    $action=  route('list');
                                }
                            @endphp
                            <div aria-labelledby="home-tab" class="tab-pane fade show active" id="usedcar" role="tabpanel">
                                <div class="usedcar-form">
                                    <form action={{$action}} method="GET" class="sm-form-style">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group col-lg-12">
                                                    <label class="blank-label" for="inputState">
                                                    </label>
                                                    <select class="form-control form-control search_make" id="make" data-class="stm_select_overflowed" name="search_make" aria-hidden="true" tabindex="-1">
                                                        <option selected="" value="">
                                                            Choose Make
                                                        </option>
                                                        @if(!empty($search)){
                                                            @foreach($search['makes'] as $key=>$val)
                                                                <option value="{{ $key }}">{{ $key }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label class="blank-label" for="inputState ">
                                                    </label>
                                                    <select class="form-control search_model" id="model" data-class="stm_select_overflowed" name="search_model" aria-hidden="true" tabindex="-1">
                                                        <option selected="" value="0">
                                                            Choose Model
                                                        </option>
                                                        @if(!empty($search))
                                                            @foreach($search['models'] as $make)
                                                                <option value="{{ $make }}">{{ $make }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label class="blank-label" for="inputCity">
                                                    </label>
                                                    <input type="text" class="stm_listing_filter_text stm_listing_search_location form-control" id="stm-car-location-stm_all_listing_tab" name="ca_location" placeholder="Enter a location" autocomplete="off">
                                                    <input type="hidden" name="stm_lat" >
                                                    <input type="hidden" name="stm_lng" >
                                                    <input type="hidden" name="search_type" value="">
                                                    <input type="hidden" name="certified" value="">
                                                    <input type="hidden" name="search_from" value="home">
                                                </div>
                                                <div class="form-group col-lg-12 search-btn">
                                                    <label class="blank-label" for="inputState">
                                                    </label>
                                                        <button type="submit" class="btn big-btn btn-gradient blue-gradient-bg">
                                                        Search
                                                    </button>
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
    </section>
        @include("frontend.partials.home_browse_style")
        @include("frontend.partials.home_feactured_product")
        @include("frontend.partials.home_cars_listing")
@stop
@section('footer-script')
@stop