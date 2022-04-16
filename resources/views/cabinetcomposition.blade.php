@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
 @if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
<form action="@if(isset($singleRow)) {{ route('cabinetcomposition.update', ['cabinetcomposition'=>$singleRow->id ]) }} @else {{ route('cabinetcomposition.store') }} @endif" method="post">
                @csrf
                @if(isset($singleRow))
                {{ method_field('PUT') }}
                @endif
  <div class="box-header with-border">
    <h3 class="box-title">Cabinet Composition Form</h3>

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
                    <label for="">Member</label>
                    <select name="members_directories_id" id=""  class="form-control">
                            @forelse($members as $assembly)

                                <option value="{{$assembly->id}}" @if(isset($singleRow)) @if($singleRow->members_directories_id == $assembly->id) selected @endif  @endif >{{$assembly->name}}</option>
                            @empty
                                <option value="0">No Member Directory</option>
                            @endforelse
                        </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Category (top view)</label>
                    <select name="category" id="" class="form-control">
                        <option value="0" @if(isset($singleRow)) @if($singleRow->category == 0) selected="selected" @endif @endif >In Tabs</option>
                        <option value="1"  @if(isset($singleRow))  @if($singleRow->category == 1) selected="selected" @endif @endif>Top</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Tabs </label>
                    <select name="tabs" id="" class="form-control">
                      <option value="Senior Minister" @if(isset($singleRow)) @if($singleRow->tabs == 'Senior Minister')) selected="selected" @endif @endif>Senior Minister</option>
                      <option value="Minister" @if(isset($singleRow)) @if($singleRow->tabs == 'Minister')) selected="selected" @endif @endif>Minister</option>
                      <option value="Advisor to CM" @if(isset($singleRow)) @if($singleRow->tabs == 'Advisor to CM')) selected="selected" @endif @endif>Advisor to CM</option>
                      <option value="Special Assistant to CM" @if(isset($singleRow)) @if($singleRow->tabs == 'Special Assistant to CM')) selected="selected" @endif @endif>Special Assistant to CM</option>
                      <option value="Parliamentary Secretary" @if(isset($singleRow)) @if($singleRow->tabs == 'Parliamentary Secretary')) selected="selected" @endif @endif>Parliamentary Secretary</option>
                        <option value="Leader of House" @if(isset($singleRow)) @if($singleRow->tabs == 'Leader of House')) selected="selected" @endif @endif>Leader of House</option>
                        <option value="Leader of the Opposition" @if(isset($singleRow)) @if($singleRow->tabs == 'Leader of the Opposition')) selected="selected" @endif @endif>Leader of the Opposition</option>
                    </select>
                </div>
            </div>
            <!-- <div class="col-md-3">
                <div class="form-group">
                    <label for="">Leader of the house</label>
                    <select name="leaderofthehouse" id="" class="form-control">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div> -->
            <!-- <div class="col-md-3">
                <div class="form-group">
                    <label for="">leader of the opposition</label>
                    <select name="leaderofopposition" id="" class="form-control">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
            </div> -->
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
            <div class="col-md-3">
                <div class="form-group">
                    <label for=""> From Date </label>
                    <input type="text" placeholder="DD/MM/YYY" name="cfromdate" value="@if(isset($singleRow)){{$singleRow->cfromdate}}@endif"  class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for=""> To Date </label>
                    <input type="text" placeholder="DD/MM/YYY" name="ctodate" value="@if(isset($singleRow)){{$singleRow->ctodate}}@endif"  class="form-control">
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
    <h3 class="box-title">Cabinet Composition Data</h3>

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
              <th width="">ID</th>
              <th width="">Member</th>
              <th width="">Asse. Tenure</th>
              <th width="">categoty</th>
              <th width="">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $about)
            <tr>
              <td>{{$about->id}}</td>
              <td>{{$about->membername}}</td>
              <td>{{$about->fromdate}} to {{$about->fromdate}}</td>
              <td>{{$about->tabs}}</td>
              <td>
                <a href="{{ route('cabinetcomposition.edit', ['cabinetcomposition' => $about->id]) }}" class="btn btn-primary">Edit & View</a> 
                <form style="width: 47%; float: right;" action="{{ route('cabinetcomposition.destroy', ['cabinetcomposition'=> $about->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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