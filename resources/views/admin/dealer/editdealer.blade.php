{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit Dealer name</h1>
@stop

@section('content')
    <div class="col-md-12">
        <!-- Horizontal Form -->

        <!-- /.box -->
        <!-- general form elements disabled -->
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Dealer form name</h3>
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
            {{--{{dd($dealer)}}--}}
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{route("editdealer")}}"  method="post" role="form">
                    @csrf
                    <div class="form-group">
                        <label>Dealer ID</label>
                        <input type="text" class="form-control" name="dealer_id" value={{$dealer[0]->dealer_id}} />

                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{$dealer[0]->name}}" />
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{$dealer[0]->phone}}" />
                    </div>
                    <div class="form-group">
                        <label>Call Track No</label>
                        <input type="text" class="form-control" name="call_track_no" placeholder="12365478" value="{{$dealer[0]->call_tracking_no}}"  />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="{{$dealer[0]->email}}" />
                    </div>
                    <div class="form-group">
                        <label>Lead Email</label>
                        <input type="email" class="form-control" name="lead_email" placeholder="example@email.domain" value="{{$dealer[0]->lead_email}}"  />
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" value="{{$dealer[0]->address}}" />
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <input type="text" class="form-control" name="state" value="{{$dealer[0]->state}}" />
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" name="city" value="{{$dealer[0]->city}}" />
                    </div>
                    <div class="form-group">
                        <label>Zip</label>
                        <input type="text" class="form-control" name="zip" value="{{$dealer[0]->zip}}" />
                    </div>
                    <div class="form-group">
                        <label>Fax</label>
                        <input type="text" class="form-control" name="fax" value="{{$dealer[0]->fax}}" />
                    </div>
                    <div class="form-group">
                        <label>Website</label>
                        <input type="text" class="form-control" name="website" value="{{$dealer[0]->website}}" />
                    </div>
                    <div class="form-group">
                        <label>GA tag</label>
                        <input type="text"  class="form-control" placeholder="GA tag" value="{{$dealer[0]->ga_tag}}" name="gatag"  />
                    </div>
                    <div class="form-group">
                        <label>Google Conversion ID</label>
                        <input type="text"  class="form-control" placeholder="Google Conversion ID" value="{{$dealer[0]->google_conversion_id}}" name="google_conversion_id"  />
                    </div>
                    <div class="form-group">
                        <label>Google Conversion Label</label>
                        <input type="text"  class="form-control" placeholder="Google Conversion Label" value="{{$dealer[0]->google_conversion_label}}" name="google_conversion_label"  />
                    </div>
                    <div class="form-group">
                        <label>Market Check / Feed</label>
                        <select class="form-control" name="marketcheck">
                            <option value="M" {{ $dealer[0]->feed_type =='M'?'selected':null}} >Market Check</option>
                            <option value="F" {{ $dealer[0]->feed_type =='F'?'selected':null}}>Feed Type</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Is Featured</label>
                        <input type="checkbox"  name="isfeatured" @if($dealer[0]->is_featured == 1) checked @endif />
                    </div>
                    <div class="form-group">
                        <label>Price Show</label>
                        <input type="checkbox"  name="priceshow" @if($dealer[0]->price_off == 1) checked @endif />
                    </div>
					<div class="form-group">
                        <label>Free Trial</label>
                        <input type="checkbox"  name="trial_status" @if($dealer[0]->trial_status == 1) checked @endif />
                    </div>
					<div class="form-group">
                        <label>Active Client</label>
                        <input type="checkbox"  name="client_status" @if($dealer[0]->client_status == 1) checked @endif />
                    </div>
                    <div class="box-footer">
                        <a type="button" href="{{route('dealers')}}" class="btn btn-danger">Cancel</a>
                        <input type="hidden" name="id" value="{{$dealer[0]->id}}">
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