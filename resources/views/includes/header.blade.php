<header class="header blue-bg sticky-top">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="{{route('home')}}">
                        <img alt="" class="img-fluid" src="{{asset('new_ui/images/logo.png')}}"/>
                    </a>
<!--                     <div class="mobile mobile-btn">
                        <a class="btn mr-2" href="signup.html">
                            Sign Up
                        </a>
                        <a class="btn btn-outline" href="contact-us.html">
                            Contact Us
                        </a>
                    </div> 
                    
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button> -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('home')}}">
                                    Home
                                    <span class="sr-only">
                                        (current)
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                @if($check)
                                    <a class="nav-link" href="{{route('list',['dealername'=>$googledealer->dealer->dealer_slug,'id'=>$googledealer->dealer->dealer_id,'zip'=>$googledealer->dealer->zip])}}">
                                        Inventory
                                    </a>
                                @else
                                  <a class="nav-link" href="{{route('list')}}">
                                        Inventory
                                  </a>
                                @endif
                            </li>
                            
                                <li class="nav-item">
                                    @if(!$check)
                                        <a class="nav-link" href="{{route('dealerlist')}}">
                                            Dealers
                                        </a>
                                    @endif
                                </li>
                            
                        </ul>
                         <div class="desktop">
<!--                            <a class="btn mr-2" href="#">
                                Sign Up
                            </a>-->
                            <a class="btn btn-outline" href="{{route('contactus')}}">
                                Contact Us
                            </a>
                        </div> 
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>