@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
 @if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
<form action="@if(isset($singleRow)) {{ route('webcastlivevideoaudio.update', ['webcastlivevideoaudio'=>$singleRow->id ]) }} @else {{ route('webcastlivevideoaudio.store') }} @endif" method="post" enctype="multipart/form-data">
@csrf
@if(isset($singleRow))
{{ method_field('PUT') }}
@endif

  <div class="box-header with-border">
    <h3 class="box-title">  Webcast Live Video/Audio Form </h3>

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
                  <label for="">Name (short detail) </label>
                  <input type="text" value="@if(isset($singleRow)){{$singleRow->name}}@endif" name="name" class="form-control">
              </div>
          </div> 
          <div class="col-md-3">                  
              <div class="form-group">
                  <label for="">Link </label>
                  <input type="text" value="@if(isset($singleRow)){{$singleRow->link}}@endif" name="link" class="form-control">
              </div>
          </div>  
          <div class="col-md-3">                  
              <div class="form-group">
                  <label for="">Date </label>
                  <input type="text" value="@if(isset($singleRow)){{$singleRow->date}}@endif" name="date" class="form-control">
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

<!-- /.content -->

<!-- Default box -->
<div class="box">

  <div class="box-header with-border">
    <h3 class="box-title">Webcast Live Video/Audio List</h3>

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
              <th width="30%">Name</th>
              <th width="40%">link</th>
              <th width="15%">link</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $parliamentaryyears)
            <tr>
              <td>{{$parliamentaryyears->name}}</td>
              <td><a target="_blank" href="{!! $parliamentaryyears->link !!}">{!! $parliamentaryyears->link !!}</a></td>
              <td>{{$parliamentaryyears->date}}</td>
              <td>
                <a href="{{ route('webcastlivevideoaudio.edit', ['webcastlivevideoaudio' => $parliamentaryyears->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('webcastlivevideoaudio.destroy', ['webcastlivevideoaudio'=> $parliamentaryyears->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
                    @csrf
                    {{ method_field('DELETE') }}                    
                    <input type="submit" class="btn btn-danger" value="Delete" id="">
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" style="text-align:center;">No Data Found</td>
            </tr>
          @endforelse
          </tbody>
        </table>
  </div>

  <!-- /.box-footer-->
</div>

</section>
@stop
