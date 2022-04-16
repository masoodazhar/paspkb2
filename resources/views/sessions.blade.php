
@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
 @if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
<form action="@if(isset($singleRow)) {{ route('sessions.update', ['session'=>$singleRow->id ]) }} @else {{ route('sessions.store') }} @endif" method="post" enctype="multipart/form-data">
@csrf
@if(isset($singleRow))
{{ method_field('PUT') }}
@endif
  <div class="box-header with-border">
    <h3 class="box-title">  Session Form  </h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
   
        <div class="row">
            <div class="col-md-3">                  
                    <div class="form-group">
                        <label for=""> Session (In) </label>
                        <select name="main_sessions_id" id=""  class="form-control">
                            @forelse($mainSessions as $assembly)
                                <option value="{{$assembly->id}}" @if(isset($singleRow)) @if($singleRow->main_sessions_id == $assembly->id) selected @endif  @endif >{{$assembly->sessionname}}</option>
                            @empty
                                <option value="0">No Session</option>
                            @endforelse
                        </select>
                    </div>
                </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">From Date</label>
                    <input type="text" class="form-control" value="@if(isset($singleRow)){{$singleRow->fromdate}}@endif"  name="fromdate">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">To Date</label>
                    <input type="text" class="form-control" value="@if(isset($singleRow)){{$singleRow->todate}}@endif"  name="todate">
                </div>
            </div>
        </div>
 
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <input type="submit" class="btn btn-primary" value="Submit">
  </div>
</form>
<br>
@foreach($errors->all() as $error)
<div class="alert alert-danger"> {{$error}} </div>
@endforeach 
  <!-- /.box-footer-->
</div>
<!-- /.box -->

<!-- Default box -->
<div class="box">

  <div class="box-header with-border">
    <h3 class="box-title">List of Members Form</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
        <table class="table table-light">
          <thead class="thead-light">
            <tr>
              <th width="%">Session</th>
              <th width="%">From Date</th>
              <th width="%">To Date</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $about)
            <tr>
              <td>{{$about->sessionname }}</td>
              <td>{{$about->fromdate }}</td>
              <td>{{$about->todate }}</td>
              <td>
                <a href="{{ route('sessions.edit', ['session' => $about->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('sessions.destroy', ['session'=> $about->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                         <input type="submit" class="btn btn-danger" value="Delete" id="">
                    </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="9" style="text-align:center;">No Data Found</td>
            </tr>
          @endforelse
          </tbody>
        </table>
  </div>

  <!-- /.box-footer-->
</div>
<!-- /.box -->
</section>
<!-- /.content -->

@stop
