@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
@if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->

<div class="box">

  <form action="@if(isset($singleRow)){{ route('othercommitteedata.update', ['othercommitteedatum'=>$singleRow->id ]) }} @else {{ route('othercommitteedata.store') }} @endif" method="post" enctype="multipart/form-data">
          @csrf
          @if(isset($singleRow))
              {{ method_field('PUT') }}
          @endif
  <div class="box-header with-border">
    <h3 class="box-title">  Committees Form
        |
        <a href="{{ route('othercommittee.index', app()->getLocale()) }}">Add New Committee Heading</a>
        |
        <a href="{{ route('othercommitteemember.index', app()->getLocale()) }}">Add New Committee Heading</a>
    </h3>

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
                    <label for="">Heading</label>
                    <input type="text" class="form-control" name="heading" value="@if(isset($singleRow)){{$singleRow->heading}}@endif">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Date</label>
                    <input type="date" class="form-control" name="date" value="@if(isset($singleRow)){{$singleRow->date}}@endif">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Category</label>
                    <select name="tab_type" id="" class="form-control">
                        <option value="Business Referred" @if(isset($singleRow)) @if($singleRow->tab_type == 'Business Referred') selected @endif  @endif> Business Referred</option>
                        <option value="Reports" @if(isset($singleRow)) @if($singleRow->tab_type == 'Reports') selected @endif  @endif> Reports</option>
                        <option value="Subcommittees" @if(isset($singleRow)) @if($singleRow->tab_type == 'Subcommittees') selected @endif  @endif> Subcommittees</option>
                        <option value="Notifications" @if(isset($singleRow)) @if($singleRow->tab_type == 'Notifications') selected @endif  @endif> Notifications</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Page Name</label>
                    <select name="page" id="" class="form-control">
                        @foreach($otherCommitteeHeading as $headeing)
                            <option value="{{$headeing->id}}" @if(isset($singleRow)) @if($singleRow->page == $headeing->id) selected @endif  @endif> {{$headeing->name}} </option>
                        @endforeach
                    </select>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Document Type</label>
                    <select name="type" id="typeofdocs" class="form-control">
                      <option value="pdf" @if(isset($singleRow)) @if($singleRow->type == "pdf") selected @endif  @endif>PDF</option>
                      <option value="jpg" @if(isset($singleRow)) @if($singleRow->type == "jpg") selected @endif  @endif>JPG</option>
                      <option value="png" @if(isset($singleRow)) @if($singleRow->type == "png") selected @endif  @endif>PNG</option>
                      <option value="text" @if(isset($singleRow)) @if($singleRow->type == "text") selected @endif  @endif>Text (Description)</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3" >
                <div class="form-group" id="selectfile">
                    <label for="">Image, PDF, Link</label>
                    <input type="file" name="image_pdf_link" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="image_pdf_link" class="form-control summernote" id="" cols="20" rows="10">@if(isset($singleRow)){{$singleRow->image_pdf_link}}@else - @endif</textarea>
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
    <h3 class="box-title"> Committees List</h3>
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
              <th width="40%">Heading</th>
              <th width="15%">Page Name </th>
              <th width="10%">Tabs </th>
              <th width="10%">Date </th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $parliamentaryyears)
            <tr>
              <td>{{$parliamentaryyears->heading}}</td>
              <td>
                @if($parliamentaryyears->page == '1')
                public account committee
                @elseif ($parliamentaryyears->page == '2')
                Committees on Rules of Procedure & Privileges
                @elseif ($parliamentaryyears->page == '3')
                Finance Committee
                @elseif ($parliamentaryyears->page == '4')
                Business Advisory committee
                @elseif ($parliamentaryyears->page == '5')
                Library committee
                @elseif ($parliamentaryyears->page == '6')
                House committee
                @elseif ($parliamentaryyears->page == '7')
                Construction Advisory committee
                @elseif ($parliamentaryyears->page == '8')
                Special committee
                @endif
              </td>
              <td>{{$parliamentaryyears->tab_type }}</td>
              <td>{{$parliamentaryyears->date }} </td>
              <td>
                <a href="{{ route('othercommitteedata.edit', ['othercommitteedatum' =>$parliamentaryyears->id]) }}" class="btn btn-primary">Edit</a>
                <form style="width: 47%; float: right;" action="{{ route('othercommitteedata.destroy', ['othercommitteedatum'=>$parliamentaryyears->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input type="submit" class="btn btn-danger" value="Delete" id="">
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" style="text-align:center;">No Data Found</td>
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
