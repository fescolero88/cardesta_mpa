{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Add Dealer</h1>
@stop

@section('content')
    <div class="col-md-12">
        <!-- Horizontal Form -->

        <!-- /.box -->
        <!-- general form elements disabled -->
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Add Dealer Form</h3>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{route("adddealer")}}" method="post" role="form">
                    @csrf
                    <div class="form-group">
                        <label>Dealer ID</label>
                        <input type="text" class="form-control" name="dealer_id" placeholder="1234" value="{{ old('dealer_id') }}" />
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="John Doe" value="{{ old('name') }}"  />
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="12365478" value="{{ old('phone') }}"  />
                    </div>
                    <div class="form-group">
                        <label>Call Track No</label>
                        <input type="text" class="form-control" name="call_track_no" placeholder="12365478" value="{{ old('call_track_no') }}"  />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="example@email.domain" value="{{ old('email') }}"  />
                    </div>
                    <div class="form-group">
                        <label>Lead Email</label>
                        <input type="email" class="form-control" name="lead_email" placeholder="example@email.domain" value="{{ old('lead_email') }}"  />
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" placeholder="address" value="{{ old('address') }}" />
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <input type="text" class="form-control" name="state" placeholder="State" value="{{ old('state') }}"  />
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" name="city" placeholder="city" value="{{ old('city') }}"  />
                    </div>
                    <div class="form-group">
                        <label>Zip</label>
                        <input type="text" class="form-control" name="zip" placeholder="zip" value="{{ old('zip') }}"  />
                    </div>
                    <div class="form-group">
                        <label>Fax</label>
                        <input type="text" class="form-control" name="fax" placeholder="fax" value="{{ old('fax') }}"  />
                    </div>
                    <div class="form-group">
                        <label>Website</label>
                        <input type="text" class="form-control" name="website" placeholder="website" value="{{ old('website') }}"  />
                    </div>
                    <div class="form-group">
                        <label>GA tag</label>
                        <input type="text"  class="form-control" placeholder="GA tag" value="{{ old('gatag') }}" name="gatag"  />
                    </div>
                    <div class="form-group">
                        <label>Google Conversion ID</label>
                        <input type="text"  class="form-control" placeholder="Google Conversion ID" value="{{old('google_conversion_id')}}" name="google_conversion_id"  />
                    </div>
                    <div class="form-group">
                        <label>Google Conversion Label</label>
                        <input type="text"  class="form-control" placeholder="Google Conversion Label" value="{{old('google_conversion_label')}}" name="google_conversion_label"  />
                    </div>
                    <div class="form-group">
                        <label>Market Check / Feed</label>
                        <select class="form-control" name="marketcheck">
                            <option value="M" selected="selected">Market Check</option>
                            <option value="F">Feed Type</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Is Featured</label>
                        <input type="checkbox"  name="isfeatured"  />
                    </div>
                    <div class="form-group">
                        <label>Price Show</label>
                        <input type="checkbox"  name="priceshow"  />
                    </div>
					<div class="form-group">
                        <label>Free Trial</label>
                        <input type="checkbox"  name="trial_status"  />
                    </div>
					<div class="form-group">
                        <label>Active Client</label>
                        <input type="checkbox"  name="client_status"  />
                    </div>
                    <div class="box-footer">
                        <a type="button" href="{{route('dealers')}}" class="btn btn-danger">Cancel</a>
                        <button type="submit" class="btn btn-info pull-right">submit</button>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="clearfix"></div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop