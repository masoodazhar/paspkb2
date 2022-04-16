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
    <h3 class="box-title">Member Performance Report Form</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
        <form action="@if(isset($singleRow)) {{ route('membersperformancereport.update', ['membersperformancereport'=>$singleRow->id ]) }} @else {{ route('membersperformancereport.store') }} @endif" method="post">
            @csrf
            @if(isset($singleRow))
            {{ method_field('PUT') }}
            @endif
                
            <div class="row">
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label for=""> Member </label>
                        <select name="members_directories_id" id=""  class="form-control">
                            @forelse($memberDirectories as $assembly)
                                <option value="{{$assembly->id}}" @if(isset($singleRow))@if($singleRow->members_directories_id == $assembly->id) selected @endif @endif  >{{$assembly->name}}</option>
                            @empty
                                <option value="0">No Member Directory</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="">Add New</label> <br>
                        <a href="#"  class="btn btn-primary addnewrow" >+</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-light table-bordered">
                        <thead class="thead-light">
                            <tr>
                            <th width="10%"> Assembly Questions</th>
                            <th width="5%"></th>
                            <th width="10%"> Privilege Motions</th>
                            <th width="5%"></th>
                            <th width="10%"> Adjournment Motion</th>
                            <th width="5%"></th>
                            <th width="10%"> Private Bills</th>
                            <th width="5%"></th>
                            <th width="10%"> Resolutions</th>
                            <th width="5%"></th>
                            <th width="10%"> Motions</th>
                            <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody class="memberperformbody">
                            <tr>
                                <td> <input type="text" name="assemblyquestiontext[]" class="form-control" value="@if(isset($singleRow)){{$singleRow->assemblyquestiontext}}@else - @endif"> </td>
                                <td> <input type="text" name="assemblyquestionvalue[]" class="form-control" value="@if(isset($singleRow)){{$singleRow->assemblyquestionvalue}}@else - @endif"> </td>

                                <td> <input type="text" name="privilegemotionstext[]" class="form-control" value="@if(isset($singleRow)){{$singleRow->privilegemotionstext}}@else - @endif"> </td>
                                <td> <input type="text" name="privilegemotionsvalue[]" class="form-control" value="@if(isset($singleRow)){{$singleRow->privilegemotionsvalue}}@else - @endif"> </td>

                                <td> <input type="text" name="adjournmentmotiontext[]" class="form-control" value="@if(isset($singleRow)){{$singleRow->adjournmentmotiontext}}@else - @endif"> </td>
                                <td> <input type="text" name="adjournmentmotionvalue[]" class="form-control" value="@if(isset($singleRow)){{$singleRow->adjournmentmotionvalue}}@else - @endif"> </td>

                                <td> <input type="text" name="privatebillstext[]" class="form-control" value="@if(isset($singleRow)){{$singleRow->privatebillstext}}@else - @endif"> </td>
                                <td> <input type="text" name="privatebillsvalue[]" class="form-control" value="@if(isset($singleRow)){{$singleRow->privatebillsvalue}}@else - @endif"> </td>

                                <td> <input type="text" name="Resolutionstext[]" class="form-control" value="@if(isset($singleRow)){{$singleRow->Resolutionstext}}@else - @endif"> </td>
                                <td> <input type="text" name="Resolutionsvalue[]" class="form-control" value="@if(isset($singleRow)){{$singleRow->Resolutionsvalue}}@else - @endif"> </td>

                                <td> <input type="text" name="motionstext[]" class="form-control" value="@if(isset($singleRow)){{$singleRow->motionstext}}@else - @endif"> </td>
                                <td> <input type="text" name="motionsvalue[]" class="form-control" value="@if(isset($singleRow)){{$singleRow->motionsvalue}}@else - @endif"> </td>

                                
                            </tr>
                        </tbody>
                    </table>
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
    <h3 class="box-title">Member Performance Report</h3>

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
                <th width="8%"> Member </th>
                <th width="8%"> Assembly Questions</th>
                <th width="5%"></th>
                <th width="2%"> Privilege</th>
                <th width="5%"></th>
                <th width="8%"> Adjournment </th>
                <th width="5%"></th>
                <th width="8%"> Private Bills</th>
                <th width="5%"></th>
                <th width="8%"> Resolutions</th>
                <th width="5%"></th>
                <th width="8%"> Motions</th>
                <th width="5%"></th>
                <th width="16 %">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $assemblytenure)
            <tr>
              <td>{{$assemblytenure->membername}}</td>
              <td>{{$assemblytenure->assemblyquestiontext}}</td>
              <td>{{$assemblytenure->assemblyquestionvalue}}</td>
              <td>{{$assemblytenure->privilegemotionstext}}</td>
              <td>{{$assemblytenure->privilegemotionsvalue}}</td>
              <td>{{$assemblytenure->adjournmentmotiontext}}</td>
              <td>{{$assemblytenure->adjournmentmotionvalue}}</td>
              <td>{{$assemblytenure->privatebillstext}}</td>
              <td>{{$assemblytenure->privatebillsvalue}}</td>
              <td>{{$assemblytenure->Resolutionstext}}</td>
              <td>{{$assemblytenure->Resolutionsvalue}}</td>
              <td>{{$assemblytenure->motionstext}}</td>
              <td>{{$assemblytenure->motionsvalue}}</td>
              <td>
                <a href="{{ route('membersperformancereport.edit', ['membersperformancereport' => $assemblytenure->id]) }}" class="btn btn-primary">Edit</a> 
                <br>
                <form style="" action="{{ route('membersperformancereport.destroy', ['membersperformancereport'=> $assemblytenure->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                      
                         <input type="submit" class="btn btn-danger" value="Delete" id="">
                       
                    </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="10" style="text-align:center;">No Data Found</td>
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

