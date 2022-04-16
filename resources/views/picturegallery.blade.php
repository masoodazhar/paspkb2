@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
 @if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
<form action="@if(isset($singleRow)) {{ route('picturegallery.update', ['picturegallery'=>$singleRow->id ]) }} @else {{ route('picturegallery.store') }} @endif" method="post" enctype="multipart/form-data">
@csrf
@if(isset($singleRow))
{{ method_field('PUT') }}
@endif

  <div class="box-header with-border">
    <h3 class="box-title">  Picture Gallery Form </h3>

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
                    <label for="">Date</label>
                    <input type="date" value="@if(isset($singleRow)){{$singleRow->date}}@endif" name="date" class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for=""> Title </label>
                    <input type="text" value="@if(isset($singleRow)){{$singleRow->title}}@endif" name="title" class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for=""> Page </label>
                    <select name="page" id="" class="form-control">
                      <option value="Picture Gallery" @if(isset($singleRow))@if($singleRow->page == 'Picture Gallery') selected @endif @endif>Picture Gallery</option>
                      <option value="Speaker" @if(isset($singleRow))@if($singleRow->page == 'Speaker') selected @endif @endif>Speaker</option>
                      <option value="Deputy Speaker" @if(isset($singleRow))@if($singleRow->page == 'Deputy Speaker') selected @endif @endif>Deputy Speaker</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for=""> Image </label>
                    <input type="file" value="@if(isset($singleRow)){{$singleRow->image}}@endif" name="image" class="form-control">
                </div>
            </div>

            <div class="col-md-12">                  
                <div class="form-group">
                    <label for=""> Description </label>
                    
                    <textarea name="description" class="form-control summernote" id="" cols="20" rows="10">@if(isset($singleRow)){{$singleRow->description}}@endif</textarea>
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
    <h3 class="box-title">Picture Gallery List</h3>

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
              <th width="30%">Image</th>
              <th width="10%">Date</th>
              <th width="10%">Title</th>
              <th width="10%">Page</th>
              <th width="10%">Description</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $parliamentaryyears)
            <tr>
              <td><a href="{{ url('public/uploads') }}/{{$parliamentaryyears->image}}" target="_blank"><img src="{{ url('uploads') }}/{{$parliamentaryyears->image}}" alt="" width="50"></a></td>
              <td>{{$parliamentaryyears->date}}</td>
              <td>{{$parliamentaryyears->title}}</td>
              <td>{{$parliamentaryyears->page}}</td>
              <td>{!! $parliamentaryyears->description !!}</td>
              <td>
                <a href="{{ route('picturegallery.edit', ['picturegallery' => $parliamentaryyears->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('picturegallery.destroy', ['picturegallery'=> $parliamentaryyears->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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
