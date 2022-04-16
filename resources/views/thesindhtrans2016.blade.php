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
    <h3 class="box-title">The Sindh Transparency and Right to Informatio Act, 2016  Form</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
  <form action="{{ route('thesindhtrans2016.update', ['thesindhtrans2016'=>$singleRowMain->id ]) }}" method="post">
                @csrf
                {{ method_field('PUT') }}
              <input type="hidden" value="true" name="check">
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Subject </label>
                        <input type="text" name="subject"  value="{{$singleRowMain->subject}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Act No </label>
                        <input type="text" name="actno"  value="{{$singleRowMain->actno}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Passed On </label>
                        <input type="text" name="passedon"  value="{{$singleRowMain->passedon}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Date of Enforcement </label>
                        <input type="text" name="dateofenforcement"  value="{{$singleRowMain->dateofenforcement}}" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <input type="submit" class="btn btn-primary" value="save Changes">
                </div>
            </div>
        </form>
        <hr>
        <br>
        <form action="@if(isset($singleRow)) {{ route('thesindhtrans2016.update', ['thesindhtrans2016'=>$singleRow->id ]) }} @else {{ route('thesindhtrans2016.store') }} @endif" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($singleRow))
                {{ method_field('PUT') }}
                @endif
        <input type="hidden" value="false" name="check">
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">name </label>
                        <input type="text" name="name" value="@if(isset($singleRow)){{$singleRow->name}}@endif" class="form-control">
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
    <h3 class="box-title">The Sindh Transparency and Right to Informatio Act, 2016  Data</h3>

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
              <th width="20%">Heading</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $about)
            <tr>
              <td>{{$about->id}}</td>
              <td>{{$about->name}}</td>
              <td>
                @if($about->type == 'pdf' || $about->type == 'jpg' || $about->type == 'png')
                <a href="{{ url('uploads') }}/{{$about->image_pdf_link}}" target="_blank" class="btn btn-success">View</a> 
                @else

                <a href="{{ route('thesindhtrans2016.edit', ['thesindhtrans2016' => $about->id]) }}" class="btn btn-success">View</a> 
                @endif
                <a href="{{ route('thesindhtrans2016.edit', ['thesindhtrans2016' => $about->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('thesindhtrans2016.destroy', ['thesindhtrans2016'=> $about->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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