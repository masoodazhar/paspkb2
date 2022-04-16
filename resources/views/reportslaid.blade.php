@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
 @if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
<form action="@if(isset($singleRow)) {{ route('reportslaid.update', ['reportslaid'=>$singleRow->id ]) }} @else {{ route('reportslaid.store') }} @endif" method="post" enctype="multipart/form-data">
@csrf
@if(isset($singleRow))
{{ method_field('PUT') }}
@endif
               
  <div class="box-header with-border">
    <h3 class="box-title">  Organizational Chart Form</h3>

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
                    <select name="assembly_tenures_id" id=""  class="form-control">
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
                    <label for="">Committee Type</label>
                    <select class="form-control" name="committee">
                            <option value="All">All</option>
                            <option value="Law">Law</option>
                            <option value="Special Committee No.1">Special Committee No.1</option>
                            <option value="Special Committee No.2">Special Committee No.2</option>
                            <option value="Special Committee No.3">Special Committee No.3</option>
                            <option value="Special Committee No. 10"> Special Committee No. 10</option>
                            <option value="Special Committee No.11"> Special Committee No.11 </option>
                            <option value="Special Committee No.13">Special Committee No.13</option>
                            <option value="Special Committee No.12">Special Committee No.12</option>
                            <option value="Finance Committee of the Assembly">Finance Committee of the Assembly </option>
                            <option value="Industries, Commerce and Investment">Industries, Commerce and Investment</option>
                            <option value="Specialized Healthcare and Medical Education">Specialized Healthcare and Medical Education</option>
                            <option value="Higher Education">Higher Education</option>
                            <option value="Housing, Urban Development and Public Health Engineering"> Housing, Urban Development and Public Health Engineering </option>
                            <option value="Human Rights and Minorities Affairs">Human Rights and Minorities Affairs</option>
                            <option value="Labour and Human Resource">Labour and Human Resource</option>
                            <option value="Primary and Secondary Healthcare">Primary and Secondary Healthcare</option>
                            <option value="Committee on Privileges">Committee on Privileges</option>
                            <option value="School Education">School Education</option>
                            <option value="Chief Ministers’ Inspection Team">Chief Ministers’ Inspection Team</option>
                            <option value="Special Committee No. 4">Special Committee No. 4</option>
                            <option value="Special Committee No. 5">Special Committee No. 5</option>
                            <option value="Gender Mainstreaming (Women Development)">Gender Mainstreaming (Women Development)</option>
                            <option value="Excise Taxation">Excise Taxation</option>
                            <option value="Population Welfare">Population Welfare </option>
                            <option value="Planning Development">Planning Development</option>
                            <option value="Mines and Minerals">Mines and Minerals</option>
                            <option value="Public Accounts Committee-II">Public Accounts Committee-II</option>
                            <option value="Environment Protection">Environment Protection</option>
                            <option value="Local Government and Community Development">Local Government and Community Development</option>
                            <option value="Zakat Ushr">Zakat Ushr</option>
                            <option value="Special Committee No. 6"> Special Committee No. 6</option>
                            <option value="Home">Home</option>
                            <option value="Public Prosecution">Public Prosecution</option>
                            <option value="Revenue, Relief and Consolidation">Revenue, Relief and Consolidation</option>
                            <option value="Special Committee No. 7">Special Committee No. 7</option>
                            <option value="Special Committee No. 8">Special Committee No. 8</option>
                            <option value="Special Committee No. 9">Special Committee No. 9</option>                        
                      </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">name </label>
                    <input type="text" name="name" value="@if(isset($singleRow)){{$singleRow->name}}@endif" class="form-control">
                </div>
            </div>
            
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Date</label>
                    <input type="date" name="date"  value="@if(isset($singleRow)){{$singleRow->date}}@endif" class="form-control" class="form-control">
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
    <h3 class="box-title">List of Members Form</h3>

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
              <th width="%">Assembly Tenure</th>
              <th width="%">Name</th>
              <th width="%">Date</th>
              <th width="%">Type</th>
              <th width="%">Committee</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $about)
            <tr>
              <td>{{$about->fromdate }} - {{$about->fromdate}}</td>
              <td>{{$about->name }}</td>
              <td>{{$about->date }}</td>
              <td>{{$about->type }}</td>
              <td>{{$about->committee }}</td>
              <td>
                <a href="{{ route('reportslaid.edit', ['reportslaid' => $about->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('reportslaid.destroy', ['reportslaid'=> $about->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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
