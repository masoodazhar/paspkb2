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
    <h3 class="box-title">Committeeon Government Assurance Form</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
        <form action="@if(isset($singleRow)) {{ route('committeeongovernmentassurance.update', ['committeeongovernmentassurance'=>$singleRow->id ]) }} @else {{ route('committeeongovernmentassurance.store') }} @endif" method="post">
            @csrf
            @if(isset($singleRow))
            {{ method_field('PUT') }}
            @endif
                
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
                        <label for=""> Chairperson </label>
                        <select name="members_directories_id" id=""  class="form-control">
                            @forelse($memberDirectories as $assembly)
                                <option value="{{$assembly->id}}" @if(isset($singleRow))@if($singleRow->members_directories_id == $assembly->id) selected @endif @endif  >{{$assembly->name}}</option>
                            @empty
                                <option value="0">No Member Directory</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for=""> Members (Select Former Speaker) </label>
                        <select name="members_directories_ids[]" id=""  class="form-control" multiple>
                            @forelse($memberDirectories as $assembly)
                                <option value="{{$assembly->id}}" @if(isset($singleRow))@if(in_array($assembly->id, json_decode($singleRow->members_directories_ids))) selected @endif @endif  >{{$assembly->name}}</option>
                            @empty
                                <option value="0">No Member Directory</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for=""> Name</label>
                        <input type="text" class="form-control" name="name" value="@if(isset($singleRow)) {{$singleRow->name}} @endif">
                      
                    </div>
                </div>

            </div>
            <div class="row">
              
            <div class="col-md-3">                  
                    <div class="form-group">
                        <label for=""> Committee Formation Date </label>
                        <input type="date" class="form-control" name="committeformationdate" value="@if(isset($singleRow)){{$singleRow->committeformationdate}}@endif">
                      
                    </div>
                </div>

                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for="">Committee Dissolution Date</label>
                        <input type="date" class="form-control" name="committeedissolutiondate" value="@if(isset($singleRow)){{$singleRow->committeedissolutiondate}}@endif">
                        
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for=""> Purpose </label>
                        <input type="text" class="form-control" name="Purpose" value="@if(isset($singleRow)){{$singleRow->Purpose}}@endif">
                        
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
    <h3 class="box-title">Assembly Form</h3>

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
              <th width="20%">Name</th>
              <th width="10%">Assembly</th>
              <th width="15%">Chare Person</th>
              <th width="10%">Committee Formation Date</th>
              <th width="10%">Committee Dissolution Date</th>
              <th width="20%">Purpose</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $assemblytenure)
            <tr>
              <td>{{$assemblytenure->name}}</td>
              <td>{{$assemblytenure->assemblyname}}</td>
              <td>{{$assemblytenure->membername}}</td>
              <td>{{$assemblytenure->committeformationdate}}</td>
              <td>{{$assemblytenure->committeedissolutiondate}}</td>
              <td>{{$assemblytenure->Purpose}}</td>
              <td>
                <a href="{{ route('committeeongovernmentassurance.edit', ['committeeongovernmentassurance' => $assemblytenure->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('committeeongovernmentassurance.destroy', ['committeeongovernmentassurance'=> $assemblytenure->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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