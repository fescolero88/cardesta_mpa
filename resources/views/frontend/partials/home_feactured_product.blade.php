
<section class="gray-lght-bg ">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h2 class="mb-md-5 mb-3">
                            Car News & Reviews
                        </h2>
                    </div>
                </div>
            </div>
        @if(!empty($feacturedImage))
            <div class="featured-section">
                <div class="container-fluid p-0">
                    <div class="row no-gutters ">
                    <div class="col-md-6 left-full-image">
                            <!-- <img class="img-fluid" src="{{asset('new_ui/feactureImage/'.$feacturedImage->image)}}" alt=""> -->
                        </div>
                        <div class="col-md-6 white-bg ">
                            <div class="right-content text-center featured box-shadow">
                                <h4 class="text-blue">
                                    featured
                                </h4>
                                <h2>
                                    {{!empty($feacturedImage) ? $feacturedImage->title : "" }}
                                </h2>
                                <p>
                                    {{!empty($feacturedImage) ? $feacturedImage->description : "" }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        @if(!$home['featuredproduct']->isEmpty())
            <div class="container featured-car">
                <div class="row">
                   <?php //echo "<pre>";print_r();die;?>
                    @foreach($home['featuredproduct'] as $product)
                        <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                            <div class="card box-shadow">
                                <a href="{{route('list_details',['dealername'=>makeslug($product->dealer->name,"solution"),'city'=>makeslug($home['featured_dealer']['city'],"city"),'vin'=>$product->vin,'make'=>makeslug($product->make,"make"),"model"=>makeslug($product->model,"model")])}}">
                                    <img alt="Card image cap" class="card-img-top" src="{{$product->images->count() > 0 ? preg_replace("/^http:/i", "https:", $product->images[0]->image) :remote_asset('images/no-car.png')}}"/>
                                </a>
                                <div class="card-body text-center ">
                                    <h4 class="card-title text-uppercase text-blue">
                                        <a href="{{route('list_details',['dealername'=>makeslug($product->dealer->name,"solution"),'city'=>makeslug($home['featured_dealer']['city'],"city"),'vin'=>$product->vin,'make'=>makeslug($product->make,"make"),"model"=>makeslug($product->model,"model")])}}">
                                             {{ucfirst($product->type)}} {{$product->year}} {{$product->make}} {{$product->model}}
                                        </a>
                                    </h4>
                                    <p class="card-text">
                                        {{$product->style_description}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
            </div>
            @if(!$home['featuredproduct']->isEmpty())
                <p class="info-btn browse_by_type_btn_feactured">
                    <a href="{{route('list')}}" class="btn big-btn mb-1 ">See More</a>
                </p>
            @endif
        @endif
        </section>