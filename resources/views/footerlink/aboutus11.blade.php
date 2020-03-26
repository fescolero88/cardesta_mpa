@extends("layouts/frontendlayout")
@section('title','CarDesta-About Us' )
@section('description','cardesta')
@section("frontend")
    @include('layouts.header')




    <div id="wrapper" style="padding-top: 101px; min-height: 379px;">
        <div id="main">
            <div class="container" >
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="wpb_wrapper" style="margin-top:60px">

                   <div class="stm-featured-top-cars-title big-mar-top"><div class="heading-font">About Us</div></div>
                  <div class="about-cont">
                   <h3>What we do</h3>
                   <p class="margin-bottom:5px;">
            At CarDesta, we’re building the world’s most trusted and transparent automotive marketplace. We make it easy to find great deals from automotive dealers and provide the guidance consumers need to make a more informed purchase. We also help dealers and private sellers quickly and easily market their vehicles and connect with ready-to-buy shoppers.
        </p>
         </div>

       <div class="about-cont">
       <h3>How we do it</h3>

         <p class="margin-bottom:5px;">
            Using proprietary technology, search algorithms, and innovative data analytics, CarDesta provides unbiased insights on car pricing, dealer reputation, and vehicle history.
        </p>
        </div>

        <div class="about-cont">
         <h3>Who we are</h3>
          <p class="margin-bottom:5px;">
            CarDesta is a division of Capital Dealer Solutions, Corp which was founded in 2011. Capital Dealer Solutions, Corp, also known as CDS has been one of the leading providers in the automotive industry in making it easier for both the dealer and consumer when it comes to vehicle purchasing.
            CarDesta is headquartered in Denver, CO with offices in Colorado Springs, CO, Seattle, WA and Los Angeles, CA.
        </p>
    </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>








    @include('layouts.footer')


@endsection
