@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
@if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->
<div class="box">
    <form action="@if(isset($singleRow)){{ route('motions.update', ['motion'=>$singleRow->id ]) }} @else {{ route('motions.store') }} @endif" method="post" enctype="multipart/form-data">
            @csrf
            @if(isset($singleRow))
                {{ method_field('PUT') }}
            @endif
  <div class="box-header with-border">
    <h3 class="box-title">  Motions Form </h3>

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
                    <label for="">Assembly</label>
                    <select name="assemblies_id" id="" class="form-control">
                        @forelse($assemblies as $assemblytenure)
                        <option value="{{$assemblytenure->id}}" @if(isset($singleRow)) @if($singleRow->assemblies_id == $assemblytenure->id) selected @endif  @endif >{{$assemblytenure->name}} </option>
                        @empty
                        <option value="0">No Assembly</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Assembly Tenure</label>
                    <select name="assembly_tenures_id" id="" class="form-control">
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
                    <label for="">Parliamentary Years</label>
                    <select name="parliamentary_years_id" id="" class="form-control">
                        @forelse($parliamentaryYears as $assemblytenure)
                        <option value="{{$assemblytenure->id}}" @if(isset($singleRow)) @if($singleRow->parliamentary_years_id == $assemblytenure->id) selected @endif  @endif >{{$assemblytenure->name}}</option>
                        @empty
                        <option value="0">No Parliamentary Year</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Session</label>
                    <select name="sessions_id" id="" class="form-control">
                        @forelse($sessions as $assemblytenure)
                        <option value="{{$assemblytenure->id}}" @if(isset($singleRow)) @if($singleRow->sessions_id == $assemblytenure->id) selected @endif  @endif >{{$assemblytenure->fromdate}} To {{$assemblytenure->todate}}</option>
                        @empty
                        <option value="0">No Session</option>
                        @endforelse
                    </select>
                </div>
            </div>            
        </div>
        <div class="row">
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for=""> Sittings</label>
                    <select name="order_of_the_day_summary_of_proceedings_id" id="" class="form-control">
                        @forelse($orderOfTheDaySummaryOfProceedings as $assemblytenure)
                        <option value="{{$assemblytenure->id}}" @if(isset($singleRow)) @if($singleRow->order_of_the_day_summary_of_proceedings_id == $assemblytenure->id) selected @endif  @endif > {{$assemblytenure->sittingsno}} </option>
                        @empty
                        <option value="0">No Assembly</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Movers Names</label>
                    <select name="members_directories_id" id="" class="form-control">
                        @forelse($membersDirectories as $assemblytenure)
                        <option value="{{$assemblytenure->id}}" @if(isset($singleRow)) @if($singleRow->members_directories_id == $assemblytenure->id) selected @endif  @endif > {{$assemblytenure->name}} </option>
                        @empty
                        <option value="0">No Assembly</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">motion status</label>
                    <select name="status" id="" class="form-control">
                        <option value="Admitted for Discussion" @if(isset($singleRow)) @if($singleRow->status == 'Admitted for Discussion') selected @endif  @endif>Admitted for Discussion</option>
                        <option value="Answered" @if(isset($singleRow)) @if($singleRow->status == 'Answered') selected @endif  @endif>Answered</option>
                        <option value="Lapsed" @if(isset($singleRow)) @if($singleRow->status == 'Lapsed') selected @endif  @endif>Lapsed</option>
                        <option value="Not Pressed / Satisfied" @if(isset($singleRow)) @if($singleRow->status == 'Not Pressed / Satisfied') selected @endif  @endif>Not Pressed / Satisfied</option>
                        <option value="Refer to the Privilege Committee" @if(isset($singleRow)) @if($singleRow->status == 'Refer to the Privilege Committee') selected @endif  @endif>Refer to the Privilege Committee</option>
                        <option value="Referred To The Standing Committee" @if(isset($singleRow)) @if($singleRow->status == 'Referred To The Standing Committee') selected @endif  @endif>Referred To The Standing Committee</option>
                        <option value="Satisfied" @if(isset($singleRow)) @if($singleRow->status == 'Satisfied') selected @endif  @endif>Satisfied</option>
                        <option value="Withdrawn" @if(isset($singleRow)) @if($singleRow->status == 'Withdrawn') selected @endif  @endif>Withdrawn</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Motion Type</label>
                    <input type="text" class="form-control" name="motiontype" value="@if(isset($singleRow)){{$singleRow->motiontype}}@endif">
                </div>
            </div>           
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Number</label>
                    <input type="text" class="form-control" name="motionno" value="@if(isset($singleRow)){{$singleRow->motionno}}@endif">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="title" value="@if(isset($singleRow)){{$singleRow->title}}@endif">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Category</label>
                    <select name="typetabs" id="" class="form-control">
                        <option value="Privilege Motion" @if(isset($singleRow)) @if($singleRow->typetabs == 'Privilege Motion') selected @endif  @endif> Privilege Motion</option>
                        <option value="Adjournment Motion" @if(isset($singleRow)) @if($singleRow->typetabs == 'Adjournment Motion') selected @endif  @endif> Adjournment Motion</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Document Type (Image, PDF, Text)</label>
                    <select name="type" id="" class="form-control">
                        <option value="pdf" @if(isset($singleRow)) @if($singleRow->type == "pdf") selected @endif  @endif>PDF</option>
                        <option value="jpg" @if(isset($singleRow)) @if($singleRow->type == "jpg") selected @endif  @endif>JPG</option>
                        <option value="png" @if(isset($singleRow)) @if($singleRow->type == "png") selected @endif  @endif>PNG</option>
                        <option value="text" @if(isset($singleRow)) @if($singleRow->type == "text") selected @endif  @endif>Text (Description)</option>
            
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for=""> (Image, PDF, Text)</label>
                    <input type="file" class="form-control" name="image_pdf_link">
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
    <h3 class="box-title">Motions</h3>

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
              <th width="10%">Assembly</th>
              <th width="10%">Assembly Tenure</th>
              <th width="10%">Parl.. Year</th>
              <th width="10%">Session</th>
              <th width="10%">Sitting</th>
              <th width="10%">Mover</th>
              <th width="10%">Title</th>
              <th width="5%">status</th>
              <th width="5%">type</th>
              <th width="5%">Number</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $parliamentaryyears)
            <tr>
              <td>{{$parliamentaryyears->assemblyname}}</td>
              <td>{{$parliamentaryyears->sessionsfromdate}} to {{$parliamentaryyears->sessionstodate}}</td>
              <td>{{$parliamentaryyears->parliamentary_years_name }}</td>
              <td>{{$parliamentaryyears->sessionsfromdate }} to {{$parliamentaryyears->sessionstodate }}</td>
              <td>{{$parliamentaryyears->sittingsno }}</td>
              <td>{{$parliamentaryyears->membername}}</td>
              <td>{{$parliamentaryyears->title}}</td>
              <td>{{$parliamentaryyears->status}}</td>
              <td>{{$parliamentaryyears->motiontype}}</td>
              <td>{{$parliamentaryyears->motionno}}</td>
              <td>
                <a href="{{ route('motions.edit', ['motion' => $parliamentaryyears->id]) }}" class="btn btn-primary">Edit</a> 
                <form style="width: 47%; float: right;" action="{{ route('motions.destroy', ['motion'=> $parliamentaryyears->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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
