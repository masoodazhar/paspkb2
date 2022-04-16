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
    <h3 class="box-title">Powers and functions Form</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div> 
  <div class="box-body">
  <form action="{{ route('powersfunctions.update', ['powersfunction'=>$singleRowMain->id ]) }}" method="post">
                @csrf
                {{ method_field('PUT') }}
                <input type="hidden" value="true" name="check">
            <div class="row">
                <div class="col-md-12">                  
                    <div class="form-group">
                        <label for="">Main Page Description</label>
                        <textarea name="main_description" class="form-control summernote" id="" cols="20" rows="10">{{$singleRowMain->main_description}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <input type="submit" class="btn btn-primary" value="save Changes">
                </div>
            </div>
        </form>
        
        <hr>
        <br>
        <form action="@if(isset($singleRow)) {{ route('powersfunctions.update', ['powersfunction'=>$singleRow->id ]) }} @else {{ route('powersfunctions.store') }} @endif" method="post">
                @csrf
                @if(isset($singleRow))
                {{ method_field('PUT') }}
                @endif
                <input type="hidden" value="false" name="check">
                
            <div class="row my-4">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Heading </label>
                        <input type="text" name="name" value="@if(isset($singleRow)){{$singleRow->name}}@endif" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                  
                    <div class="form-group">
                        <label for="">Description (Heading)</label>
                        <textarea name="description" class="form-control summernote" id="" cols="20" rows="10">@if(isset($singleRow)){{$singleRow->description}}@endif</textarea>
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
    <h3 class="box-title">Powers and functions Data</h3>

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
              <th width="10%">ID</th>
              <th width="20%">Heading</th>
              <!-- <th width="55%">Description</th> -->
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $about)
            <tr>
              <td>{{$about->id}}</td>
              <td>{{$about->name}}</td>
              <!-- <td>{!! $about->description !!}</td> -->
              <td>
                <a href="{{ route('powersfunctions.edit', ['powersfunction' => $about->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('powersfunctions.destroy', ['powersfunction'=> $about->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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