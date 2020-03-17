{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row">
        <div class="col-xs-6">
            <h1 class="mar-zero">Inventories List</h1>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('success') }}
                </div>
            @elseif(session('fail'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('fail') }}
                </div>
            @endif
        </div>
        <div class="col-xs-6">
            <div class="box-header">
                <div class="box-tools">
                    <div class="input-group input-group-sm" >
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                            Import Product from CSV
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Products List</h3>

              {{--<div class="box-tools">--}}
                 {{--{{ $products->links() }}--}}
              {{--</div>--}}
            </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover" id="inventory-table">
                        <thead>
                        <tr>
                            <th>Dealer ID</th>
                            <th>Image</th>
                            <th>Type</th>
                            <th>Make Model</th>
                            <th>Model Number</th>
                            <th>Google adwords link</th>
                            <th>Year</th>
                        </tr>
                        </thead>
                        {{--<tbody>--}}
                        {{--@if(count($products)>0)--}}
                            {{--@foreach($products as $product)--}}
                                {{--<tr>--}}
                                    {{--<td>{{$product->dealer_id}}</td>--}}
                                    {{--<td>--}}
                        {{----}}
                                        {{--<img width="20%" class="img-thumbnail" src="{{$product->images[0]->image}}" alt="{{ $product->dealer_id }}" />--}}
                                  {{----}}
                                    {{--</td>--}}
                                    {{--<td>{{$product->type}}</td>--}}
                                    {{--<td>{{$product->make}} ({{$product->model}})</td>--}}
                                    {{--<td>{{$product->modelnumber}}</td>--}}
                                    {{--<td>{{$product->year}}</td>--}}
                                    {{--<td>--}}
                                        {{-- <a href="{{route('productdetail', ['id' => $product->id])}}" ><i class="fa fa-edit" title="Detail"></i></a> --}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                            {{--@endforeach--}}
                        {{--@else--}}
                            {{--<tr>--}}
                                {{--No items in inventory--}}
                            {{--</tr>--}}
                        {{--@endif--}}
                        {{--</tbody>--}}
                    </table>
                    {{--<div class="box-footer clearfix">--}}
                        {{--{{ $products->links() }}--}}
                    {{--</div>--}}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    <div class="modal fade in" id="modal-default" style="padding-right: 15px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Import CSV</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-default alert-dismissible" id="csvmessage">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <p id="message"></p>
                    </div>

                    <div class="row">
                                                <div class="form-group">
                            <label class="col-sm-4 control-label">Select Dealer</label>
                            <div class="col-sm-8">
                            <select class="form-control" id="dealer">
                                <option value="0">Select Dealer</option>
                                @foreach($dealers as $dealer)
                                    <option {{ $dealer->dealer_id == 'tituswill' ? 'selected' : '' }} value="{{ $dealer->dealer_id }}">{{ $dealer->name ?? $dealer->dealer_id }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px;">
                      <div class="col-md-12">
                        <form action="{{route('import-csv')}}" class="dropzone" id="dropzoneForm">
                        <div class="fallback">
                          <input name="file" type="file" />
                        </div>
                      </form>
                      </div>
                    </div>
                   
                  
                    <div class="loader"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
    .loader {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 2s linear infinite; /* Safari */
    animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css" />
@stop
@section('js')
    <script src="{{ remote_asset('js/dropzone.js', true) }}"></script>
    <script>
        $('.loader').hide();
        $('#csvmessage').hide();
        Dropzone.autoDiscover = false;
        var dz = $("#dropzoneForm").dropzone({
             url: "{{route('import-csv')}}",
             paramName: "product_data", // The name that will be used to transfer the file
             maxFilesize: 100, // MB
             maxFiles: 1,
             accept: function(file, done) {
    
                var ext = file.name.split('.').pop();
                var dealer = $("#dealer").val();
                if(ext == 'csv' && dealer)
                {
                    done();
                }
                else if(!dealer)
                {
                    this.removeFile(file);
                    swal({
                            type: 'error',
                            title: 'No Dealer selected',
                            text: 'Please select a dealer',
                        })      
                }  
                else
                {
                    this.removeFile(file);
                    console.log(ext);
                    swal({
                            type: 'error',
                            title: 'Invalid File',
                            text: 'Only CSV files can be uploaded',
                        })
                }
             },
             success : function(file, data, formData){
                console.log(data);
                if(data.success===false){
                        
                        swal(data.message);
                    }
                    else{
                        location.href = "{{ route('import-csv') }}?file="+data.filename+'&dealer_id='+$("#dealer").val();
                     }
             },
             sending :  function(file, xhr, formData){
             
                formData.append('dealer_id', $("#dealer").val());
                formData.append('_token', '{{ csrf_token() }}');
            },
            error : function(file, errMsg, err){
                    this.removeFile(file);
                     err = JSON.parse(err.responseText);
                   let str_err = errMsg;
                    if(err.errors)
                    {
                        err.errors.products_data.map((e)=> { str_err += e+"\n" });
                    }
                    if(errMsg)
                     swal(errMsg);
                    else 
                     swal(str_err);
               }
         });

    
    </script>

    <script>
        base_url = '{{ url()->to('/') }}';
        $(function() {
            $('#inventory-table').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false,
                processing: true,
                serverSide: true,
                ajax: '{!! route('datatables.data') !!}/',
                columns: [
                    { data: 'dealer_id', name: 'dealer_id', render: function ( data,type,row,meta) {
                        return  '<a class="link" href="dealer-details/'+row['dealer_id']+'" title="dealer details">'+row['dealer_id']+'<a/>' ;
                    }  },
                    { data: 'image', name: 'image',searchable: false, sortable: false , render: function ( data, type, row, meta ) {
                        var value = '/images/no-car.png';;
                        if(row['images'].length > 0 && row['images'][0]['image'].trim() != '') {

                                value = row['images'][0]['image'];
                        }

                        return  '<img width="20%" class="img-thumbnail" src="'+value+'" alt="image" />' ;
                      }
                    },
                    { data: 'type', name: 'type' },
                    { data: 'model', name: 'model' },
                    { data: 'modelnumber', name: 'modelnumber' },
                    { data: 'googleadwordslink', name: 'modelnumber',render: function ( data, type, row, meta ) {
                        return base_url+"/car/"+row['dealer']['dealer_slug']+"/"+row['dealer']['zip']+"/"+row["vin"]+"?googlead=true" ;
                    }
                    },
                    { data: 'year', name: 'year' },
                ]
            });
        });
    </script>
@stop