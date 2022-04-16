@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
@if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
        <form action="@if(isset($singleRow)){{ route('acts.update', ['act'=>$singleRow->id ]) }} @else {{ route('acts.store') }} @endif" method="post" enctype="multipart/form-data">
            @csrf
            @if(isset($singleRow))
            {{ method_field('PUT') }}
            @endif
  <div class="box-header with-border">
    <h3 class="box-title">  Acts Form </h3>

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
                    <label for="">Assembly Tenure</label>
                    <select name="assembly_tenures_id" id="" class="form-control">
                        @forelse($assemblyTenure as $assemblytenure)
                        <option value="{{$assemblytenure->id}}" @if(isset($singleRow)) @if($singleRow->assembly_tenures_id == $assemblytenure->id) selected @endif  @endif >{{$assemblytenure->fromdate}} To {{$assemblytenure->todate}} </option>
                        @empty
                        <option value="0">No Assembly</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Parliamentary Years</label>
                    <select name="parliamentary_years_id" id="" class="form-control">
                        @forelse($parliamentaryYears as $assemblytenure)
                        <option value="{{$assemblytenure->id}}" @if(isset($singleRow)) @if($singleRow->parliamentary_years_id == $assemblytenure->id) selected @endif  @endif >{{$assemblytenure->name}}</option>
                        @empty
                        <option value="0">No Assembly</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Session</label>
                    <select name="sessions_id" id="" class="form-control">
                        @forelse($sessions as $assemblytenure)
                        <option value="{{$assemblytenure->id}}" @if(isset($singleRow)) @if($singleRow->sessions_id == $assemblytenure->id) selected @endif  @endif >{{$assemblytenure->fromdate}} To {{$assemblytenure->todate}}</option>
                        @empty
                        <option value="0">No Assembly</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for=""> Sittings</label>
                    <select name="order_of_the_day_summary_of_proceedings_id" id="" class="form-control">
                        @forelse($orderOfTheDaySummaryOfProceedings as $assemblytenure)
                        <option value="{{$assemblytenure->id}}" @if(isset($singleRow)) @if($singleRow->order_of_the_day_summary_of_proceedings_id == $assemblytenure->id) selected @endif  @endif > {{$assemblytenure->sittingsno}} </option>
                        @empty
                        <option value="0">No Assembly</option>
                        @endforelse
                    </select>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Act No.</label>
                    <input type="text" class="form-control" value="@if(isset($singleRow)){{$singleRow->actno}}@endif "  name="actno">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" class="form-control" value="@if(isset($singleRow)){{$singleRow->title}}@endif"  name="title">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Date of Passing</label>
                    <input type="date" class="form-control" value="@if(isset($singleRow)){{$singleRow->dateofpassing}}@endif"  name="dateofpassing">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Date of Governers' Assent</label>
                    <input type="date" class="form-control" value="@if(isset($singleRow)){{$singleRow->dateofgov}}@endif"  name="dateofgov">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Document Type (Image, PDF, Text)</label>
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
                    <label for=""> (Image, PDF, Text)</label>
                    <input type="file" class="form-control"  name="image_pdf_link">
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
    <h3 class="box-title">Acts Data</h3>

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
              <th width="15%">Assembly Tenure</th>
              <th width="15%">Session</th>
              <th width="10%">Sitting</th>
              <th width="10%">Act No</th>
              <th width="10%">Title</th>
              <th width="10%">Date of Passing</th>
              <th width="15%">Date of Governers' Assent</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $parliamentaryyears)
            <tr>
              <td>{{$parliamentaryyears->fromdate}} to {{$parliamentaryyears->todate}}</td>
              <td>{{$parliamentaryyears->sessionsfromdate}} to {{$parliamentaryyears->sessionstodate}}</td>
              <td>{{$parliamentaryyears->sittingsno }}</td>
              <td>{{$parliamentaryyears->actno}}</td>
              <td>{{$parliamentaryyears->title}}</td>
              <td>{{$parliamentaryyears->dateofpassing}}</td>
              <td>{{$parliamentaryyears->dateofgov}}</td>
              <td>
                <a href="{{ route('acts.edit', ['act' => $parliamentaryyears->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('acts.destroy', ['act'=> $parliamentaryyears->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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
</section>
<!-- /.content -->

@stop
