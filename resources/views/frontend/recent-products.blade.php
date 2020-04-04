@extends("layouts.ajax")

@section("html")
    <div class="row row-4 car-listing-row">
        @if(!$home['recentproduct']->isEmpty())
            @foreach($home['recentproduct'] as $product)
                @empty($product->dealer)
                    @continue
                @endempty
                <div class="col-md-4 col-sm-4 col-xs-12 col-xxs-12 stm-directory-grid-loop stm-isotope-listing-item all  2015-11 4wd-12 5-serie-model-94 automatic-13 awd-22 bmw-93 central-locking-147 certified-used-138 fuel-95 6-manual-39 multi-pattern-44 deep-red-19 sedan-20 used-cars-32 col-md-3 col-sm-4 col-xs-12 col-xxs-12 stm-directory-grid-loop stm-isotope-listing-item all" data-price="40000" data-date="201512020738" data-mileage="80">
                    <a href="{{route('list_details',['dealername'=>makeslug($product->dealer->name,"solution"),'city'=>makeslug($product->dealer->city,"city"),'vin'=>$product->vin,'make'=>makeslug($product->make,"make"),"model"=>makeslug($product->model,"model")])}}" class="rmv_txt_drctn">
                        <div class="image">

                            <img data-original="{{$product->images->count() > 0 ?$product->images[0]->image:remote_asset('images/no-car.png',\App::environment() == 'production')}}" src="{{$product->images->count() > 0 ?preg_replace("/^http:/i", "https:", $product->images[0]->image):remote_asset('images/no-car.png',\App::environment() == 'production')}}" class="lazy img-responsive" alt="{{ucfirst($product->type)}} {{$product->year}} {{$product->make}} {{$product->model}}">

                        @if($product->certified == 'True')
                            <!--Hover blocks-->
                                <div class="stm-badge-directory heading-font ">
                                    Certified
                                </div>
                            @endif
                            <div class="stm-car-medias">
                                <div class="stm-listing-photos-unit stm-car-photos-1265">
                                    <i class="stm-service-icon-photo"></i>
                                    <span>{{$product->images->isEmpty() ? '' :$product->images->count()}}</span>
                                </div>


                                {{-- <div class="stm-listing-videos-unit stm-car-videos-1265">
                                    <i class="fa fa-film"></i>
                                    <span>4</span>
                                </div> --}}

         
                            </div>

                            <!--Favorite-->
                            {{-- <div class="stm-listing-favorite " data-id="1265" data-toggle="tooltip" data-placement="right" title="" data-original-title="Add to favorites">
                                <i class="stm-service-icon-staricon"></i>
                            </div> --}}

                        <!--Compare-->
                            {{-- <div class="stm-listing-compare stm-compare-directory-new " data-id="1265" data-title="Used 2015 BMW 5 Series" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to compare">
                                <i class="stm-service-icon-compare-new"></i>
                            </div> --}}
                        </div>
                        <div class="listing-car-item-meta">
                            <div class="car-meta-top heading-font clearfix">
                                <div class="price discounted-price" style="width:47%;">
                                    @if(!$product->dealer->price_off && ($product->sellingprice!=='') && (floatval($product->sellingprice)>0))
                                        @if($product->msrp !== $product->sellingprice)
                                            <div class="regular-price">
                                                @php

                                                    echo money_format('%n',floatval($product->msrp));
                                                @endphp
                                            </div>
                                        @endif
                                        <div class="sale-price">
                                            @php

                                                echo money_format('%n',floatval($product->sellingprice));
                                            @endphp
                                        </div>
                                    @else
                                        Call for price
                                    @endif
                                </div>
                                <div class="car-title">
                                    {{ucfirst($product->type)}} {{$product->year}} {{$product->make}} {{$product->model}}</div>
                            </div>
                            <div class="car-meta-bottom">
                                <ul>
                                    <li>
                                        <i class="stm-icon-road"></i>
                                        <span>{{$product->miles}}</span>
                                    </li>
                                    <li>
                                        <i class="stm-icon-fuel"></i>
                                        <span>{{$product->fuel_type}}</span>
                                    </li>
                                    <li>
                                        <i class="stm-icon-transmission_fill"></i>
                                        <span class="stm-tooltip-link" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Automatic, Manual">
						{{$product->transmission}}<span class="stm-dots dots-aligned">...</span> </span>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </a>
                </div>
            @endforeach
        @else
            <img src="{{remote_asset('images/car_not_found.png',\App::environment() == 'production')}}"  class="img-responsive middle" />
        @endif
    </div>
    @if(!$home['recentproduct']->isEmpty())
        <div class="row">
            <div class="col-xs-12 text-center">
                <div class="dp-in">
                    <a class="load-more-btn" href="{{route('list')}}">
                        Show all</a>
                </div>
            </div>
        </div>
    @endif

@endsection