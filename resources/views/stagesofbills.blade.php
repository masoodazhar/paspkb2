@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
  @if($message = Session::get('success'))
    <div class="alert alert-success"> {{ $message }} </div>
  @endif
<!-- Default box -->
<div class="box">
<form action="{{ route('stagesofbills.update', ['stagesofbill'=>$singleRows->id ]) }}" method="post">
                @csrf                
                {{ method_field('PUT') }}
  <div class="box-header with-border">
    <h3 class="box-title">Stages of Bills Form</h3>

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
              <div class="col-md-12">
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control summernote" id="" cols="20" rows="10">@if(isset($singleRows)){{$singleRows->description}}@endif</textarea>
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

</section>
<!-- /.content -->

@stop