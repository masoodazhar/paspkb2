@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
 @if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">

  <div class="box-header with-border">
    <h3 class="box-title">Deputy Speakers Form</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
        <form action="{{ route('deputyspeaker.update', ['deputyspeaker'=>$singleRowMain->id ])}} " method="post">
            @csrf
            {{ method_field('PUT') }}
            <input type="hidden" name="check" value="true">
            <div class="row">
            <div class="col-md-3">                  
                    <div class="form-group">
                        <label for=""> Assembly  </label>
                        <select name="assembly_id" id=""  class="form-control">
                            @forelse($assembly as $assembly)

                                <option value="{{$assembly->id}}" @if(isset($singleRowMain)) @if($singleRowMain->assembly_id == $assembly->id) selected @endif  @endif >{{$assembly->name}}</option>
                            @empty
                                <option value="0">No Assembly</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for=""> Members (Select Speaker) </label>
                        <select name="members_directories_id" id=""  class="form-control">
                            @forelse($memberDirectories as $assembly)
                                <option value="{{$assembly->id}}" @if($singleRowMain->members_directories_id == $assembly->id) selected @endif  >{{$assembly->name}}</option>
                            @empty
                                <option value="0">No Member Directory</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for=""> Members (Select Former Speaker) </label>
                        <select name="members_directories_ids[]" id=""  class="form-control" multiple required>
                            @forelse($memberDirectories as $assembly)
                                <option value="{{$assembly->id}}" @if($singleRowMain)@if(in_array($assembly->id, json_decode($singleRowMain->members_directories_ids)) ) selected @endif @endif  >{{$assembly->name}}</option>
                            @empty
                                <option value="0">No Member Directory</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-12">                  
                    <div class="form-group">
                        <label for="">Speaker Message</label>
                        <textarea name="speakermessage" class="form-control summernote" id="" cols="20" rows="10">{{$singleRowMain->speakermessage}}</textarea>
                    </div>
                </div>
                <div class="col-md-12">                  
                    <div class="form-group">
                        <label for="">Speaker's Role in the Assembly</label>
                        <textarea name="speakersrole" class="form-control summernote" id="" cols="20" rows="10">{{$singleRowMain->speakersrole}}</textarea>
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
        <div class="row">
            <div class="col-md-12">
                <p>NEWS & ACTIVITIES</p>
            </div>
        </div>
        <hr>
        <form action="@if(isset($singleRow)) {{ route('deputyspeaker.update', ['deputyspeaker'=>$singleRow->id ]) }} @else {{ route('deputyspeaker.store') }} @endif" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($singleRow))
                {{ method_field('PUT') }}
                @endif
      
                <input type="hidden" name="check" value="false">
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">name </label>
                        <input type="text" name="name" value="@if(isset($singleRow)){{$singleRow->name}}@endif"  class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Date </label>
                        <input type="date" name="date" value="@if(isset($singleRow)){{$singleRow->date}}@endif"  class="form-control">
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
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Image, PDF, Link</label>
                        <input type="file" name="image_pdf_link" class="form-control">
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
            <input type="submit" class="btn btn-primary" value="Save">
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
    <h3 class="box-title">Deputy Speakers Data</h3>

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
              <th width="10%">ID</th>
              <th width="50%">Heading</th>
              <th width="10%">Type</th>
              <th width="10%">date</th>
              <th width="20%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $about)
          <tr>
              <td>{{$about->id}}</td>
              <td>{{$about->name}}</td>
              <td>{{$about->type}}</td>
              <td>{{$about->date}}</td>
              <td>
                <a href="{{ route('speakers.edit', ['speaker' => $about->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('speakers.destroy', ['speaker'=> $about->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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