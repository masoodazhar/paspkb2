@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
 @if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
<form action="@if(isset($singleRow)) {{ route('committeesystemdetail.update', ['committeesystemdetail'=>$singleRow->id ]) }} @else {{ route('committeesystemdetail.store') }} @endif" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($singleRow))
                {{ method_field('PUT') }}
                @endif
              <div class="box-header with-border">
                <h3 class="box-title">Committee System Detail Form</h3>

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
                          <label for="">Heading (Name)</label>
                          <input type="text" value="@if(isset($singleRow)){{$singleRow->heading}}@endif" name="heading" class="form-control">
                      </div>
                  </div>
                  <div class="col-md-3">                  
                      <div class="form-group">
                          <label for=""> Bill Type </label>
                          <select name="type" id=""  class="form-control">
                              <option value="pdf" @if(isset($singleRow)) @if($singleRow->type == "pdf") selected @endif  @endif>PDF</option>
                              <option value="jpg" @if(isset($singleRow)) @if($singleRow->type == "jpg") selected @endif  @endif>JPG</option>
                              <option value="png" @if(isset($singleRow)) @if($singleRow->type == "png") selected @endif  @endif>PNG</option>
                              <option value="text" @if(isset($singleRow)) @if($singleRow->type == "text") selected @endif  @endif>Text (Description)</option>
              
                          </select>   
                      </div>
                  </div>
                  <div class="col-md-3">                  
                    <div class="form-group">
                        <label for=""> Select File </label>
                        <input type="file" name="description" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Description</label>
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

<!-- Default box -->
<div class="box">

  <div class="box-header with-border">
    <h3 class="box-title">Committee System Detail </h3>

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
              <th width="5%">ID</th>
              <th width="20%">Heading</th>
              <!-- <th width="60%">Description</th> -->
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $about)
            <tr>
              <td>{{$about->id}}</td>
              <td>{{$about->heading}}</td>
              <!-- <td>{!! $about->description !!}</td> -->
              <td>
                <a href="{{ route('committeesystemdetail.edit', ['committeesystemdetail' => $about->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('committeesystemdetail.destroy', ['committeesystemdetail'=> $about->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                      
                         <input type="submit" class="btn btn-danger" value="Delete" id="">
                       
                    </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="3" style="text-align:center;">No Data Found</td>
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