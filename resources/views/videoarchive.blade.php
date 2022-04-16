@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
@if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
<form action="@if(isset($singleRow)) {{ route('videoarchive.update', ['videoarchive'=>$singleRow->id ]) }} @else {{ route('videoarchive.store') }} @endif" method="post" enctype="multipart/form-data">
@csrf
@if(isset($singleRow))
{{ method_field('PUT') }}
@endif

  <div class="box-header with-border">
    <h3 class="box-title">  Video Archive Form </h3>

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
                  <label for="">File </label>
                  <input type="file" value="@if(isset($singleRow)){{$singleRow->file}}@endif" name="file" class="form-control">
              </div>
          </div>         
      </div> 
      <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                  <label for="">Description</label>
                  <textarea  name="description" class="form-control summernote" id="" cols="20" rows="10">@if(isset($singleRow)){{$singleRow->description}}@endif</textarea>
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
    <h3 class="box-title">Video Archive List</h3>

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
              <th width="15%">file</th>
              <th width="40%">Description</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $parliamentaryyears)
            <tr>
              <td>{{$parliamentaryyears->name}}</td>
              <td>{{$parliamentaryyears->file}}</td>
              <td>{!! $parliamentaryyears->description !!}</td>
              <td>
                <a href="{{ route('videoarchive.edit', ['videoarchive' => $parliamentaryyears->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('videoarchive.destroy', ['videoarchive'=> $parliamentaryyears->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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
