<!-- Modal lowestprice-->
<div class="modal lowestprice-modal fade" id="lowestpriceModal" tabindex="-1" role="dialog" aria-labelledby="lowestpriceModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title mb-3 text-white" id="lowestpriceModalLabel">GET TODAY'S BEST PRICE!</h2>
        <h3 class="text-white mb-0">DISPLAYED INSTANTLY ON SCREEN!</h3>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <p class="mt-4 text-center">To ensure our customers have one of the best possible experiences, we display today's best price immediately after submitting the form below.</p>
       <div class="lowestprice-detail">
          <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0">
              <h3>Vehicle Information</h3>
              <div class="vehicle-info">
              <div class="row">
                <div class="col-md-12">
                <div class="title"><span class="car-name"><a href="#"> New 2017 MINI Clubman</a></span></div>
              </div>
              </div>
              <div class="row">
               <div class="col-md-6">
                  <div class="lowestprice-image  mb-4 mb-md-0">
                    <img class="img-fluid" src="{{('new_ui/images/similar-car2.jpg')}}" alt="">
                  </div>
                </div> 
                <div class="col-md-6">
                  <div class="cardetail">
                     <div class="info-content">
                        <ul class="w-100">
                          <li><span><strong class="mr-2">Body Style:</strong>SUV</span></li>
                          <li><span><strong class="mr-2">Model Code:</strong>T</span></li>
                          <li><span><strong class="mr-2">Drive Type:</strong>AWD</span></li>
                          <li><span><strong class="mr-2">Ext. Color:</strong>Brown</span></li>
                          <li><span><strong class="mr-2">Engine:</strong>Gas I4 2.4L/144</span></li>
                          <li><span><strong class="mr-2">Transmission:</strong>Automatic</span></li>
                          <li><span><strong class="mr-2">Mileage:</strong>59,588</span></li>
                          <li><span><strong class="mr-2">Stock #:</strong>E027824A</span></li>
                          <li><span><strong>VIN 5J6RM4H3XDL077846</strong></span></li>
                        </ul>
                        
                      </div>
                  </div>
                </div>
              </div>
              </div>
            </div>
            <div class="col-lg-6">
               <h3>Contact Information</h3>
               <div class="vehicle-info">
               {{ Form::open(array('route' => 'frontend.request-lowest-price', 'id' => 'lowestPriceForm')) }}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <input type="hidden" name="product_id" value="0" /> 
                          <label class="required" for="first_name">First Name:</label>
                          <input type="text" class="form-control" name="first_name" placeholder="">
                          <div class="err err-first_name"></div>
                        </div>
                        <div class="form-group col-md-6">
                          <label class="required" for="last_name">Last Name:</label>
                          <input type="text" class="form-control" name="last_name" placeholder="">
                          <div class="err err-last_name"></div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label class="required" for="email">Email Address:</label>
                          <input type="email" class="form-control" name="email" placeholder="">
                          <div class="err err-email"></div>
                        </div>
                        <div class="form-group col-md-6">
                          <label class="required" for="phone">Phone Number:</label>
                          <input type="tel" class="form-control" name="phone" placeholder="">
                          <div class="err err-phone"></div>
                        </div>
                      </div>
                       <button type="submit" class="btn big-btn btn-gradient blue-gradient-bg">Get Today's Best Price</button>
                    {{ Form::close() }}
               </div>
            </div>
          </div>
       </div>
      </div>
      
    </div>
  </div>
</div>
<!-- Modal lowestprice-->

<!-- Modal Check Availability -->
<div class="modal detail-modal fade" id="makeusanofferModal" tabindex="-1" role="dialog" aria-labelledby="makeusanofferModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="makeusanofferModalLabel">Make Us An Offer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="makeusanoffer-form">
          <h3 class="mb-3 mt-4 ">Contact Information</h3>
          <form action="{{route('customerrequest')}}" id="customerrequest" method="POST" class="wpcf7-form">
              @csrf
            <div style="display: none;">
                <input type="hidden" name="dealer_id" value="{{$product->dealer->dealer_id}}">
                <input type="hidden" name="product_id" value="{{$product->id}}">
            </div>
              
            <div class="form-group">
                <label for="FirstName">First Name*:</label>
                <input type="text" name="fname" value="{{old('fname')}}" size="40" class="form-control" placeholder="First Name" required="">
                 <div class="err err-fname"></div>
            </div>
            <div class="form-group">
                <label for="LastName">Last Name:</label>
                 <input type="text" name="lname" value="{{old('lname')}}" size="40" class="form-control" placeholder="Last Name">
            </div>
            <div class="form-group">
                <label for="Email">Email Address*:</label>
                <input type="email" name="email" value="{{old('email')}}" size="40" class="form-control" placeholder="Email Address" required="">
                <div class="err err-email"></div>
            </div>
            <div class="form-group">
                <label for="DayPhone">Phone*:</label>
                <input type="text" name="tel" value="{{old('tel')}}" size="40" class="form-control" placeholder="Phone" required="">
                 <div class="err err-phone"></div>
            </div>
            <div class="form-group">
                <label for="Comments">Comments:</label>
                <textarea name="message" rows="4" class="form-control" placeholder="Comments">{{old('message')}}</textarea>
            </div>
            <div class="form-group">
                <label for="Comments">Your Offer Price*:</label>
                <input type="text" name="offer_price" class="form-control" placeholder="Your Offer Price" required="">
                <div class="err err-offer_price"></div>
            </div>
            <button type="submit" class="btn big-btn btn-gradient blue-gradient-bg">Send</button>
          </form>
        </div>
      </div>
     
    </div>
  </div>
</div>

<!-- Modal Check Availability -->

<!-- Modal lowestprice-->
<div class="modal detail-modal fade" id="availabilityModal" tabindex="-1" role="dialog" aria-labelledby="availabilityModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="availabilityModalLabel">Check Availability</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="availability-form">
          <h3 class="mb-3 mt-4 ">Contact Information</h3>
            {{ Form::open(array('route' => 'frontend.request-availability', 'id' => 'checkAvailabilityForm')) }}
            <input type="hidden" name="product_id" value="0" />
            <div class="form-group">
                <label for="first_name">First Name:</label>
                 <input name="first_name" type="text" class="form-control" placeholder="">
                 <div class="err err-first_name"></div>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                 <input name="last_name" type="text" class="form-control" placeholder="">
                 <div class="err err-last_name"></div>
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
                 <input name="email" type="email" class="form-control" placeholder="">
                 <div class="err err-email"></div>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                 <input name="phone" type="tel" class="form-control" placeholder="">
                 <div class="err err-phone"></div>
            </div>
            <div class="form-group">
                <label for="comment">Comments:</label>
                <textarea name="comment" rows="4" class="form-control" data-value=""></textarea>
                <div class="err err-comment"></div>
            </div>
            <button type="submit" id="submit" value="Send" class="btn big-btn btn-gradient blue-gradient-bg">Send</button>
            {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
</div>