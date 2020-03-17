{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row">
        <div class="col-xs-6">
            <h1 class="mar-zero">Dealers Details</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">About {{$dealer[0]->name}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row dealer-details">
                <div class="left-space col-md-3">
                    <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                </div>
                <div class="col-md-6">
                    @if(is_Null($dealer[0]->email) || $dealer[0]->email === '')
                        <p class="text-muted">no email data found</p>
                    @else
                        <p class="text-muted">{{$dealer[0]->email}}</p>
                    @endif
                </div>
            </div>
            <hr>
            <div class="row dealer-details">
                <div class="left-space col-md-3">
                    <strong><i class="fa fa-mobile margin-r-5"></i> Phone</strong>
                </div>
                <div class="col-md-6">
                    @if(is_Null($dealer[0]->phone) || $dealer[0]->phone === '')
                        <p class="text-muted">no state data found</p>
                    @else
                        <p class="text-muted">{{$dealer[0]->phone}}</p>
                    @endif
                </div>
            </div>
            <hr>
            <div class="row dealer-details">
                <div class="left-space col-md-3">
                    <strong><i class="fa fa-address-book-o margin-r-5"></i> Address</strong>
                </div>
                <div class="col-md-6">
                    @if(is_Null($dealer[0]->address) || $dealer[0]->address === '')
                        <p class="text-muted">no address data found</p>
                    @else
                        <p class="text-muted">{{$dealer[0]->address}}</p>
                    @endif
                </div>
            </div>
            <hr>
            <div class="row dealer-details">
                <div class="left-space col-md-3">
                    <strong><i class="fa fa-map-marker margin-r-5"></i> State</strong>
                </div>
                <div class="col-md-6">
                    @if(is_Null($dealer[0]->state) || $dealer[0]->state === '')
                        <p class="text-muted">no state data found</p>
                    @else
                        <p class="text-muted">{{$dealer[0]->state}}</p>
                    @endif
                </div>
            </div>
            <hr>
            <div class="row dealer-details">
                <div class="left-space col-md-3">
                    <strong><i class="fa fa-map-marker margin-r-5"></i> City</strong>
                </div>
                <div class="col-md-6">
                    @if(is_Null($dealer[0]->city) || $dealer[0]->city === '')
                        <p class="text-muted">no city data found</p>
                    @else
                        <p class="text-muted">{{$dealer[0]->city}}</p>
                    @endif
                </div>
            </div>
            <hr>
            <div class="row dealer-details">
                <div class="left-space col-md-3">
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Zip</strong>
                </div>
                <div class="col-md-6">
                    @if(is_Null($dealer[0]->zip) || $dealer[0]->zip === '')
                        <p class="text-muted">no zip data found</p>
                    @else
                        <p class="text-muted">{{$dealer[0]->zip}}</p>
                    @endif
                </div>
            </div>
            <hr>
            <div class="row dealer-details">
                <div class="left-space col-md-3">
                    <strong><i class="fa fa-fax margin-r-5"></i> Fax</strong>
                </div>
                <div class="col-md-6">
                    @if(is_Null($dealer[0]->fax) || $dealer[0]->fax === '')
                        <p class="text-muted">no fax data found</p>
                    @else
                        <p class="text-muted">{{$dealer[0]->fax}}</p>
                    @endif
                </div>
            </div>
            <hr>
            <div class="row dealer-details">
                <div class="left-space col-md-3">
                    <strong><i class="fa fa-internet-explorer margin-r-5"></i> Website</strong>
                </div>
                <div class="col-md-6">
                    @if(is_Null($dealer[0]->website) || $dealer[0]->website === '')
                        <p class="text-muted">no website data found</p>
                    @else
                        <p class="text-muted">{{$dealer[0]->website}}</p>
                    @endif
                </div>
            </div>
            <hr>
            <div class="row dealer-details">
                <div class="left-space col-md-3">
                    <strong><i class="fa fa-cube margin-r-5"></i> Products</strong>
                </div>
                <div class="col-md-6">
                        @if($dealerproduct->count()>0)
                            <p class="text-muted">{{$dealerproduct->count()}}  products</p>
                        @else
                            <p class="text-muted">this dealer has no product</p>
                        @endif
                </div>
            </div>
            <hr>
            <div class="row dealer-details">
                <div class="left-space col-md-3">
                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                </div>
                <div class="col-md-6">
                    @if($dealer[0]->is_featured == 1)
                        <p class="text-muted">This dealer is featured dealer</p>
                    @else
                        <p class="text-muted">No description found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
        <!-- /.box-body -->
@stop

@section('css')
    <link rel="stylesheet" href="{{remote_asset('/css/admin_custom.css')}}">
@stop

@section('js')
    <script src="">
        console.log('dealers');
    </script>
@stop