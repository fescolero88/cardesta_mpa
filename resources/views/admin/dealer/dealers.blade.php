{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row">
        <div class="col-xs-4 col-lg-6">
            <h1 class="mar-zero">Dealers List</h1>
        </div>




        <div class="col-xs-8 col-lg-3 col-lg-offset-3">
            <div class="form-group" style="display: flex">
                <div class="input-group col-lg-12">
                    <form action="{{'dealers'}}" method="get" >
                        @csrf
                    <input type="text" class="form-control addon-form-style radius-form" name="search" value="{{$_GET['search']??''}}" placeholder="Search dealer">

                </div>
                <button class="btn btn-primary btn-lg left-right-radius-zero search-btn-height" type="submit">
                    <i class="glyphicon glyphicon-search"></i>
                </button>
                </form>
            </div>
        </div>


        <div class="col-xs-1 col-lg-12">
            <div class="pull-right" style="width: 150px;">
                    <a type="button" href="{{route('adddealerform')}}" class="btn btn-block btn-primary">Add Dealer</a>
            </div>
        </div>
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" style="width:100%">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('success') }}
                </div>
            @elseif(session('fail'))
                <div class="alert alert-success alert-dismissible" style="width:100%">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('fail') }}
                </div>
            @endif
        </div>

    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Lead Email</th>
                            <th>Phone</th>
                            <th>Call Track No</th>
                            <th>Google adwords link</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($dealers)>0)
                            @foreach($dealers as $dealer)
                                <tr>
                                    <td><a class="link" href="{{route('dealer-details', ['id' => $dealer->dealer_id])}}" title="dealer details">{{$dealer->dealer_id}}</a></td>
                                    <td>{{$dealer->name}}</td>
                                    <td>{{$dealer->email}}</td>
                                    <td>{{$dealer->lead_email}}</td>
                                    <td>{{$dealer->phone}}</td>
                                    <td>{{$dealer->call_tracking_no}}</td>
                                    <td>{{ url()->to('/')}}/inventory/{{$dealer->dealer_slug}}/{{$dealer->dealer_id}}/{{$dealer->zip}}?googlead=true</td>
                                    <td>
                                        <a href="{{route('editdealerform', ['id' => $dealer->id])}}" ><i class="fa fa-edit" title="edit"></i></a>
                                        <a href="#" id="{{$dealer->id}}" onclick="deleteconfirmation(this);" ><i class="fa fa-trash-o" title="delete"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td>No Dealers</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                {{$dealers->links()}}
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{remote_asset('/css/admin_custom.css')}}">
    <style>
        #custom-search-input{
            padding: 3px;
            border: solid 1px #E4E4E4;
            border-radius: 6px;
            background-color: #fff;
        }

        #custom-search-input input{
            border: 0;
            box-shadow: none;
        }

        #custom-search-input button{
            margin: 2px 0 0 0;
            background: none;
            box-shadow: none;
            border: 0;
            color: #666666;
            padding: 0 8px 0 10px;
            border-left: solid 1px #ccc;
        }

        #custom-search-input button:hover{
            border: 0;
            box-shadow: none;
            border-left: solid 1px #ccc;
        }

        #custom-search-input .glyphicon-search{
            font-size: 23px;
        }
        .addon-form-style{ min-height:45px;}
        .left-right-radius-zero{border-top-left-radius: 0px;
            border-bottom-left-radius: 0px;}
        .search-btn-height{height:45px;}
    </style>
@stop

@section('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function deleteconfirmation(obj){
            alert('sfdsaf');
            bootstrap_confirm_delete({
                heading: 'Delete',
                message: 'Are you sure you want to delete this item?',
                data_type: null,
            });
        }

        function deleteconfirmation(obj){
            id = $(obj).attr('id');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this record!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href="/admin/"+id+"/delete-dealer";
                    }
                });
        }

    </script>
@stop