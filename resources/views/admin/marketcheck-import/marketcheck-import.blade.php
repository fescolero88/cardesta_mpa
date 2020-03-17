@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="margin-left: 17px;">Marketcheck API Import</h1>
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
                <form action="{{route('import-inventory')}}" method="post" role="form" enctype="multipart/form-data">
                    @csrf
			        <div class="form-group">
                        <label>Marketcheck API</label>
						<h5 class="alert alert-info"><b>Note:</b> Cars will not be imported from the API response if same car available into the database. It will check it based on VIN number.</h5>
                    </div>
                    <div class="box-footer">
						@if( $keyfound )
							<button type="submit" class="btn btn-info pull-left">Start Import</button>
						@else
							<h5 class="alert alert-danger">Please set <b>Marketcheck API</b> Key from "<a href="{{ url('/admin/site-settings') }}"><b>Site Settings</b></a>" page.</h5>
						@endif
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="clearfix"></div>
@stop