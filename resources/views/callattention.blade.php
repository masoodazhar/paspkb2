@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
 @if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
<form action="@if(isset($singleRow)) {{ route('callattention.update', ['callattention'=>$singleRow->id ]) }} @else {{ route('callattention.store') }} @endif" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($singleRow))
                {{ method_field('PUT') }}
                @endif
  <div class="box-header with-border">
    <h3 class="box-title">  Call Attention Form </h3>

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
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Parliamentary Years</label>
                    <select name="parliamentary_years_id" id=""  class="form-control">
                        @forelse($parliamentaryYears as $assembly)
                            <option value="{{$assembly->id}}" @if(isset($singleRow)) @if($singleRow->parliamentary_years_id == $assembly->id) selected @endif  @endif >{{$assembly->name}}</option>
                        @empty
                            <option value="0">No Assembly</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Number.</label>
                    <input type="text" class="form-control" name="number" value="@if(isset($singleRow)){{$singleRow->number}}@endif" alt="">
                </div>
            </div>
        </div>
        <div class="row">
           
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Date</label>
                    <input type="text" class="form-control" name="date" value="@if(isset($singleRow)){{$singleRow->date}}@endif" alt="">
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
                    <select name="department" class="form-control"><option value="other">-</option><option value="agriculture">Agriculture</option><option value="agriculture-supply-prices">AGRICULTURE, SUPPLY &amp; PRICES</option><option value="antiquities">Antiquities</option><option value="auqaf">Auqaf</option><option value="auqaf-zakat-ushr">AUQAF, ZAKAT &amp; USHR</option><option value="coastal-development-authority">Coastal Development Authority</option><option value="cooperation">Cooperation</option><option value="cooperative">Cooperative</option><option value="criminal-portfolio">Criminal Portfolio</option><option value="culture">Culture</option><option value="culture-tourism-antiquities">CULTURE, TOURISM &amp; ANTIQUITIES</option><option value="education">Education</option><option value="education-and-literacy">Education and Literacy</option><option value="energy">Energy</option><option value="environment-climate-change">Environment Climate Change</option><option value="environment-climate-change-costal-development">ENVIRONMENT, CLIMATE CHANGE &amp; COSTAL DEVELOPMENT</option><option value="environmental-protection">Environmental Protection</option><option value="excise-taxation">Excise &amp; Taxation</option><option value="excise-taxation-law">EXCISE, TAXATION &amp; LAW</option><option value="excise-taxation-narcotics">EXCISE, TAXATION &amp; NARCOTICS</option><option value="excise-taxation-narcotics-control">EXCISE, TAXATION &amp; NARCOTICS CONTROL</option><option value="finance">Finance</option><option value="finance-human-rights">FINANCE &amp; HUMAN RIGHTS</option><option value="fisheries">Fisheries</option><option value="food">Food</option><option value="forest">Forest</option><option value="forest-wildlife">FOREST &amp; WILDLIFE</option><option value="health">Health</option><option value="health-population-welfare">HEALTH &amp; POPULATION WELFARE</option><option value="home">Home</option><option value="housing">Housing</option><option value="housing-town-planning">Housing &amp; Town Planning</option><option value="human-resources">Human Resources</option><option value="human-rights">Human Rights</option><option value="human-settlement">HUMAN SETTLEMENT</option><option value="industries-commerce">Industries &amp; Commerce</option><option value="information">Information</option><option value="information-archives">Information &amp; Archives</option><option value="information-technology">Information Science &amp; Technology</option><option value="inter-provincial-coordination">Inter Provincial Coordination</option><option value="irrigation">Irrigation</option><option value="katchi-abadies">Katchi Abadies</option><option value="labour">Labour</option><option value="labour-and-human-resources">LABOUR AND HUMAN RESOURCES</option><option value="land-utilization">Land Utilization</option><option value="law">Law</option><option value="law-and-parliamentary-affairs">LAW AND PARLIAMENTARY AFFAIRS</option><option value="live-stock">Live Stock</option><option value="livestock-fisheries">LIVESTOCK &amp; FISHERIES</option><option value="local-government">Local Government</option><option value="management-professional-development">Management &amp; Professional Development</option><option value="mines-mineral-development">Mines &amp; Mineral Development</option><option value="minorities-affairs">Minorities Affairs</option><option value="narcotics">Narcotics</option><option value="other-2">other</option><option value="parliamentary-affairs">Parliamentary Affairs</option><option value="planning-development">Planning &amp; Development</option><option value="population-welfare">Population Welfare</option><option value="population-welfare-and-health">POPULATION WELFARE AND HEALTH</option><option value="prisons">Prisons</option><option value="public-health-engineering">PUBLIC HEALTH ENGINEERING</option><option value="public-health-engineering-and-rural-development">Public Health Engineering and Rural Development</option><option value="religious-affairs">Religious Affairs</option><option value="revenue">REVENUE</option><option value="revenue-relief">Revenue &amp; Relief</option><option value="sindh-technical-education-vocational-training-authority">Sindh Technical Education &amp; Vocational Training Authority</option><option value="social-welfare">Social Welfare</option><option value="sports">Sports</option><option value="supply-prices">Supply &amp; Prices</option><option value="tourism">Tourism</option><option value="transport-mass-transit">Transport &amp; Mass Transit</option><option value="women-development">Women Development</option><option value="works-services">Works &amp; Services</option><option value="youth-affairs">Youth Affairs</option><option value="zakat-ushr">Zakat &amp; Ushr</option></select>
                </div>
            </div>
            
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


<!-- Default box -->
<div class="box">

  <div class="box-header with-border">
    <h3 class="box-title">Call Attention</h3>

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
                <a href="{{ route('callattention.edit', ['callattention' => $about->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('callattention.destroy', ['callattention'=> $about->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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
