@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
 @if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
<form action="@if(isset($singleRow)) {{ route('pastassemblymembers.update', ['pastassemblymember'=>$singleRow->id ]) }} @else {{ route('pastassemblymembers.store') }} @endif" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($singleRow))
                {{ method_field('PUT') }}
                @endif
  <div class="box-header with-border">
    <h3 class="box-title">  Past Assembly Members Form</h3>

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
                        <label for=""> Assembly Tenure  </label>
                        <select name="assemblytenures_id" id=""  class="form-control">
                            @forelse($assemblyTenure as $assemblytenure)

                                <option value="{{$assemblytenure->id}}" @if(isset($parliamentaryyearsData)) @if($parliamentaryyearsData->assemblytenures_id == $assemblytenure->id) selected @endif  @endif >{{$assemblytenure->fromdate}} To {{$assemblytenure->todate}} </option>
                            @empty
                                <option value="0">No Assembly</option>
                            @endforelse
                        </select>
                    </div>
                </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">name </label>
                    <input type="text" name="name"  value="@if(isset($singleRow)){{$singleRow->name}}@endif" class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">From </label>
                    <select name="fromdate" id="typeofdocs" class="form-control">
                        <?php
                        for($year=1930; $year<=date('Y'); $year++){
                          $selected = '';

                          if(isset($singleRow) && $singleRow->fromdate==$year){
                            $selected1='selected="selected"';
                          }else{
                            $selected1='';
                          }
                          ?>
                            <option <?php echo $selected1; ?> value="<?=$year?>"><?=$year?></option>
                          <?php 
                            }
                         ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">To </label>
                    <select name="todate" id="typeofdocs" class="form-control">
                        <?php
                        for($year=1930; $year<=date('Y'); $year++){
                          $selected = '';

                          if(isset($singleRow) && $singleRow->todate==$year){
                            $selected='selected="selected"';
                          }else{
                            $selected='';
                          }

                          ?>
                            <option <?php echo $selected; ?> value="<?=$year?>"><?=$year?></option>
                          <?php 
                            }
                         ?>
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
            <div class="col-md-3" >                  
                <div class="form-group" id="selectfile">
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
    <h3 class="box-title">Past Assembly Members List</h3>

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
              <th width="5%">Type</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $about)
            <tr>
              <td>{{$about->id}}</td>
              <td>{{$about->name}}</td>
              <td>{{$about->type}}</td>
              <td>
                <a href="{{ route('pastassemblymembers.edit', ['pastassemblymember' => $about->id]) }}" class="btn btn-primary">Edit & View</a> 
                <form style="width: 47%; float: right;" action="{{ route('pastassemblymembers.destroy', ['pastassemblymember'=> $about->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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
<script>
$(function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy'});
});​
</script>

@stop

