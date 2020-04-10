<?php //echo "<pre>";print_r($search['bodies']);?>
 @if(!empty($search['bodies']))
        <section class="white-bg page-section-ptb">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h2>
                            Browse by style
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="cars-browse">
                            @foreach($search['bodies'] as $key)
                                @if(!empty($key['images']))
                                   <?php $image = $key['images'][0]['image'];?>
                                @else
                                    <?php $image = asset('new_ui/images/no-car.png');?>
                                @endif
                                <div class="cars-box" style="display: none;">
                                    @if($check)
                                        <a href="{{ route('list',['dealername'=>$googledealer->dealer->dealer_slug,'id'=>$googledealer->dealer->dealer_id,'zip'=>$googledealer->dealer->zip]) }}/?body={{ urlencode($key['body']).'&search_from=home' }}" class="stm_listing_icon_filter_single" title="{{$key['body']}}">
                                            <img src="{{$image}}" style="width: 220px;height:125px";>
                                            </img>
                                        </a>
                                        <a href="{{ route('list',['dealername'=>$googledealer->dealer->dealer_slug,'id'=>$googledealer->dealer->dealer_id,'zip'=>$googledealer->dealer->zip]) }}/?body={{ urlencode($key['body']).'&search_from=home' }}" class="stm_listing_icon_filter_single" title="{{$key['body']}}">
                                            {{$key['body']}}
                                        </a>
                                    @else
                                        <a href="{{ route('list') }}/?body={{ urlencode($key['body']).'&search_from=home' }}" class="stm_listing_icon_filter_single" title="{{$key['body']}}">
                                            <img src="{{$image}}" style="width: 220px;height:125px";>
                                            </img>
                                        </a>
                                        <a href="{{ route('list') }}/?body={{ urlencode($key['body']).'&search_from=home' }}" class="stm_listing_icon_filter_single" title="{{$key['body']}}">
                                            {{$key['body']}}
                                        </a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @if(count($search['models']) > 12)
                        <p class="home info-btn" id="loadMore">
                            <a href="#" class="btn big-btn mb-1">See More</a>
                        </p>
                    @endif  
                </div>
            </div>
        </section>
@endif
@section('footer-script')
<script>
 $(function () {
    $(".cars-box").slice(0, 4).show();
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $(".cars-box:hidden").slice(0, 4).slideDown();
        if ($(".cars-box:hidden").length == 0) {
            $("#loadMore").fadeOut('slow');
        }
        $('.cars-box').animate({
        }, 1500);
    });
});
</script>
@stop