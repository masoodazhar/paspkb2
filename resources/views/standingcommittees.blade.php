@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
 @if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
    <form action="{{route('standingcommittees.update', ['standingcommittee'=>1 ])}}" method="post"> 
      <div class="box-body">
          @csrf
          {{ method_field('PUT') }}
          <input type="hidden" name="check" value="true">
          <div class="box-header with-border">
    <h3 class="box-title">  Standing Committees Members Form </h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
          <div class="row">
              <div class="col-md-3">
                  <div class="form-group">
                      <label for=""> Select Standing Committee (heading) </label>
                      <select name="acc_id" id=""  class="form-control">
                          @forelse($headings as $assembly)
                              <option value="{{$assembly->id}}" @if(isset($singleRow)) @if($singleRow->acc_id == $assembly->id) selected @endif @endif  >{{$assembly->category}}</option>
                          @empty
                              <option value="0">No Heading</option>
                          @endforelse
                      </select>
                  </div>
              </div>            
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="">Assign Chairperson To Standing Committee</label>
                      <select name="members_directories_id[]" id="" class="form-control" multiple>
                          @forelse($memberDirectories as $assemblytenure)
                          <option value="{{$assemblytenure->id}}" @if(isset($singleRow)) @if($singleRow->members_directories_id == $assemblytenure->id) selected @endif  @endif > {{$assemblytenure->name}} </option>
                          @empty
                          <option value="0">No Members</option>
                          @endforelse
                      </select>
                  </div>
              </div>          
          </div>
      </div>
      <div class="box-footer">
          <input type="submit" class="btn btn-primary" value="Submit">
          <a href="{{ route('standingcommitteescategory.index') }}" class="btn btn-success">View all Members assigned to above headings</a> 
      </div>
    </form>
</div>
<div class="box">

  <div class="box-header with-border">
    <h3 class="box-title">Standing Committee | <a href="{{ route('standingcommitteescategory.index') }}"> <i class="fa fa-plus"></i> Create New Standing Committee</a> </h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
  <form action="@if(isset($singleRow)){{ route('standingcommittees.update', ['standingcommittee'=>$singleRow->id ]) }} @else {{ route('standingcommittees.store') }} @endif" method="post" enctype="multipart/form-data">
            @csrf
            @if(isset($singleRow))
            {{ method_field('PUT') }}
            @endif
            <div class="row">
                 <div class="col-md-3">
                    <div class="form-group">
                        <label for=""> Standing Committee (heading) </label>
                        <select name="standing_committees_categories_id" id=""  class="form-control">
                            @forelse($headings as $assembly)
                                <option value="{{$assembly->id}}" @if(isset($singleRow)) @if($singleRow->standing_committees_categories_id == $assembly->id) selected @endif @endif  >{{$assembly->category}}</option>
                            @empty
                                <option value="0">No Member Directory</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Select Page (Tab), to display</label>
                        <select name="tab_type" id="" class="form-control">
                            <option value="Business Referred">Business Referred</option>
                            <option value="Reports">Reports</option>
                            <option value="Sub Committees">Sub Committees</option>
                            <option value="Notifications">Notifications</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Title</label>
                       <input type="text" class="form-control" name="title" value="@if(isset($singleRow)){{$singleRow->title}}@endif">
                    </div>
                </div> 
                      
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Document Type</label>
                        <select name="type" id="" class="form-control">
                            <option value="pdf" @if(isset($singleRow)) @if($singleRow->type == "pdf") selected @endif  @endif>PDF</option>
                            <option value="jpg" @if(isset($singleRow)) @if($singleRow->type == "jpg") selected @endif  @endif>JPG</option>
                            <option value="png" @if(isset($singleRow)) @if($singleRow->type == "png") selected @endif  @endif>PNG</option>
                            <option value="text" @if(isset($singleRow)) @if($singleRow->type == "text") selected @endif  @endif>Text (Description)</option>
                        </select>
                    </div>
                </div>
                </div>
              <div class="row"> 
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Image, PDF, Link</label>
                        <input type="file" name="image_pdf_link" class="form-control">
                    </div>
                </div>        
                <div class="col-md-12">                  
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="image_pdf_link" class="form-control summernote" id="" cols="20" rows="10">@if(isset($singleRow)){{$singleRow->image_pdf_link}}@endif</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <input type="submit" class="btn btn-primary" value="save Changes">
                </div>
            </div>
        </form>
        <br>       
@foreach($errors->all() as $error)
<div class="alert alert-danger"> {{$error}} </div>
@endforeach  
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    
  </div>

  <!-- /.box-footer-->
</div>
<!-- /.box -->

<!-- Default box -->
<div class="box">

  <div class="box-header with-border">
    <h3 class="box-title">Assembly Form</h3>

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
              <th width="60%">Title</th>
              <th width="10%">Tab Name</th>
              <th width="10%">Type</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $about)
            <tr>
              <td>{{$about->title}}</td>
              <td>{{$about->tab_type}}</td>
              <td>{{$about->type}}</td>
              <td>
                <a href="{{ route('standingcommittees.edit', ['standingcommittee' => $about->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('standingcommittees.destroy', ['standingcommittee'=> $about->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
                        @csrf
                        {{ method_field('DELETE') }}                      
                         <input type="submit" class="btn btn-danger" value="Delete" id="">                       
                    </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" style="text-align:center;">No Data Found</td>
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