@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
@if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
    <form action="@if(isset($singleRow)){{ route('parliamentarycalendar.update', ['parliamentarycalendar'=>$singleRow->id ]) }} @else {{ route('parliamentarycalendar.store') }} @endif" method="post">
            @csrf
            @if(isset($singleRow))
                {{ method_field('PUT') }}
            @endif
  <div class="box-header with-border">
    <h3 class="box-title">  Parliamentary Calendar Form </h3>

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
                    <label for="">Assembly</label>
                    <select name="assemblies_id" id="" class="form-control">
                        @forelse($assemblies as $assemblytenure)
                        <option value="{{$assemblytenure->id}}" @if(isset($singleRow)) @if($singleRow->assemblies_id == $assemblytenure->id) selected @endif  @endif >{{$assemblytenure->name}} </option>
                        @empty
                        <option value="0">No Assembly</option>
                        @endforelse
                    </select>
                </div>
            </div>
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
                        <option value="0">No Parliamentary Year</option>
                        @endforelse
                    </select>
                </div>
            </div>           
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Date</label>
                    <input type="date" class="form-control" name="fromdate" value="@if(isset($singleRow)){{$singleRow->fromdate}}@endif">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Type</label>
                    <select name="type" id="" class="form-control">
                      <option value="#c02828">Reject Session Days</option>
                      <option value="#328a1d" selected>Proposed Session Days</option>
                      <option value="#0c5b9b">Upcomming Session Days</option>
                    </select>
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
    <h3 class="box-title">Parliamentary Calendar Data</h3>

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
              <th width="15%">Assembly</th>
              <th width="20%">Assembly Tenure</th>
              <th width="20%">Parl.. Year</th>
              <th width="15%">Date</th>
              <th width="15%">Type</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $parliamentaryyears)
            <tr>
              <td>{{$parliamentaryyears->assemblyname}}</td>
              <td>{{$parliamentaryyears->atfromdate}} to {{$parliamentaryyears->attodate}}</td>
              <td>{{$parliamentaryyears->parliamentary_years_name }}</td>
              <td>{{$parliamentaryyears->fromdate }}</td>
              <td>
                  <span style="background-color: {{$parliamentaryyears->type }}; color: white; padding:5px;">
                      @if($parliamentaryyears->type == '#c02828' )
                      Reject Session Days
                      @elseif($parliamentaryyears->type == '#328a1d')
                      Proposed Session Days
                      @elseif($parliamentaryyears->type == '#0c5b9b')
                      Upcomming Session Days
                      @endif
                  </span>
              </td>
              <td>
                <a href="{{ route('parliamentarycalendar.edit', ['parliamentarycalendar' => $parliamentaryyears->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('parliamentarycalendar.destroy', ['parliamentarycalendar'=> $parliamentaryyears->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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
