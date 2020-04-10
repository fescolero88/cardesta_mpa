<?php 
if(Route::current()->getName() == "list"){
    $home['recentproduct']=$recentproduct;
    $home['usedcar']=$usedproduct;
    $home['greatcars']=$greatcars;
}
?>
<section class="page-section-ptb light-grey-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="cars-categories">
                    <div class="popular-new mb-4">
                        <h4 class="text-uppercase text-blue mb-4">
                            Popular New Cars
                        </h4>
                        @if(!$home['recentproduct']->isEmpty())
                        <ul>
                            @foreach($home['recentproduct'] as $product)
                            @if($product->dealer)
                            <li>
                                <a href="{{route('list_details',['dealername'=>makeslug($product->dealer->name,"solution"),'city'=>makeslug($product->dealer->city,"city"),'vin'=>$product->vin,'make'=>makeslug($product->make,"make"),"model"=>makeslug($product->model,"model")])}}">
                                    <i aria-hidden="true" class="fa fa-angle-double-right mr-1">
                                    </i>
                                    {{ucfirst($product->type)}} {{$product->year}} {{$product->make}} {{$product->model}}
                                </a>
                            </li>
                            @endif
                            @endforeach

                        </ul>
                        @endif
                    </div>
                    <div class="popular-used mb-4">
                        <h4 class="text-uppercase text-blue mb-4">
                            Popular used Cars
                        </h4>
                        @if(!$home['usedcar']->isEmpty())
                        <ul>
                            @foreach($home['usedcar'] as $product)
                            @if($product->dealer)
                            <li>
                                <a href="{{route('list_details',['dealername'=>makeslug($product->dealer->name,"solution"),'city'=>makeslug($product->dealer->city,"city"),'vin'=>$product->vin,'make'=>makeslug($product->make,"make"),"model"=>makeslug($product->model,"model")])}}">
                                    <i aria-hidden="true" class="fa fa-angle-double-right mr-1">
                                    </i>
                                    {{ucfirst($product->type)}} {{$product->year}} {{$product->make}} {{$product->model}}
                                </a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                        @endif
                    </div>
                    <div class="great-cars mb-4">
                        <h4 class="text-uppercase text-blue mb-4">
                            More Great Cars
                        </h4>
                        @if(!$home['greatcars']->isEmpty())
                        <ul>
                            @foreach($home['greatcars'] as $product)
                            @if($product->dealer)
                            <li>
                                <a href="{{route('list_details',['dealername'=>makeslug($product->dealer->name,"solution"),'city'=>makeslug($product->dealer->city,"city"),'vin'=>$product->vin,'make'=>makeslug($product->make,"make"),"model"=>makeslug($product->model,"model")])}}">
                                    <i aria-hidden="true" class="fa fa-angle-double-right mr-1">
                                    </i>
                                    {{ucfirst($product->type)}} {{$product->year}} {{$product->make}} {{$product->model}}
                                </a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                        @endif 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
