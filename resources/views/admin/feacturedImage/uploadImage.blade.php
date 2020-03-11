@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="margin-left: 17px;">Upload Image</h1>
@stop

@section('content')
    <div class="col-md-12">
        <!-- Horizontal Form -->

        <!-- /.box -->
        <!-- general form elements disabled -->
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Upload Feacture Image Form</h3>
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
                <form action="{{route("upload-feactured-image")}}" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" value="{{ !empty($getdata) ? $getdata->title : "" }}" />
                    </div>
                    <div class="form-group">
                        <label>description</label>
                        <textarea name="description" class="form-control" rows="6" cols="50">{{!empty($getdata) ? $getdata->description : ""}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image" value="{{ old('image') }}" id="imgInp"/>
                        <?php $image = !empty($getdata) ? $getdata->image : "";?>
                    </div>
                    <img id="blah" src="{{asset('new_ui/feactureImage/'.$image)}}" style="width: 200px;height: 100px">
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

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> 
        function readURL(input) {

            if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
            }
          }

        $("#imgInp").change(function() {
          readURL(this);
        });
    </script>
@stop