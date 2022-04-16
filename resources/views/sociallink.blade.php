@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
@if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
<form action="{{ route('sociallinkupdate', app()->getLocale()) }}" method="post">
                @csrf
                {{ method_field('PUT') }}
            

  <div class="box-header with-border">
    <h3 class="box-title">Social Links Form</h3>

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
                      <label for="">Facebook</label>
                      <input value="{{$singleRow->facebook}}" type="text" name="facebook" class="form-control">
                  </div>                
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="">Youtube</label>
                      <input value="{{$singleRow->youtube}}" type="text" name="youtube" class="form-control">
                  </div>                
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="">Twitter</label>
                      <input value="{{$singleRow->twitter}}" type="text" name="twitter" class="form-control">
                  </div>                
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="">Linkedin</label>
                      <input value="{{$singleRow->linkedin}}" type="text" name="linkedin" class="form-control">
                  </div>                
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="">Google</label>
                      <input value="{{$singleRow->google}}" type="text" name="google" class="form-control">
                  </div>                
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="">calendar year</label>
                      <input value="{{$singleRow->calendar_year}}" type="text" name="calendar_year" class="form-control">
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