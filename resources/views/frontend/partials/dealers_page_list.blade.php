@foreach($dealers as $dealer)
<?php $dealer = (object) $dealer; ?>
<div class="dealer-content white-bg">
    <div class="media">
        <a href="#" class="dealer-img"><img class="mr-3 img-fluid" src="{{asset('new_ui/images/dealer1.jpg')}}" alt=""></a>
        <div class="media-body">
            <div class="title"><span class="dealer-name"><a href="{{route('list',['dealername'=>$dealer->dealer_slug,'id'=>$dealer->dealer_id,'zip'=>makeslug($dealer->zip,"zip")])}}">{{ !empty($dealer->name) ? $dealer->name : 'Car Dealer Solutions'}}</a></span></div>

            <div class="dealer-info mt-3 clearfix">
                <a href="#">
                    <address>
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        <div>
                            <span itemprop="streetAddress">
                                {{$dealer->address}},
                            </span>

                            <span itemprop="addressCity">{{$dealer->city}}</span>
                            <span itemprop="addressRegion">{{$dealer->state}}</span>
                            <span itemprop="postalCode">{{$dealer->zip}}</span>
                        </div>
                    </address>
                </a>
            </div>
            <div class="tagline"><em>"#{{$dealer->dealer_slug}}"</em></div>
            <div class="sales-contact">
                <ul>
                    <li><span><strong>Phone</strong></span><a href="tel:{{$dealer->call_tracking_no}}">{{$dealer->call_tracking_no}}</a></li>
                    <li><span><strong>New/Used Cars</strong></span><a href="#">{{$dealer->dealerproduct_count}}</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endforeach