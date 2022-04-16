@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
 @if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
<form action="@if(isset($singleRow)) {{ route('questions.update', ['question'=>$singleRow->id ]) }} @else {{ route('questions.store') }} @endif" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($singleRow))
                {{ method_field('PUT') }}
                @endif
  <div class="box-header with-border">
    <h3 class="box-title">  Questions Form </h3>

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
                    <!-- <option value="5">4th session</option> -->
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
                    <label for="">Member</label>
                    <select name="members_directories_id" id=""  class="form-control">
                        @forelse($membersDirectories as $assembly)
                            <option value="{{$assembly->id}}" @if(isset($singleRow)) @if($singleRow->members_directories_id == $assembly->id) selected @endif  @endif >{{$assembly->name}}</option>
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
                    <label for="">Number.</label>
                    <input type="text" class="form-control" name="number" value="@if(isset($singleRow)){{$singleRow->number}}@endif" alt="">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Date @if(isset($singleRow)) - Previous date was {{$singleRow->date}}@endif</label>
                    <input type="date" class="form-control" name="date" value="@if(isset($singleRow)){{$singleRow->date}}@endif" alt="">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Subject</label>
                    <input type="text" class="form-control" name="subject" value="@if(isset($singleRow)){{$singleRow->subject}}@endif" alt="">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Department</label>
                    <select name="department" class="form-control">
                    
                    <option value="Other">-</option>
                    <option value="Agriculture">Agriculture</option>
                    <option value="AGRICULTURE, SUPPLY PRICES">AGRICULTURE, SUPPLY PRICES</option>
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
            
               
        </div>
        <div class="row">
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" class="form-control">
                        <option value="Replied">Replied</option>
                        <option value="Pending">Pending</option>
                        <option value="Deferred">Deferred</option>
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
    <h3 class="box-title">List of Questions</h3>

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
            <th width="10%">Session</th>
            <th width="10%">Number</th>
              <th width="10%">Sitting</th>
              <th width="10%">Member</th>
              <th width="10%">Subject</th>
              <th width="10%">Department</th>
              <th width="10%">Status</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $about)
            <tr>
              <td>{{$about->fromdate}} - {{$about->todate}}</td>
              <td>{{$about->number }}</td>
              <td>{{$about->date }}</td>
              <td>{{$about->membername }}</td>
              <td>{{$about->subject }}</td>
              <td>{{$about->department }}</td>
              <td>{{$about->status }}</td>
              <td>
                <a href="{{ route('questions.edit', ['question' => $about->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('questions.destroy', ['question'=> $about->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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
</section>
<!-- /.content -->

@stop
