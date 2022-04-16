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
    <h3 class="box-title">Bills Form</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
        <form action="@if(isset($singleRow)) {{ route('bills.update', ['bill'=>$singleRow->id ]) }} @else {{ route('bills.store') }} @endif" method="post" enctype="multipart/form-data">
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
                        <label for=""> Assembly Tenure  </label>
                        <select name="assembly_tenures_id" id=""  class="form-control">
                            @forelse($assemblyTenure as $assemblytenure)

                                <option value="{{$assemblytenure->id}}" @if(isset($singleRow)) @if($singleRow->assembly_tenures_id == $assemblytenure->id) selected @endif  @endif >{{$assemblytenure->fromdate}} To {{$assemblytenure->todate}} </option>
                            @empty
                                <option value="0">No Assembly</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for=""> Mover  </label>
                        
                        <select name="members_directories_id" id=""  class="form-control">
                            @forelse($membersDirectories as $assemblytenure)

                                <option value="{{$assemblytenure->id}}" @if(isset($singleRow)) @if($singleRow->members_directories_id == $assemblytenure->id) selected @endif  @endif >{{$assemblytenure->name}}</option>
                            @empty
                                <option value="0">No Member</option>
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for=""> Bill Type </label>
                        <select name="bill_type" id=""  class="form-control">
                            <option value="Government" @if(isset($singleRow)) @if($singleRow->bill_type == 'Government') selected @endif  @endif>Government</option>
                            <option value="Private Member" @if(isset($singleRow)) @if($singleRow->bill_type == 'Private Member') selected @endif  @endif>Private Member</option>
                        </select>   
                    </div>
                </div>
           
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for=""> Title </label>
                        <input type="text" value="@if(isset($singleRow)) {{$singleRow->title}}  @endif" name="title" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for=""> Date </label>
                        <input type="date" name="date" class="form-control"  value="@if(isset($singleRow)){{$singleRow->date}}@endif">
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for=""> Bills Category </label>
                        <select name="type_tabs" id="" class="form-control">
                            <option value="Bills Introduced" @if(isset($singleRow)) @if($singleRow->type_tabs == 'Bills Introduced') selected @endif  @endif> Bills Introduced </option>
                            <option value="Bills Referred to the Committee" @if(isset($singleRow)) @if($singleRow->type_tabs == 'Bills Referred to the Committee') selected @endif  @endif> Bills Referred to the Committee </option>
                            <option value="Bills Passed" @if(isset($singleRow)) @if($singleRow->type_tabs == 'Bills Passed') selected @endif  @endif> Bills Passed </option>
                            <option value="Bills not Passed" @if(isset($singleRow)) @if($singleRow->type_tabs == 'Bills not Passed') selected @endif  @endif> Bills not Passed </option>
                            <option value="Bills Under Consideration" @if(isset($singleRow)) @if($singleRow->type_tabs == 'Bills Under Consideration') selected @endif  @endif> Bills Under Consideration </option>
                        </select>   
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for=""> Status </label>
                        <select name="status" id=""  class="form-control">
                            <option value="Passed" @if(isset($singleRow)) @if($singleRow->status == 'Passed') selected @endif  @endif>Passed</option>
                            <option value="Introduced" @if(isset($singleRow)) @if($singleRow->status == 'Introduced') selected @endif  @endif>Introduced</option>
                        </select>   
                    </div>
                </div>
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for=""> Bill Type </label>
                        <select name="type" id=""  class="form-control">
                            <option value="pdf" @if(isset($singleRow)) @if($singleRow->type == "pdf") selected @endif  @endif>PDF</option>
                            <option value="jpg" @if(isset($singleRow)) @if($singleRow->type == "jpg") selected @endif  @endif>JPG</option>
                            <option value="png" @if(isset($singleRow)) @if($singleRow->type == "png") selected @endif  @endif>PNG</option>
                            <option value="text" @if(isset($singleRow)) @if($singleRow->type == "text") selected @endif  @endif>Text (Description)</option>
            
                        </select>   
                    </div>
                </div>
                
                <div class="col-md-3">                  
                    <div class="form-group">
                        <label for=""> Select File </label>
                        <input type="file" name="image_pdf_link" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                  
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="image_pdf_link" class="form-control summernote" id="" cols="20" rows="10">@if(isset($singleRow)){{$singleRow->image_pdf_link}}@endif</textarea>
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
    <h3 class="box-title">Bills Data</h3>

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
              <th width="10%">Assembly</th>
              <th width="15%">Assembly Tenure</th>
              <th width="10%">Mover</th>
              <th width="25%">Title</th>
              <th width="10%">date</th>
              <th width="10%">Status</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $parliamentaryyears)
            <tr>
              <td>{{$parliamentaryyears->id}}</td>
              <td>{{$parliamentaryyears->name}}</td>
              <td>{{$parliamentaryyears->assemblyname }}</td>
              <td>{{$parliamentaryyears->name}}</td>
              <td>
              {{Str::limit($parliamentaryyears->title, 20, $end='.......')}}
              </td>
              <td>{{$parliamentaryyears->date}}</td>
              <td>{{$parliamentaryyears->status}}</td>
              <td>
                <a href="{{ route('bills.edit', ['bill' => $parliamentaryyears->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('bills.destroy', ['bill'=> $parliamentaryyears->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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