<!--================================= popup -->
<!-- location-modal -->
<div class="modal location-modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="location-form">
                    <form action="{{route('searchby_dealername')}}" id="searchbydistance" method="GET">
                        <div class="form-group">
                            <label for="searchwithinselect1" style="margin-top: 15px;">Search Within</label>
                            <select class="form-control" id="searchwithinselect1" name="distance">
                                <option value="10">10 miles</option> 
                                <option value="20">20 miles</option> 
                                <option value="30">30 miles</option> 
                                <option value="40">40 miles</option> 
                                <option value="50">50 miles</option> 
                                <option value="75">75 miles</option> 
                                <option value="100">100 miles</option> 
                                <option value="150">150 miles</option> 
                                <option value="250">250 miles</option> 
                                <option value="500">500 miles</option> 
                                <option value="99999">All miles</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputzip">Zip</label>
                            <input type="text" name="zip" class="form-control" id="inputzip">
                        </div>
                        <input type="hidden" name="searchbyzip" value="searchbyzip">
                        <button type="submit" class="btn big-btn btn-gradient blue-gradient-bg">Apply</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Make -->

<div class="modal location-modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Make</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="location-form">
                    <form action="{{route('searchby_dealername')}}" id="dealer_make" method="GET">
                        <div class="bymake">
                            <div class="form-group">
                                <div class="err err-make"></div>
                                @if(!empty($make))
                                   @foreach($make as $type)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="make[]" value="{{$type}}">
                                            <label class="form-check-label " for="inlineCheckbox1">{{$type}}</label>
                                        </div>
                                   @endforeach
                                @else
                                    <p>Not Found</p>
                                @endif
                            </div>
                        </div>
                        <input type="hidden" name="searchbymake" value="searchbymake">
                        <button type="submit" class="btn big-btn btn-gradient blue-gradient-bg">Apply</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Dealer Name -->
<div class="modal location-modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Dealer Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="location-form">
                    <form action="{{route('searchby_dealername')}}" id="dealer_info" method="GET">
                        
                        <div class="form-group">
                            <label for="inputCity"></label>
                            <input type="text" name="dealer_name" class="form-control" placeholder="Enter Dealer Name">
                            <div class="err err-dealer_name"></div>
                        </div>
                        <input type="hidden" name="searchbyname" value="searchbyname">
                        <button type="submit" class="btn big-btn btn-gradient blue-gradient-bg">Apply</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>