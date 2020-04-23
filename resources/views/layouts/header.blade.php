<div id="top-bar">
    <div class="container">

        <div class="clearfix top-bar-wrapper">
            <!--LANGS-->
            <!-- Header Top bar Login -->
            
            <div class="pull-left" id="location-view" style="display:none">
                <div class="header-top-bar-socs">
                    <ul class="clearfix">
                        <li><i class="fa fa-crosshairs"></i></li>
                        <li>
                            Location : <span id="g-lat"></span>
                        </li>
                        {{--<li>--}}
                            {{--Longitude : <span id="g-lng"></span>--}}
                        {{--</li>--}}
                        <li>
                            <a href="javascript:;" class="button" style="padding:2px" id="clear-lat-lng">
                                Turn OFF Location
                            </a>
                        </li>  
                    </ul>
                </div>
            </div>
            <div class="pull-left" id="location-off" style="display:none">
                <div class="header-top-bar-socs">
                    <ul class="clearfix">
                        
                        <li>
                            <a href="javascript:;" class="button" style="padding:2px" id="on-lat-lng">
                                Turn ON Location
                            </a>
                        </li>  
                    </ul>
                </div>
            </div>

            <div class="pull-right">
                <div class="header-top-bar-socs">
                    <ul class="clearfix">
                        <li>
                            <a href="https://www.facebook.com/cardestacorp/" target="_blank">
                                <i class="fab fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/CarDestaCorp" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/cardesta/" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>


            {{--<div class="pull-right">--}}
            {{--<div class="top_bar_menu">--}}
            {{--<ul class="stm_top-menu">--}}
            {{--<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1677"><a href="#">Dealer Profile</a></li>--}}
            {{--<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1676"><a href="#">Seller Profile</a></li>--}}
            {{--</ul>--}}
            {{--</div>--}}

            {{--</div>--}}

            <div class="pull-right xs-pull-left">
                <ul class="top-bar-info clearfix">
                    <li><i class="fa fa-phone"></i> +1 877-939-0002</li>
                </ul>
            </div>

        </div>
    </div>
</div>



<!--top-bar-end-->


<div id="header" style="min-height: 104px;">
    <div class="header-listing header-listing-fixed listing-nontransparent-header">

        <div class="listing-header-bg" style="background-image: url('{{remote_asset('images/header-bg.png')}}')"></div>
        <div class="container header-inner-content">
            <!--Logo-->
            <div class="listing-logo-main" >
                <a class="bloglogo image" href="{{route('home')}}">
                    <img src="{{remote_asset('images/car_logo_small.png')}}"  title="Home" alt="Logo" style="width: 190px;max-width: 100%;">
                </a>
            </div>

            <div class="listing-service-right clearfix">
                <div class="listing-right-actions clearfix">
                    <a href="#" class="listing_add_cart heading-font">
                    </a>



                    <div class="listing-menu-mobile-wrapper">
                        <div class="stm-menu-trigger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="stm-opened-menu-listing ">
                            <ul class="listing-menu-mobile heading-font visible-xs visible-sm clearfix">
                                <li id="menu-item-28" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-12 current_page_item menu-item-28">
                                    <a href="{{route('home')}}">Home</a></li>
                                <li id="menu-item-1671" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-1671">
                                   
                                    @if($check)
                                        <a href="{{route('list',['dealername'=>$googledealer->dealer->dealer_slug,'id'=>$googledealer->dealer->dealer_id,'zip'=>$googledealer->dealer->zip])}}">Inventory</a>
                                    @else
                                        <a href="{{route('list')}}">Inventory<span class="stm_frst_lvl_trigger d-none"></span><span class="stm_frst_lvl_trigger d-none"></span></a>

                                    @endif
                                    {{--<ul class="sub-menu">--}}
                                    {{--<li id="menu-item-2262" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2262">--}}
                                    {{--<a href="{{route('list')}}">Listing View</a></li>--}}
                                    {{--<li id="menu-item-2258" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2258">--}}
                                    {{--<a href="#">Map View</a></li>--}}
                                    {{--</ul>--}}
                                </li>
                                {{--<li id="menu-item-2011" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2011">--}}
                                {{--<a href="#">Pricing</a></li>--}}
                                {{--<li id="menu-item-1672" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1672">--}}
                                {{--<a href="#">Blog</a></li>--}}
                                <li id="menu-item-2160" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2160">
                                    @if(!$check)
                                        <a href="{{route('dealerlist')}}">Dealers</a></li>
                                @endif

                                {{--<li class="stm_compare_mobile"><a href="#">Compare</a></li>--}}
                            </ul>

                            <div id="top-bar">
                                <div class="container">

                                    <div class="clearfix top-bar-wrapper">
                                        <!--LANGS-->


                                        <!-- Header Top bar Login -->

                                    {{--<div class="pull-right hidden-xs">--}}
                                    {{--<div class="header-login-url">--}}
                                    {{--<a href="#">--}}
                                    {{--<i class="fa fa-user"></i><span class="vt-top">Login</span>--}}
                                    {{--</a>--}}
                                    {{--<span class="vertical-divider"></span>--}}
                                    {{--<a href="#">Register</a>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}

                                    <!-- Header top bar Socials -->
                                        <div class="pull-right">
                                            <div class="header-top-bar-socs">
                                                <ul class="clearfix">
                                                    <li>
                                                        <a href="https://www.facebook.com/cardestacorp/" target="_blank">
                                                            <i class="fab fa-facebook"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="https://twitter.com/CarDestaCorp" target="_blank">
                                                            <i class="fab fa-twitter"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="https://www.instagram.com/cardesta/" target="_blank">
                                                            <i class="fab fa-instagram"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        {{--<div class="pull-right">--}}
                                        {{--<div class="top_bar_menu">--}}
                                        {{--<ul class="stm_top-menu">--}}
                                        {{--<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1677"><a href="#">Dealer Profile</a></li>--}}
                                        {{--<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1676"><a href="#">Seller Profile</a></li>--}}
                                        {{--</ul>--}}
                                        {{--</div>--}}

                                        {{--</div>--}}
                                        <div class="pull-right xs-pull-left">
                                            <ul class="top-bar-info clearfix">
                                                <li><i class="fa fa-phone"></i> +1 877-939-0002</li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <ul class="listing-menu clearfix" style="margin-top: 18px;">
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-28">
                        <a href="{{route('home')}}">Home</a></li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-1671">
                        @if($check)
                            <a href="{{route('list',['dealername'=>$googledealer->dealer->dealer_slug,'id'=>$googledealer->dealer->dealer_id,'zip'=>$googledealer->dealer->zip])}}">Inventory</a>
                            @else
                            <a href="{{route('list')}}">Inventory</a>

                        @endif

                        {{--<ul class="sub-menu">--}}
                        {{--<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2262">--}}
                        {{--<a href="{{route('list')}}">Listing View</a></li>--}}
                        {{--<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2258">--}}
                        {{--<a href="#">Map View</a></li>--}}
                        {{--</ul>--}}
                    </li>
                    {{--<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2011">--}}
                    {{--<a href="#">Pricing</a></li>--}}
                    {{--<li class="menu-item menu-item-type-post_type menu-item-object-page current_page_parent menu-item-1672">--}}
                    {{--<a href="#">Blog</a></li>--}}
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2160">
                        @if(!$check)
                            <a href="{{route('dealerlist')}}">Dealers</a></li>
                            @endif
                </ul>
            </div>
        </div>
    </div>

</div> <!-- id header -->