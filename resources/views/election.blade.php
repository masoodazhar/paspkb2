@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
 @if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
<form action="@if(isset($singleRow)) {{ route('elections.update', ['election'=>$singleRow->id ]) }} @else {{ route('elections.store') }} @endif" method="post">
                @csrf
                @if(isset($singleRow))
                {{ method_field('PUT') }}
                @endif
  <div class="box-header with-border">
    <h3 class="box-title">Manage Members By Election Form</h3>

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
                    <label for="">Previous Member</label>
                    <select name="members_directories_name_id" id=""  class="form-control">
                            @forelse($members as $assembly)

                                <option value="{{$assembly->id}}" @if(isset($singleRow)) @if($singleRow->members_directories_name_id  == $assembly->id) selected @endif  @endif >{{$assembly->name}}</option>
                            @empty
                                <option value="0">No Member Directory</option>
                            @endforelse
                        </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Member Status </label>
                    <select name="member_status" id="" class="form-control pagetype">
                        <option value="De Notify" @if(isset($singleRow))@if($singleRow->member_status == 'De Notify') selected @endif @endif >De Notify</option>
                        <option value="Resigned" @if(isset($singleRow))@if($singleRow->member_status == 'Resigned') selected @endif @endif >Resigned</option>
                        <option value="Dis-Qualified" @if(isset($singleRow))@if($singleRow->member_status == 'Dis-Qualified') selected @endif @endif >Dis-Qualified</option>
                        <option value="Passed-Away" @if(isset($singleRow))@if($singleRow->member_status == 'Passed-Away') selected @endif @endif >Passed-Away</option>
                        <option value="Un-Seated" @if(isset($singleRow))@if($singleRow->member_status == 'Un-Seated') selected @endif @endif >Un-Seated</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Current Member Name</label>
                    <select name="members_directories_current_id" id=""  class="form-control">
                            @forelse($members as $assembly)

                                <option value="{{$assembly->id}}" @if(isset($singleRow)) @if($singleRow->members_directories_current_id  == $assembly->id) selected @endif  @endif >{{$assembly->name}}</option>
                            @empty
                                <option value="0">No Member Directory</option>
                            @endforelse
                        </select>
                </div>
            </div>            
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Date (Assembly Tenure) </label>
                    <select name="assembly_tenures_id" id=""  class="form-control">
                        @forelse($assemblyTenure as $assembly)
                            <option value="{{$assembly->id}}" @if(isset($singleRow)) @if($singleRow->assembly_tenures_id == $assembly->id) selected @endif  @endif >{{$assembly->fromdate}} TO {{$assembly->todate}}</option>
                        @empty
                            <option value="0">No Assembly Tenure</option>
                        @endforelse
                    </select>
                </div>
            </div>
           
            
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for=""> Reason for By-election </label>
                    <input type="text" name="reasion" value="@if(isset($singleRow)){{$singleRow->reasion}}@endif"  class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for=""> From Date </label>
                    <input type="date" placeholder="DD/MM/YYY" name="elfromdate" value="@if(isset($singleRow)){{$singleRow->elfromdate}}@endif"  class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for=""> From Date </label>
                    <input type="date" placeholder="DD/MM/YYY" name="eltodate" value="@if(isset($singleRow)){{$singleRow->eltodate}}@endif"  class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <!-- <label for=""> Oath Taken on </label> -->
                    <input type="hidden" placeholder="DD/MM/YYY" name="aothdate" value="-"  class="form-control">
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
    <h3 class="box-title">Manage Members By Elected Data</h3>

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
              <th width="">Status</th>
              <th width="">Previous Member </th>
              <th width="">Current Member</th>
              <th width="">Asse. Tenure</th>
              <th width="">Reason for</th>
              <th width=""> From Date</th>
              <th width="">To Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $about)
            <tr>
              <td>{{$about->member_status}}</td>
              <td>{{$about->m1name}}</td>
              <td>{{$about->m2name}}</td>
              <td>{{$about->fromdate}} to {{$about->fromdate}}</td>
              <td>{{$about->reasion}}</td>
              <td>{{$about->elfromdate}}</td>
              <td>{{$about->eltodate}}</td>
              
              <td>
                <a href="{{ route('elections.edit', ['election' => $about->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('elections.destroy', ['election'=> $about->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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

@stop