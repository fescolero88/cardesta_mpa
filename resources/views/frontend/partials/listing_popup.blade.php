<!-- Modal Check Availability -->
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
                        <label class="required" for="first_name">First Name:</label>
                        <input name="first_name" type="text" class="form-control" placeholder="">
                        <div class="err err-first_name"></div>
                    </div>
                    <div class="form-group">
                        <label class="required" for="last_name">Last Name:</label>
                        <input  name="last_name" type="text" class="form-control" placeholder="">
                        <div class="err err-last_name"></div>
                    </div>
                    <div class="form-group">
                        <label class="required" for="email">Email Address:</label>
                        <input name="email"  type="email" class="form-control" placeholder="">
                        <div class="err err-email"></div>
                    </div>
                    <div class="form-group">
                        <label class="required" for="phone">Phone:</label>
                        <input name="phone" type="text" class="form-control" placeholder="">
                        <div class="err err-phone"></div>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comments:</label>
                        <textarea name="comment" rows="4" class="form-control" data-value=""></textarea>
                        <div class="err err-comment"></div>
                    </div>
                    <button type="submit" class="btn big-btn btn-gradient blue-gradient-bg">Send</button>
                    {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal Check Availability -->



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
                    <form>
                        <div class="form-group">
                            <label class="required" for="FirstName">First Name:</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label  class="required" for="LastName">Last Name:</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label class="required" for="Email">Email Address:</label>
                            <input type="email" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label class="required" for="DayPhone">Phone:</label>
                            <input type="tel" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label class="required" for="Comments">Comments:</label>
                            <textarea name="Comments" rows="4" class="form-control" data-value=""></textarea>
                        </div>
                        <div class="form-group">
                            <label class="required" for="Comments">Your Offer Price:</label>
                            <input type="text" class="form-control" placeholder="">
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
                                        <label  class="required" for="first_name">First Name:</label>
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

<!-- Modal Value Your Trade-->

<!-- Modal -->
<div class="modal detail-modal valueyourtrade-modal fade" id="valueyourtradeModalLong" tabindex="-1" role="dialog" aria-labelledby="valueyourtradeModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="valueyourtradeModalLongTitle">Value Trade-in</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="valueyourtrade">
                    <h3 class="mb-3 mt-4 ">Contact Information</h3>
                    {{ Form::open(array('route' => 'frontend.request-trading-value', 'id' => 'valueYourTradeForm')) }}
                    <div class="callout">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="hidden" name="product_id" value="0" />
                                <label class="required" for="first_name">First Name:</label>
                                <input type="text" class="form-control"  name="first_name" placeholder="">
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
                                <label  class="required" for="phone">Phone Number:</label>
                                <input type="tel" class="form-control" name="phone" placeholder="">
                                <div class="err err-phone"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment">Comments:</label>
                            <textarea name="comment" rows="4" class="form-control" data-value=""></textarea>
                            <div class="err err-comment"></div>
                        </div> 
                    </div>

                    <h3 class="mb-3 mt-4 ">Vehicle Information</h3>
                    <div class="callout">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="year">Year</label>
                                <input type="text" class="form-control" name="year" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="make">Make</label>
                                <input type="text" class="form-control" name="make" placeholder="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="model">Model</label>
                                <input type="text" class="form-control" name="model" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="trim">Trim</label>
                                <input type="text" class="form-control" name="trim" placeholder="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="mileage">Mileage</label>
                                <input type="text" class="form-control" name="mileage" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="vin">VIN</label>
                                <input type="text" class="form-control" name="vin" placeholder="">
                            </div> 
                        </div>
                        <div class="form-group">
                            <p>By submitting this form, you will be requesting trade-in value at no obligation and will be contacted within 48 hours by a sales representative.</p>
                            <button type="submit" class="btn big-btn btn-gradient blue-gradient-bg">Submit</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                    <!--           <h3 class="mb-3 mt-4 ">Vehicle Condition</h3>
                              <div class="callout">
                                <form>
                                   <div class="form-group">
                                    <label class="d-block" for="vehicle-vin">What is the Exterior Condition?</label>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="exteriorcondition" id="inlineRadio1" value="option1">
                                    <label class="form-check-label" for="inlineRadio1">Extra Clean</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="exteriorcondition" id="inlineRadio2" value="option2">
                                    <label class="form-check-label" for="inlineRadio2">Clean</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="exteriorcondition" id="inlineRadio3" value="option3">
                                    <label class="form-check-label" for="inlineRadio3">Average</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="exteriorcondition" id="inlineRadio4" value="option4">
                                    <label class="form-check-label" for="inlineRadio4">Below Average</label>
                                  </div>
                                </div>
                    
                                <div class="form-group">
                                    <label class="d-block" for="vehicle-vin">What is the Interior Condition?</label>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="interiorcondition" id="inlineRadio5" value="option5">
                                    <label class="form-check-label" for="inlineRadio5">Extra Clean</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="interiorcondition" id="inlineRadio6" value="option6">
                                    <label class="form-check-label" for="inlineRadio6">Clean</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="interiorcondition" id="inlineRadio7" value="option7">
                                    <label class="form-check-label" for="inlineRadio7">Average</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="interiorcondition" id="inlineRadio8" value="option8">
                                    <label class="form-check-label" for="inlineRadio8">Below Average</label>
                                  </div>
                                </div>
                    
                                <div class="form-group">
                                    <label class="d-block" for="vehicle-vin">What is the Tire Condition?</label>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tirecondition" id="inlineRadio9" value="option9">
                                    <label class="form-check-label" for="inlineRadio9">Like New</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tirecondition" id="inlineRadio10" value="option10">
                                    <label class="form-check-label" for="inlineRadio10">Above Average</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tirecondition" id="inlineRadio11" value="option11">
                                    <label class="form-check-label" for="inlineRadio11">Average</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tirecondition" id="inlineRadio12" value="option12">
                                    <label class="form-check-label" for="inlineRadio12">Below Average</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tirecondition" id="inlineRadio13" value="option13">
                                    <label class="form-check-label" for="inlineRadio13">Needs Replacing</label>
                                  </div>
                                </div>
                    
                                <div class="form-group">
                                    <label class="d-block" for="vehicle-vin">Has vehicle been in an accident? </label>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="vehicleaccident" id="inlineRadio14" value="option14">
                                    <label class="form-check-label" for="inlineRadio14">Yes</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="vehicleaccident" id="inlineRadio15" value="option15">
                                    <label class="form-check-label" for="inlineRadio15">No</label>
                                  </div>
                                  </div>
                    
                                  <div class="form-group">
                                    <label class="d-block" for="vehicle-vin">Are you the original owner?</label>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="originalowner" id="inlineRadio16" value="option16">
                                    <label class="form-check-label" for="inlineRadio16">Yes</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="originalowner" id="inlineRadio17" value="option17">
                                    <label class="form-check-label" for="inlineRadio17">No</label>
                                  </div>
                                </div>
                                </form>
                    
                                <h3 class="mb-3 mt-4 ">Additional Comments</h3>
                                <div class="callout">
                                   <form>
                                     <div class="form-group">
                                          <label for="Comments1">Comments:</label>
                                          <textarea name="Comments1" rows="4" class="form-control" data-value=""></textarea>
                                      </div>
                                      <div class="form-group">
                                        <div class="rc-anchor">
                                          <div class="rc-anchor-content">
                                            <div class="rc-inline-block">
                                              <div class="rc-anchor-center-container">
                                                <div class="rc-anchor-center-item">
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                                    <label class="custom-control-label" for="customControlAutosizing">I'm not a robot</label>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="rc-anchor-normal-footer" >
                                            <div class="rc-anchor-logo-portrait">
                                              <div class="rc-anchor-logo-img rc-anchor-logo-img-portrait"></div>
                                              <div class="rc-anchor-logo-text">reCAPTCHA</div>
                                            </div>
                                            <div class="rc-anchor-pt"><a href="#" target="_blank">Privacy</a><span aria-hidden="true" role="presentation"> - </span><a href="#" target="_blank">Terms</a></div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <p>By submitting this form, you will be requesting trade-in value at no obligation and will be contacted within 48 hours by a sales representative.</p>
                                        <button type="submit" class="btn big-btn btn-gradient blue-gradient-bg">Submit</button>
                                      </div>
                                   </form>
                                </div>
                              </div> -->

                </div>
            </div>
        </div>
    </div>
</div>