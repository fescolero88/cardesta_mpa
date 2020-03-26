@extends('layouts1.master')
@section('content')
@section('title','CarDesta-About Us' )
@section('description','cardesta')
<section class="section gray-lght-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 mt-4">
                <h3 class="text-gray"></h3>
            </div>
        </div>
    </div>
</section>
<section class="section gray-lght-bg page-section-pb">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8 col-md-10 mb-4 mb-lg-0">

                <!-- search-widget -->

                <div class="left-sidebar search-widget white-bg">

                    <div class="contact-tabs search-tabs">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-moreinfo-tab" data-toggle="pill" href="#moreinfo" role="tab" aria-controls="pills-moreinfo" aria-selected="true">More Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-customersupport-tab" data-toggle="pill" href="#customersupport" role="tab" aria-controls="pills-customersupport" aria-selected="false">Customer Support</a>
                            </li>
                        </ul>

                        <!-- More Info -->

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="moreinfo" role="tabpanel" aria-labelledby="pills-moreinfo-tab"> <div class="moreinfo">
                                    <h3>Find out how CarDesta can help your dealership</h3>
                                    <p>Thanks for your interest in CarDesta. Fill out this simple form, or call <a href="tel:+18779390002">+18779390002</a> to learn more about CarDesta's franchise and independent dealer solutions.</p>
                                    <h4 class="text-blue fw-5">* Fields are Required</h4>
                                    
                                    <form action="{{route('savecontactus')}}" id="contact_info" method="POST" class="mt-4">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputfirstname">First Name *</label>
                                                <input type="text" class="form-control" name="first_name" value="{{old('first_name')}}" id="inputfirstname" placeholder="First Name" required="">
                                                <div class="err err-firstname"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputlastname">Last Name *</label>
                                                <input type="text" class="form-control" name="last_name" value="{{old('last_name')}}" id="inputlastname" placeholder="Last Name" required="">
                                                <div class="err err-lastname"></div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputitle">Title *</label>
                                                <select id="inputitle" class="form-control" name="title">
                                                    <option>Owner/Dealer Principal</option>
                                                    <option>General Manager</option>
                                                    <option>Used Car Manager</option>
                                                    <option>New Car Manager</option>
                                                    <option>Internet Sales Manager</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputdealership">Dealership Type *</label>
                                                <select id="inputdealership" class="form-control" name="dealership_type">
                                                    <option>New and Used Cars</option>
                                                    <option>Used Cars Only</option>

                                                </select>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dealershipname">Dealership Name *</label>
                                            <input type="text" class="form-control" name="dealership_name" value="{{old('dealership_name')}}" id="dealershipname" placeholder="Dealership Name" required="">
                                            <div class="err err-dealership_name"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputaddress">Dealership Street Address *</label>
                                            <input type="text" class="form-control" name="dealership_street_address" value="{{old('dealership_street_address')}}" value="{{old('dealership_street_address')}}" id="inputaddress" placeholder="Dealership Street Address" required="">
                                            <div class="err err-dealership_street_address"></div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <label for="inputcity">City</label>
                                                <input type="text" name="city" class="form-control" id="inputcity" value="{{old('city')}}" placeholder="city">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputstate">State</label>
                                                <select id="inputstate" class="form-control" name="state">
                                                    <option selected>Choose...</option>
                                                    <option value="AL">AL</option>
                                                    <option value="AK">AK</option>
                                                    <option value="AZ">AZ</option>
                                                    <option value="AR">AR</option>
                                                    <option value="CA">CA</option>
                                                    <option value="CO">CO</option>
                                                    <option value="CT">CT</option>
                                                    <option value="DE">DE</option>
                                                    <option value="DC">DC</option>
                                                    <option value="FL">FL</option>
                                                    <option value="GA">GA</option>
                                                    <option value="HI">HI</option>
                                                    <option value="ID">ID</option>
                                                    <option value="IL">IL</option>
                                                    <option value="IN">IN</option>
                                                    <option value="IA">IA</option>
                                                    <option value="KS">KS</option>
                                                    <option value="KY">KY</option>
                                                    <option value="LA">LA</option>
                                                    <option value="ME">ME</option>
                                                    <option value="MD">MD</option>
                                                    <option value="MA">MA</option>
                                                    <option value="MI">MI</option>
                                                    <option value="MN">MN</option>
                                                    <option value="MS">MS</option>
                                                    <option value="MO">MO</option>
                                                    <option value="MT">MT</option>
                                                    <option value="NE">NE</option>
                                                    <option value="NV">NV</option>
                                                    <option value="NH">NH</option>
                                                    <option value="NJ">NJ</option>
                                                    <option value="NM">NM</option>
                                                    <option value="NY">NY</option>
                                                    <option value="NC">NC</option>
                                                    <option value="ND">ND</option>
                                                    <option value="OH">OH</option>
                                                    <option value="OK">OK</option>
                                                    <option value="OR">OR</option>
                                                    <option value="PA">PA</option>
                                                    <option value="RI">RI</option>
                                                    <option value="SC">SC</option>
                                                    <option value="SD">SD</option>
                                                    <option value="TN">TN</option>
                                                    <option value="TX">TX</option>
                                                    <option value="UT">UT</option>
                                                    <option value="VT">VT</option>
                                                    <option value="VA">VA</option>
                                                    <option value="WA">WA</option>
                                                    <option value="WV">WV</option>
                                                    <option value="WI">WI</option>
                                                    <option value="WY">WY</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputzip">Zip</label>
                                                <input type="text" class="form-control" name="zipcode" id="inputzip" value="{{old('zipcode')}}" placeholder="Zip">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputcounty">Shipping County *</label>
                                                <input type="text" class="form-control" name="shipping_country" id="inputcounty" placeholder="Shipping County" value="{{old('shipping_country')}}" required="">
                                                <div class="err err-shipping_country"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputemail">Email *</label>
                                                <input type="text" class="form-control" name="email" id="inputemail" placeholder="Email" value="{{old('email')}}" required="">
                                                <div class="err err-email"></div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="inputphone">Phone *</label>
                                            <input type="text" class="form-control" name="phone" id="inputphone" placeholder="Phone" value="{{old('phone')}}" required="">
                                            <div class="err err-phone"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputlastname">Comments</label>
                                            <textarea  name="description" class="form-control" rows="5" data-parsley-id="8183" placeholder="Comments">{{old('description')}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="gridCheck" name="dealer_advantage">
                                                <label class="form-check-label" for="gridCheck">
                                                    Send me Dealer Advantage, Cardesta.com monthly e-newsletter featuring tips and tricks to help sell more cars online.
                                                </label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-blue-bg">Submit</button>
                                        <input type="hidden" name="type" value="more_info">
                                    </form>
                                </div>

                            </div>

                            <!-- Customer Support -->

                            <div class="tab-pane fade" id="customersupport" role="tabpanel" aria-labelledby="pills-customersupport-tab">
                                <div class="customer-support">
                                    <h4 class="text-blue">* Fields are Required</h4>
                                    <form action="{{route('savecontactus')}}" id="contact_support" method="POST" class="mt-4">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputdealershipname">Dealership Name *</label>
                                                <input type="text" class="form-control" id="inputdealershipname" placeholder="Dealership Name" name="dealership_name" value="{{old('dealership_name')}}" required="">
                                                <div class="err err-dealership_name"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputcontactperson">Contact Person *</label>
                                                <input type="text" class="form-control" id="inputcontactperson" placeholder="Contact Person" name="contact_person" value="{{old('contact_person')}}" required="">
                                                <div class="err err-contact_person"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputemail1">Email *</label>
                                            <input type="email" class="form-control" id="inputemail1" placeholder="Email" name="email" value="{{old('email')}}" required="">
                                            <div class="err err-email"></div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <label for="inputcity1">City *</label>
                                                <input type="text" class="form-control" id="inputcity1" name="city" placeholder="City" value="{{old('city')}}" required="">
                                                <div class="err err-city"></div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputstate1">State *</label>
                                                <select id="inputstate1" class="form-control" name="state">
                                                    <option value="AL">AL</option>
                                                    <option value="AK">AK</option>
                                                    <option value="AZ">AZ</option>
                                                    <option value="AR">AR</option>
                                                    <option value="CA">CA</option>
                                                    <option value="CO">CO</option>
                                                    <option value="CT">CT</option>
                                                    <option value="DE">DE</option>
                                                    <option value="DC">DC</option>
                                                    <option value="FL">FL</option>
                                                    <option value="GA">GA</option>
                                                    <option value="HI">HI</option>
                                                    <option value="ID">ID</option>
                                                    <option value="IL">IL</option>
                                                    <option value="IN">IN</option>
                                                    <option value="IA">IA</option>
                                                    <option value="KS">KS</option>
                                                    <option value="KY">KY</option>
                                                    <option value="LA">LA</option>
                                                    <option value="ME">ME</option>
                                                    <option value="MD">MD</option>
                                                    <option value="MA">MA</option>
                                                    <option value="MI">MI</option>
                                                    <option value="MN">MN</option>
                                                    <option value="MS">MS</option>
                                                    <option value="MO">MO</option>
                                                    <option value="MT">MT</option>
                                                    <option value="NE">NE</option>
                                                    <option value="NV">NV</option>
                                                    <option value="NH">NH</option>
                                                    <option value="NJ">NJ</option>
                                                    <option value="NM">NM</option>
                                                    <option value="NY">NY</option>
                                                    <option value="NC">NC</option>
                                                    <option value="ND">ND</option>
                                                    <option value="OH">OH</option>
                                                    <option value="OK">OK</option>
                                                    <option value="OR">OR</option>
                                                    <option value="PA">PA</option>
                                                    <option value="RI">RI</option>
                                                    <option value="SC">SC</option>
                                                    <option value="SD">SD</option>
                                                    <option value="TN">TN</option>
                                                    <option value="TX">TX</option>
                                                    <option value="UT">UT</option>
                                                    <option value="VT">VT</option>
                                                    <option value="VA">VA</option>
                                                    <option value="WA">WA</option>
                                                    <option value="WV">WV</option>
                                                    <option value="WI">WI</option>
                                                    <option value="WY">WY</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputzip1">Zip *</label>
                                                <input type="text" class="form-control" id="inputzip1" name="zipcode" placeholder="ZIP" value="{{old('zipcode')}}" required="">
                                                <div class="err err-zip"></div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputphone1">Phone *</label>
                                                <input type="text" class="form-control" id="inputphone1" placeholder="Phone" name="phone" value="{{old('phone')}}" required="">
                                                <div class="err err-phone"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputissuetype">Issue type *</label>
                                                <select id="inputissuetype" class="form-control" name="issue_type">
                                                    <option value="Inventory">Inventory</option>
                                                    <option value="Photos">Photos</option>
                                                    <option value="Report">Report</option>
                                                    <option value="Sales Leads">Sales Leads</option>
                                                    <option value="Toll-Free Number Updates">Toll-Free Number Updates</option>
                                                    <option value="MyDealerCenter Issue">MyDealerCenter Issue</option>
                                                    <option value="Forgot My Username and/or Password">Forgot My Username and/or Password</option>
                                                    <option value="SalesCenter">SalesCenter</option>
                                                    <option value="Select for Print">Select for Print</option>
                                                    <option value="Other Issue">Other</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="issuedetails">Issue Details *</label>
                                            <textarea name="issuedetails" class="form-control" rows="5" data-parsley-id="8184" name="issue_details"  placeholder="Issue Details" required="">{{old('issue_details')}}</textarea>
                                            <div class="err err-issuedetails"></div>
                                        </div>
                                        <button type="submit" class="btn btn-blue-bg">Contact Support</button>
                                        <input type="hidden" name="type" value="customer_support">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- filter-widget -->
            </div>
        </div>
    </div> 
</section>
<section>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-12">
                <div class="contact-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3104.91046444162!2d-104.85836778477528!3d38.903162754209575!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x871351d2b0541133%3A0x9272b3dcb5a8685d!2s5085+List+Dr+%23160%2C+Colorado+Springs%2C+CO+80919%2C+USA!5e0!3m2!1sen!2sin!4v1526885436463" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
<!--    value="{{old('fname')}}"-->
</section>
@stop
@section('footer-script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('includes.contact_us_script')
@stop
