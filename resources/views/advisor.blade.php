@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
 @if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
<form action="@if(isset($singleRow)) {{ route('advisor.update', ['advisor'=>$singleRow->id ]) }} @else {{ route('advisor.store') }} @endif" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($singleRow))
                {{ method_field('PUT') }}
                @endif
  <div class="box-header with-border">
    <h3 class="box-title">Advisor & Spacial Advisor Form</h3>

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
                    <select name="assembly_tenures_id" class="form-control">
                        @forelse($assemblyTenure as $assemblyTenure)
                            <option value="{{$assemblyTenure->id}}" @if(isset($singleRow)) @if($singleRow->assembly_tenures_id == $assemblyTenure->id) selected @endif  @endif >{{$assemblyTenure->fromdate}} To {{$assemblyTenure->todate}}</option>
                        @empty
                            <option value="0">No Assembly</option>
                        @endforelse
                    
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Name	</label>
                    <input type="text"  name="name" value="@if(isset($singleRow)){{$singleRow->name}}@endif"  class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Father Husband Name</label>
                    <input type="text" name="fatherhusbandname" value="@if(isset($singleRow)){{$singleRow->fatherhusbandname}}@endif"  class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" name="image" value="@if(isset($singleRow)){{$singleRow->image}}@endif"  class="form-control">
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Birthday @if(isset($singleRow)) - current ({{$singleRow->birthday}})@endif</label>
                    <input type="date" name="birthday" value="@if(isset($singleRow)){{$singleRow->birthday}}@endif"  class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" value="@if(isset($singleRow)){{$singleRow->email}}@endif"  class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Phone Number</label>
                    <input type="text" name="phonenumber" value="@if(isset($singleRow)){{$singleRow->phonenumber}}@endif"  class="form-control">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Constituency</label>
                    <input type="text" name="constituency" value="@if(isset($singleRow)){{$singleRow->constituency}}@endif"  class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">District</label>
                    <input type="text" name="district" value="@if(isset($singleRow)){{$singleRow->district}}@endif"  class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Present Address</label>
                    <input type="text" name="presentaddress" value="@if(isset($singleRow)){{$singleRow->presentaddress}}@endif"  class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Permanent Address</label>
                    <input type="text" name="permanentaddress" value="@if(isset($singleRow)){{$singleRow->permanentaddress}}@endif"  class="form-control">
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Party Association</label>
                    <input type="text" name="partyassociation" value="@if(isset($singleRow)){{$singleRow->partyassociation}}@endif"  class="form-control">
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Advisor / Special Advisor</label>
                   <select name="category" class="form-control">
                        <option value="Advisor To CM" @if(isset($singleRow)) @if($singleRow->category=='Advisor To CM') selected="selected"  @endif @endif  >Advisor To CM</option>
                        <option value="Special Advisor To CM" @if(isset($singleRow)) @if($singleRow->category=='Special Advisor To CM') selected="selected"  @endif @endif>Special Advisor To CM</option>
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
    <h3 class="box-title">Advisor & Spacial Advisor Data</h3>

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
              <th width="10%">Image</th>
              <th width="10%">Name</th>
              <th width="15%">Father/Husband</th>
              <th width="10%">Email</th>
              <th width="10%">Phone Number</th>
              <th width="10%">Constituency</th>
              <th width="20%">Party Association</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $about)
            <tr>
              <td><img src="{{ url('public/uploads') }}/{{$about->image}}" style="width:50px" alt=""></td>
              <td>{{$about->name}}</td>
              <td>{{$about->fatherhusbandname}}</td>
              <td>{{$about->email}}</td>
              <td>{{$about->phonenumber}}</td>
              <td>{{$about->constituency}}</td>
              <td>{{$about->partyassociation}}</td>
              <td>
                <a href="{{ route('advisor.edit', ['advisor' => $about->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('advisor.destroy', ['advisor'=> $about->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                      
                         <input type="submit" class="btn btn-danger" value="Delete" id="">
                       
                    </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" style="text-align:center;">No Data Found</td>
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