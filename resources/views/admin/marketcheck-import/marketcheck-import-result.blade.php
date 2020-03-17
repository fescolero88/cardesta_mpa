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
				@csrf
				@if( !empty( $inventory_imported ) )
					<h5 class="alert alert-info"> Following cars successfully imported.</h5> 
					<ul class="list-group marketcheck-inventory-list" style="height: 800px;	overflow: scroll;	position: relative;">
						@foreach ( $inventory_imported as $item )
							<li class="list-group-item">{{ ucwords($item) }}</li>
						@endforeach
					</ul>
					<a class="btn btn-info pull-left" href="{{route('marketcheck-import')}}">Continue To Import More Vehicles</a>
					<a class="btn btn-info pull-right" href="{{route('inventories')}}">View Inventory</a>
				@else
					<h5 class="alert alert-danger"> No data imported.</h5>
				@endif
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="clearfix"></div>
@stop