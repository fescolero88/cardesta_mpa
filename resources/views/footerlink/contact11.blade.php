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

                            <div class="stm-featured-top-cars-title big-mar-top"><div class="heading-font">Contact Us</div></div>


        <p class="margin-bottom:5px;">
            if you have any questions about this Privacy Policy, the practices of this site, or your dealings with this site, please contact us at:
        </p>
       <div class="cont-address">

        <h5>CarDesta</h5>
           <ul class="list-unstyled">
               <li> 877-939-0002</li>
               <li>support@cardesta.com</li>
               <li>sales@cardesta.com</li>
           </ul>

       </div>
    </div>




                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('layouts.footer')


@endsection
