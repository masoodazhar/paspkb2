@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
 @if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
<form action="@if(isset($singleRow)) {{ route('otdsummaryofproceedings.update', ['otdsummaryofproceeding'=>$singleRow->id ]) }} @else {{ route('otdsummaryofproceedings.store') }} @endif" method="post" enctype="multipart/form-data">
@csrf
@if(isset($singleRow))
{{ method_field('PUT') }}
@endif
  <div class="box-header with-border">
    <h3 class="box-title">  Order of the day(s), Summary of Proceeding, House Debates Form</h3>

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
                    <label for="">Session</label>
                        <select name="sessions_id" id=""  class="form-control">
                            @forelse($sessions as $assembly)
                                <option value="{{$assembly->id}}" @if(isset($singleRow)) @if($singleRow->sessions_id == $assembly->id) selected @endif  @endif >{{$assembly->sessionname}} ({{$assembly->fromdate}} - {{$assembly->todate}})</option>
                            @empty
                                <option value="0">No Assembly</option>
                            @endforelse
                        </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for=""> Reference Number (Optional) </label>
                    <input type="text" name="referencenumber" value="@if(isset($singleRow)){{$singleRow->referencenumber}}@endif" id="" class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for=""> Sittings Date</label>
                    <input type="date" name="sittingsdate" value="@if(isset($singleRow)){{$singleRow->sittingsdate}}@endif" id="" class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for=""> Sittings number</label>
                    <input type="text" name="sittingsno" value="@if(isset($singleRow)){{$singleRow->sittingsno}}@endif" id="" class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Types</label>
                    <select name="sittingstype" id="" class="form-control">
                        <option value="(s)" @if(isset($singleRow)) @if($singleRow->sittingstype  == '(s)') selected @endif  @endif >(s)</option>
                        <option value="Summary of Proceedings" @if(isset($singleRow)) @if($singleRow->sittingstype  == 'Summary of Proceedings') selected @endif  @endif>Summary of Proceedings</option>
                        <option value="House Debates" @if(isset($singleRow)) @if($singleRow->sittingstype  == 'House Debates') selected @endif  @endif>House Debates</option>
                        <!-- <option value="Questions">Questions</option> -->
                        <!-- <option value="Resolutions Passed">Resolutions Passed</option> -->
                    </select>
                </div>
            </div>
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
<!-- /.box -->

<!-- Default box -->
<div class="box">

  <div class="box-header with-border">
    <h3 class="box-title">(s), Summary of Proceeding, House Debates</h3>

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
              <th width="40%">Session</th>
              <th width="10%">Sitting Date</th>
              <th width="10%">Sitting Number</th>
              <th width="20%">Sitting Type</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $about)
            <tr>
              <td>{{$about->fromdate}} - {{$about->todate}}</td>
              <td>{{$about->sittingsdate }}</td>
              <td>{{$about->sittingsno }}</td>
              <td>{{$about->sittingstype }}</td>
              <td>
                <a href="{{ route('otdsummaryofproceedings.edit', ['otdsummaryofproceeding' => $about->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('otdsummaryofproceedings.destroy', ['otdsummaryofproceeding'=> $about->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                         <input type="submit" class="btn btn-danger" value="Delete" id="">
                    </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="9" style="text-align:center;">No Data Found</td>
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
