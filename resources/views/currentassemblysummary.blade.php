
@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
 @if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
<form action="@if(isset($singleRow)) {{ route('currentassemblysummary.update', ['currentassemblysummary'=>$singleRow->id ]) }} @else {{ route('currentassemblysummary.store') }} @endif" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($singleRow))
                {{ method_field('PUT') }}
                @endif
  <div class="box-header with-border">
    <h3 class="box-title">  Current Assembly Summary Form</h3>

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
                    <label for=""> Assembly  </label>
                    <select name="assembly_id" id=""  class="form-control">
                        @forelse($assembly as $assembly)

                            <option value="{{$assembly->id}}" @if(isset($singleRow)) @if($singleRow->assembly_id == $assembly->id) selected @endif  @endif >{{$assembly->name}}</option>
                        @empty
                            <option value="0">No Assembly</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Assembly Tenure</label>
                    <select name="assembly_tenures_id" id=""  class="form-control">
                          @forelse($assemblyTenures as $assemblytenure)
                              <option value="{{$assemblytenure->id}}" @if(isset($singleRow)) @if($singleRow->assembly_tenures_id == $assemblytenure->id) selected @endif  @endif >{{$assemblytenure->fromdate}} To {{$assemblytenure->todate}} </option>
                          @empty
                              <option value="0">No Assembly Tenure</option>
                          @endforelse
                      </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                  <label for="">Parliamentary Years</label>
                  <select name="parliamentary_years_id" id=""  class="form-control">
                        @forelse($parliamentaryYears as $assemblytenure)
                            <option value="{{$assemblytenure->id}}" @if(isset($singleRow)) @if($singleRow->parliamentary_years_id == $assemblytenure->id) selected @endif  @endif >{{$assemblytenure->name}}  </option>
                        @empty
                            <option value="0">No Parliamentary Years</option>
                        @endforelse
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Session No.</label>
                    <select name="main_sessions_id" id=""  class="form-control">
                        @forelse($mainSessions as $assemblytenure)
                            <option value="{{$assemblytenure->id}}" @if(isset($singleRow)) @if($singleRow->main_sessions_id == $assemblytenure->id) selected @endif  @endif >{{$assemblytenure->sessionname}} ({{$assemblytenure->fromdate}}-{{$assemblytenure->todate}})  </option>
                        @empty
                            <option value="0">No Session</option>
                        @endforelse
                    </select>    
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Summoned By</label>
                    <input type="text"  value="@if(isset($singleRow)){{$singleRow->summonedby}}@endif" name="summonedby"  class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">From</label>
                    <input type="text" placeholder="MM/DD/YYYY" value="@if(isset($singleRow)){{$singleRow->fromdate}}@endif" name="fromdate"  class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">To</label>
                    <input type="text" placeholder="MM/DD/YYYY" value="@if(isset($singleRow)){{$singleRow->todate}}@endif" name="todate"  class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Actual Sittings	</label>
                    <input type="text"  value="@if(isset($singleRow)){{$singleRow->actualsittings}}@endif" name="actualsittings"  class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Total Sittings</label>
                    <input type="text"  value="@if(isset($singleRow)){{$singleRow->totalsittings}}@endif" name="totalsittings"  class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Session Days</label>
                    <input type="text"  value="@if(isset($singleRow)){{$singleRow->sessiondays}}@endif" name="sessiondays"  class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
              <div class="col-md-12">                  
                <div class="form-group">
                    <label for="">Description (Optional)</label>
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
    <h3 class="box-title">Current Assembly Summary</h3>

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
              <th width="%">Assembly</th>
              <th width="%">Assembly Tenure</th>
              <th width="%">Parl. Year</th>
              <th width="%">Session</th>
              <th width="%">Summone Bby</th>
              <th width="%">From date</th>
              <th width="%">TO date</th>
              <th width="%">Actual Sittings</th>
              <th width="%">Session Day</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $about)
            <tr>
              <td>{{$about->assemblyname }}</td>
              <td>{{$about->tenfdate }} - {{$about->tentdate }}</td>
              <td>{{$about->parliamentaryyearname }}</td>
              <td>{{$about->sessionname}}</td>
              <td>{{$about->summonedby}}</td>
              <td>{{$about->fromdate}}</td>
              <td>{{$about->todate}}</td>
              <td>{{$about->actualsittings}}</td>
              <td>{{$about->sessiondays}}</td>
              <td>
                <a href="{{ route('currentassemblysummary.edit', ['currentassemblysummary' => $about->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('currentassemblysummary.destroy', ['currentassemblysummary'=> $about->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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
