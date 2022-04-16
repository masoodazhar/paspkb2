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
    <h3 class="box-title">Assembly Tenure Form</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
        <form id="form" action="@if(isset($assemblytenureData)) {{ route('assemblytenure.update', ['assemblytenure'=>$assemblytenureData->id ]) }} @else {{ route('assemblytenure.store') }} @endif" method="post">
            @csrf
            @if(isset($assemblytenureData))
            {{ method_field('PUT') }}
            @endif
                
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for=""> Assembly  </label>
                        <select name="assembly_id" id=""  class="form-control">
                            @forelse($assembly as $assembly)

                                <option value="{{$assembly->id}}" @if(isset($assemblytenureData)) @if($assemblytenureData->assembly_id == $assembly->id) selected @endif  @endif >{{$assembly->name}}</option>
                            @empty
                                <option value="0">No Assembly</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for=""> From Date </label>
                        <input type="number" id="fromdate" class="form-control" name="fromdate" value="@if(isset($assemblytenureData)) {{$assemblytenureData->fromdate}} @endif">
                        
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for=""> To Date</label>
                        <input type="number" id="todate" class="form-control" name="todate" value="@if(isset($assemblytenureData)) {{$assemblytenureData->todate}} @endif">
                         
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
    <h3 class="box-title">Assembly Tenure List</h3>

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
              <th width="25%">Assembly</th>
              <th width="25%">From Date</th>
              <th width="25%">To Date</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($assemblytenure as $assemblytenure)
            <tr>
              <td>{{$assemblytenure->id}}</td>
              <td>{{$assemblytenure->name}}</td>
              <td>{{$assemblytenure->fromdate}}</td>
              <td>{{$assemblytenure->todate}}</td>
              <td>
                <a href="{{ route('assemblytenure.edit', ['assemblytenure' => $assemblytenure->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('assemblytenure.destroy', ['assemblytenure'=> $assemblytenure->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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
<script>
  const form = document.getElementById('form');
  form.addEventListener('submit', function(event){
    event.preventDefault();

    const fromdate = document.getElementById('fromdate').value;
    const todate = document.getElementById('todate').value;

    if(Number(fromdate) >= Number(todate)) {
      alert('Invalid Date. please check and try again!');
    }else{
      event.currentTarget.submit();
    }

  })
</script>
@stop