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
                <form action="{{route('process-inventory')}}" method="post" role="form" enctype="multipart/form-data">
                    @csrf
			        <h5 class="alert alert-info"> Following fields will be imported.</h5>                    
					@if( !empty( $field_array ) )
						<ul class="list-group">
							@foreach ( $field_array as $field )
								<li class="list-group-item">{{ ucwords(str_replace("_", " ", $field)) }}</li>
							@endforeach
						</ul>
						<button type="submit" class="btn btn-info pull-right">Continue</button>
					@else
						<h5 class="alert alert-danger"> No import data found.</h5>
					@endif
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="clearfix"></div>
@stop