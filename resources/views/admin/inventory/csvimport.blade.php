{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row">
        <div class="col-xs-6">
            <h1>Import CSV</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="row {{ isset($_GET['dealer_id']) ? 'hide' : ''  }}">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Map you CSV data</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
            <form action="{{ url()->current() }}" method="POST">
                     @csrf
                     <input type="hidden" name="file" value="<?= $_GET['file'] ?>" />
              <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Database Colums</th>
                        <th>Csv Colums</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($DBcolumns as $colums )
                        <tr>
                        <td>{{ $colums }}</td>
                        <td>
                            
                                <select name="colums[{{ $colums }}]" class="form-control">
                                    <option value="">--Select--</option>
                                    <option value="-1">Not Required</option>
                                    @foreach ($csv_dropdown as $key => $value )
                                        <option {{ $key == $colums ? "selected" : "" }} value={{ $key }}>{{ $value }}</option>   
                                    @endforeach
                                </select>
                        
                        </td>
                    </tr>
                    @endforeach
              </tbody>
              </table>
              <div class="box-footer">
                @if (!empty($_GET['dealer_id']))
                     <input type="hidden" name="dealer_id" value="{{ $_GET['dealer_id'] }}" />  
                @endif
                <input type="hidden" name="process_csv" value="process_csv" />            
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                         </div>
                    </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
     <script> 
        $(".box-body form").submit(function(){
            var url = $(this).attr('action');
            var data = $(this).serialize();
            swal({
            title: 'Importing CSV Data',
            text: '',
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading();
            }
            })

            $.post(url,data,function(data){
                swal.close() 
                if(data.success===false){
                        
                        swal(data.message);
                    }
                    else{
                        location.href = "{{ route('inventories') }}";
                     }
            });

            return false;
        });

    @if (isset($_GET['dealer_id']))
         $(".box-body form").submit();
    @endif

     </script>
@stop