@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="margin-left: 17px;">Site Settings</h1>
@stop

@section('content')
    <div class="col-md-12">
        <!-- Horizontal Form -->

        <!-- /.box -->
        <!-- general form elements disabled -->
        <div class="box box-warning">
            <div class="box-header with-border">
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
                <form action="{{route("save-settings")}}" method="post" role="form" enctype="multipart/form-data">
                    @csrf
			        <div class="form-group">
                        <label>Marketcheck API Key</label>
                        <input type="text" class="form-control" name="market_check_api_key" placeholder="API Key" value="{{ isset($settingsData['market_check_api_key'])? $settingsData['market_check_api_key']:'' }}" />
                    </div>
                    <div class="box-footer">
                        <a type="button" href="{{route('upload-feactured-image')}}" class="btn btn-danger">Cancel</a>
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