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
    <h3 class="box-title">Standing Committes Name Form</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
  <form action="@if(isset($singleRow)){{ route('standingcommitteescategory.update', ['standingcommitteescategory'=>$singleRow->id ]) }} @else {{ route('standingcommitteescategory.store') }} @endif" method="post" enctype="multipart/form-data">
            @csrf
            @if(isset($singleRow))
            {{ method_field('PUT') }}
            @endif
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for=""> Heading (Name) </label>
                       <input type="text" class="form-control" name="category" value="@if(isset($singleRow)){{$singleRow->category}}@endif">
                    </div>
                </div>            
            </div>
            <div class="row">
                <div class="col-md-3">
                    <input type="submit" class="btn btn-primary" value="save Changes">
                </div>
            </div>
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
    <h3 class="box-title">Standing Committees Names</h3>

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
              <th width="55%">category Heading</th>
              <th width="20%">Members</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $about)
            <tr>
              <td>{{$about->id}}</td>
              <td>{{$about->category}}</td>
              <td>
              @if(json_decode($about->member)!='') 
                  @foreach($memberDirectories as $members)
              
                    @if( in_array($members->id, json_decode($about->member)))
                    
                      <p>{{$members->name}},</p>
                    @endif
                  @endforeach
              @else  
              <a href="{{ route('standingcommittees.index') }}"> No Members get back to Assign Members </a>            
              @endif
              </td>
              <td>
                <a href="{{ route('standingcommitteescategory.edit', ['standingcommitteescategory' => $about->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('standingcommitteescategory.destroy', ['standingcommitteescategory'=> $about->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
                        @csrf
                        {{ method_field('DELETE') }}                      
                         <input type="submit" class="btn btn-danger" value="Delete" id="">                       
                    </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" style="text-align:center;">No Data Found</td>
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