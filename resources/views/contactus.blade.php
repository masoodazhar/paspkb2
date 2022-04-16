@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
@if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
<form action="{{ route('contactusupdate') }}" method="post">
                @csrf
                {{ method_field('PUT') }}
            

  <div class="box-header with-border">
    <h3 class="box-title">Contact Us Form</h3>

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
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="">Address</label>
                      <input value="{{$singleRow->address}}" type="text" name="address" class="form-control">
                  </div>                
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="">Phone</label>
                      <input value="{{$singleRow->phone}}" type="text" name="phone" class="form-control">
                  </div>                
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="">Fax</label>
                      <input value="{{$singleRow->fax}}" type="text" name="fax" class="form-control">
                  </div>                
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="">Mail From</label>
                      <input value="{{$singleRow->mailfrom}}" type="text" name="mailfrom" class="form-control">
                  </div>                
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="">Mail To</label>
                      <input value="{{$singleRow->mailto}}" type="text" name="mailto" class="form-control">
                  </div>                
              </div>
          </div>
 
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <input type="submit" class="btn btn-primary" value="save">
  </div>
</form>
<br>
@foreach($errors->all() as $error)
<div class="alert alert-danger"> {{$error}} </div>
@endforeach  
  <!-- /.box-footer-->
</div>
<!-- /.box -->


<!-- /.box -->
</section>
<!-- /.content -->

@stop