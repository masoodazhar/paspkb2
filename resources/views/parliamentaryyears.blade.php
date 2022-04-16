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
    <h3 class="box-title">Parliamentary Years Form</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
        <form action="@if(isset($parliamentaryyearsData)) {{ route('parliamentaryyear.update', ['parliamentaryyear'=>$parliamentaryyearsData->id ]) }} @else {{ route('parliamentaryyear.store') }} @endif" method="post">
            @csrf
            @if(isset($parliamentaryyearsData))
            {{ method_field('PUT') }}
            @endif
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for=""> Assembly  </label>
                        <select name="assembly_id" id=""  class="form-control">
                            @forelse($assembly as $assembly)

                                <option value="{{$assembly->id}}" @if(isset($parliamentaryyearsData)) @if($parliamentaryyearsData->assembly_id == $assembly->id) selected @endif  @endif >{{$assembly->name}}</option>
                            @empty
                                <option value="0">No Assembly</option>
                            @endforelse
                        </select>
                    </div>
                </div>
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
                        <label for=""> Parliamentary Years </label>
                        <input type="text" value="@if(isset($parliamentaryyearsData)){{$parliamentaryyearsData->name}}@endif" name="name" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for=""> Parliamentary Years </label>
                        <input type="date" value="@if(isset($parliamentaryyearsData)){{$parliamentaryyearsData->pyfromdate}}@endif" name="pyfromdate" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for=""> Parliamentary Years </label>
                        <input type="date" value="@if(isset($parliamentaryyearsData)){{$parliamentaryyearsData->pytodate}}@endif" name="pytodate" class="form-control">
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
    <h3 class="box-title">Parliamentary Years List</h3>

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
              <th width="5%">ID</th>
              <th width="20%">Name</th>
              <th width="20%">Assembly</th>
              <th width="20%">Assembly Tenure</th>
              <th width="10%">Start Date</th>
              <th width="10%">End Date</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($parliamentaryyears as $parliamentaryyears)
            <tr>
              <td>{{$parliamentaryyears->id}}</td>
              <td>{{$parliamentaryyears->name}}</td>
              <td>{{$parliamentaryyears->assemblyname }}</td>
              <td>{{$parliamentaryyears->fromdate}} To {{$parliamentaryyears->todate}}</td>
              <td>{{$parliamentaryyears->pyfromdate }}</td>
              <td>{{$parliamentaryyears->pytodate }}</td>
              <td>
                <a href="{{ route('parliamentaryyear.edit', ['parliamentaryyear' => $parliamentaryyears->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('parliamentaryyear.destroy', ['parliamentaryyear'=> $parliamentaryyears->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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