@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
 @if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
<form action="@if(isset($singleRow)) {{ route('pressreleases.update', ['pressrelease'=>$singleRow->id ]) }} @else {{ route('pressreleases.store') }} @endif" method="post" enctype="multipart/form-data">
@csrf
@if(isset($singleRow))
{{ method_field('PUT') }}
@endif

  <div class="box-header with-border">
    <h3 class="box-title">  Press Release, News & Activities Form </h3>
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
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" value="@if(isset($singleRow)){{$singleRow->name}}@endif">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Date</label>
                    <input type="date" class="form-control" name="date" value="@if(isset($singleRow)){{$singleRow->date}}@endif">
                </div>
            </div>
            <div class="col-md-3 frontimage" style="display:none">                  
                <div class="form-group">
                    <label for="">Front Image</label>
                    <input type="file" class="form-control" name="image">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Type (Page)</label>
                    <select name="page" id="" class="form-control pagetype">
                        <option value="Press Release" @if(isset($singleRow))@if($singleRow->page == 'Press Release') selected @endif @endif >Press Release</option>
                        <option value="News and Activities" @if(isset($singleRow))@if($singleRow->page == 'News and Activities') selected @endif @endif >News and Activities</option>
                    </select>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Document Type</label>
                    <select name="type" id="typeofdocs" class="form-control">
                      <option value="pdf" @if(isset($singleRow)) @if($singleRow->type == "pdf") selected @endif  @endif>PDF</option>
                      <option value="jpg" @if(isset($singleRow)) @if($singleRow->type == "jpg") selected @endif  @endif>JPG</option>
                      <option value="png" @if(isset($singleRow)) @if($singleRow->type == "png") selected @endif  @endif>PNG</option>
                      <option value="text" @if(isset($singleRow)) @if($singleRow->type == "text") selected @endif  @endif>Text (Description)</option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Image, PDF, Link</label>
                    <input type="file" class="form-control" name="image_pdf_link">
                </div>
            </div>
            
        </div>
        <div class="row">
              <div class="col-md-12">                  
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="image_pdf_link" class="form-control summernote" id="" cols="20" rows="10">@if(isset($singleRow)){{$singleRow->image_pdf_link}}@endif</textarea>
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

<!-- Default box -->
<div class="box">

  <div class="box-header with-border">
    <h3 class="box-title">Press Release, News & Activities List</h3>

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
              <th width="25%">Name</th>
              <th width="10%">Date</th>
              <th width="10%">Type</th>
              <th width="10%">Page</th>
              <!-- <th width="30%">Detail</th> -->
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $parliamentaryyears)
            <tr>
              <td>{{$parliamentaryyears->name}}</td>
              <td>{{$parliamentaryyears->date}}</td>
              <td>{{$parliamentaryyears->type}}</td>
              <td>{{$parliamentaryyears->page}}</td>
              <!-- <td>{!! $parliamentaryyears->image_pdf_link !!}</td> -->
              <td>
                <a href="{{ route('pressreleases.edit', ['pressrelease' => $parliamentaryyears->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('pressreleases.destroy', ['pressrelease'=> $parliamentaryyears->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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
@stop
