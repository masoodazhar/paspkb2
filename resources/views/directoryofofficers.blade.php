
@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
 @if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
<form action="@if(isset($singleRow)) {{ route('directoryofofficers.update', ['directoryofofficer'=>$singleRow->id ]) }} @else {{ route('directoryofofficers.store') }} @endif" method="post">
                @csrf
                @if(isset($singleRow))
                {{ method_field('PUT') }}
                @endif
  <div class="box-header with-border">
    <h3 class="box-title">Directory of officers Form</h3>

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
                    <label for="">name </label>
                    <input type="text" name="name" value="@if(isset($singleRow)){{$singleRow->name}}@endif" class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Designation </label>
                    <input type="text" name="designation" value="@if(isset($singleRow)){{$singleRow->designation}}@endif" class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">BPS </label>
                    <input type="text" name="bps" value="@if(isset($singleRow)){{$singleRow->bps}}@else - @endif" class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Phone </label>
                    <input type="text" name="phone" value="@if(isset($singleRow)){{$singleRow->phone}}@else - @endif" class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Fax </label>
                    <input type="text" name="fax" value="@if(isset($singleRow)){{$singleRow->fax}}@else - @endif" class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Email </label>
                    <input type="email" name="email" value="@if(isset($singleRow)){{$singleRow->email}}@else - @endif" class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Remarks </label>
                    <input type="text" name="remarks" value="@if(isset($singleRow)){{$singleRow->remarks}}@else - @endif" class="form-control">
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
    <h3 class="box-title">Directory of officers List</h3>

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
              <th width="15%">Name</th>
              <th width="15%">Designation</th>
              <th width="10%">BPS</th>
              <th width="10%">Phone</th>
              <th width="10%">Fax</th>
              <th width="10%">Email</th>
              <th width="10%">Remarks</th>
              <th width="20%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $about)
            <tr>
              <td>{{$about->id}}</td>
              <td>{{$about->name}}</td>
              <td>{{$about->designation}}</td>
              <td>{{$about->bps}}</td>
              <td>{{$about->phone}}</td>
              <td>{{$about->fax}}</td>
              <td>{{$about->email}}</td>
              <td>{{$about->remarks}}</td>
              <td>
                <a href="{{ route('directoryofofficers.edit', ['directoryofofficer' => $about->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('directoryofofficers.destroy', ['directoryofofficer'=> $about->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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