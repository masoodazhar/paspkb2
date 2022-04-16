@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
 @if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
<form action="@if(isset($singleRow)) {{ route('resolutionspassed.update', ['resolutionspassed'=>$singleRow->id ]) }} @else {{ route('resolutionspassed.store') }} @endif" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($singleRow))
                {{ method_field('PUT') }}
                @endif
  <div class="box-header with-border">
    <h3 class="box-title">  Resolution Passed </h3>

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
                    <select name="assembly_tenures_id" id=""  class="form-control">
                    <!-- <option value="15" selected="selected">2018 to today</option> -->
                        @forelse($assemblyTenures as $assembly)
                            <option value="{{$assembly->id}}" @if(isset($singleRow)) @if($singleRow->assembly_tenures_id == $assembly->id) selected @endif  @endif >{{$assembly->fromdate}} to {{$assembly->todate}}</option>
                        @empty
                            <option value="0">No Assembly</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for=""> Sessions  </label>
                    <select name="sessions_id" id=""  class="form-control">
                        
                        @forelse($sessions as $assembly)
                        

                            <option value="{{$assembly->id}}" @if(isset($singleRow)) @if($singleRow->sessions_id == $assembly->id) selected @endif  @endif >{{$assembly->fromdate}} to {{$assembly->todate}}</option>
                        @empty
                            <option value="0">No Assembly</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Number </label>
                    <input type="text" name="number"  value="@if(isset($singleRow)){{$singleRow->number}}@endif" class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Title </label>
                    <input type="text" name="title"  value="@if(isset($singleRow)){{$singleRow->title}}@else RESOLUTION @endif" class="form-control">
                </div>
            </div>
            <!-- <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Resolution Type </label>
                    <select class="form-control" name="restype">
                            <option value="Federal">Federal</option>
                            <option value="Provincial" selected>Provincial</option>
                        </select>
                </div>
            </div> -->
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Date </label>
                    <input type="text" name="date"  value="@if(isset($singleRow)){{$singleRow->date}}@endif" class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" class="form-control">
                        <option value="Resolution Statuses">Resolution Statuses</option>
                        <option value="Passed Unanimously" selected>Passed Unanimously</option>
                        <option value="Passed with Majority">Passed with Majority</option>
                    </select>
                </div>
            </div>  
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Department</label>
                    <select name="department" class="form-control">
                    <option value="Other">-</option>
                    <option value="Agriculture">Agriculture</option>
                    <option value="AGRICULTURE, SUPPLY PRICES"></option>
                    <option value="Antiquities">Antiquities</option>
                    <option value="Auqaf">Auqaf</option>
                    <option value="Auqaf-zakat ushr">AUQAF, ZAKAT USHR</option>
                    <option value="Coastal development authority">Coastal Development Authority</option>
                    <option value="Cooperation">Cooperation</option>
                    <option value="Cooperative">Cooperative</option>
                    <option value="Criminal portfolio">Criminal Portfolio</option>
                    <option value="Culture">Culture</option>
                    <option value="Culture tourism antiquities">CULTURE, TOURISM ANTIQUITIES</option>
                    <option value="Education">Education</option>
                    <option value="Education and literacy">Education and Literacy</option><option value="energy">Energy</option>
                    <option value="Environment climate change">Environment Climate Change</option>
                    <option value="Environment climate change costal development">ENVIRONMENT, CLIMATE CHANGE COSTAL DEVELOPMENT</option>
                    <option value="Environmental protection">Environmental Protection</option>
                    <option value="Excise taxation">Excise Taxation</option>
                    <option value="Excise taxation law">EXCISE, TAXATION LAW</option>
                    <option value="Excise taxation narcotics">EXCISE, TAXATION NARCOTICS</option>
                    <option value="Excise taxation narcotics control">EXCISE, TAXATION NARCOTICS CONTROL</option>
                    <option value="Finance">Finance</option>
                    <option value="Finance human rights">FINANCE HUMAN RIGHTS</option>
                    <option value="Fisheries">Fisheries</option><option value="food">Food</option>
                    <option value="Forest">Forest</option>
                    <option value="Forest wildlife">FOREST WILDLIFE</option>
                    <option value="Health">Health</option>
                    <option value="Health population welfare">HEALTH POPULATION WELFARE</option>
                    <option value="Home">Home</option><option value="housing">Housing</option>
                    <option value="Housing town planning">Housing Town Planning</option>
                    <option value="Human resources">Human Resources</option>
                    <option value="Human rights">Human Rights</option>
                    <option value="Human settlement">HUMAN SETTLEMENT</option>
                    <option value="Industries commerce">Industries Commerce</option>
                    <option value="Information">Information</option>
                    <option value="Information archives">Information Archives</option>
                    <option value="Information technology">Information Science Technology</option>
                    <option value="Inter provincial coordination">Inter Provincial Coordination</option>
                    <option value="Irrigation">Irrigation</option>
                    <option value="Katchi abadies">Katchi Abadies</option>
                    <option value="Labour">Labour</option>
                    <option value="Labour and human resources">LABOUR AND HUMAN RESOURCES</option>
                    <option value="Land utilization">Land Utilization</option>
                    <option value="Law">Law</option>
                    <option value="Law and parliamentary affairs">LAW AND PARLIAMENTARY AFFAIRS</option>
                    <option value="Live stock">Live Stock</option>
                    <option value="Livestock fisheries">LIVESTOCK FISHERIES</option>
                    <option value="Local government">Local Government</option>
                    <option value="Management professional development">Management Professional Development</option>
                    <option value="Mines mineral development">Mines Mineral Development</option>
                    <option value="Minorities affairs">Minorities Affairs</option>
                    <option value="Narcotics">Narcotics</option>
                    <option value="Other">other</option>
                    <option value="Parliamentary affairs">Parliamentary Affairs</option>
                    <option value="Planning development">Planning Development</option>
                    <option value="Population welfare">Population Welfare</option>
                    <option value="Population welfare and health">POPULATION WELFARE AND HEALTH</option>
                    <option value="Prisons">Prisons</option>
                    <option value="Public health engineering">PUBLIC HEALTH ENGINEERING</option>
                    <option value="Public health engineering and rural development">Public Health Engineering and Rural Development</option>
                    <option value="Peligious affairs">Religious Affairs</option>
                    <option value="Revenue">REVENUE</option>
                    <option value="Revenue relief">Revenue Relief</option>
                    <option value="Sindh technical education vocational training authority">Sindh Technical Education Vocational Training Authority</option>
                    <option value="Social welfare">Social Welfare</option>
                    <option value="Sports">Sports</option>
                    <option value="Supply prices">Supply Prices</option>
                    <option value="Tourism">Tourism</option>
                    <option value="Transport mass transit">Transport Mass Transit</option>
                    <option value="Women development">Women Development</option>
                    <option value="Works services">Works Services</option>
                    <option value="Youth affairs">Youth Affairs</option>
                    <option value="Zakat ushr">Zakat Ushr</option>
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
    <h3 class="box-title">List of Resolution Passed</h3>

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
              <th width="20%">Session</th>
              <th width="10%">Asse. Tenure</th>
              <th width="10%">Number</th>
              <th width="10%">Type</th>
              <th width="10%">Date</th>
              <th width="10%">Status</th>
              <th width="10%">Department</th>
              <th width="20%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $about)
            <tr>
              <td>{{$about->fromdate}} to {{$about->todate}}</td>
              <td>{{$about->atfromdate}} to {{$about->attodate}}</td>
              <td>{{$about->number}}</td>
              <td>{{$about->restype}}</td>
              <td>{{$about->date}}</td>
              <td>{{$about->status}}</td>
              <td>{{$about->department}}</td>
              <td>
                <a href="{{ route('resolutionspassed.edit', ['resolutionspassed' => $about->id]) }}" class="btn btn-primary">Edit & View</a> 
                <form style="width: 47%; float: right;" action="{{ route('resolutionspassed.destroy', ['resolutionspassed'=> $about->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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

