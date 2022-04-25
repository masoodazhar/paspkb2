@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
@if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->

<div class="box">

    <form action="@if(isset($singleRow)){{ route('othercommitteemember.update', ['othercommitteemember'=>$singleRow->id ]) }} @else {{ route('othercommitteemember.store') }} @endif" method="post" enctype="multipart/form-data">
            @csrf
            @if(isset($singleRow))
                {{ method_field('PUT') }}
            @endif
  <div class="box-header with-border">
    <h3 class="box-title"> Other Committee Members Form </h3>

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
                    <label for="">Page Name</label>
                    <select name="page" id="" class="form-control">
                        @foreach($otherCommitteeHeading as $headeing)
                            <option value="{{$headeing->id}}" @if(isset($singleRow)) @if($singleRow->page == $headeing->id) selected @endif  @endif> {{$headeing->name}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Members</label>
                    <select name="members_directories_id[]" id="" class="form-control" multiple>
                        @forelse($membersDirectories as $assemblytenure)
                        <option value="{{$assemblytenure->id}}" @if(isset($singleRow))@if(in_array($assemblytenure->id, json_decode($singleRow->members_directories_id)) ) selected @endif @endif  > {{$assemblytenure->name}} </option>
                        @empty
                        <option value="0">No Members</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Chair Person</label>
                    <select name="member_chairman" id="" class="form-control">
                        @forelse($membersDirectories as $assemblytenure)
                        <option value="{{$assemblytenure->id}}" @if(isset($singleRow)) @if($singleRow->member_chairman == $assemblytenure->id) selected @endif  @endif > {{$assemblytenure->name}} </option>
                        @empty
                        <option value="0">No Members</option>
                        @endforelse
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
    <h3 class="box-title">Other Committee Members List</h3>
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
              <th width="40%">Members</th>
              <th width="15%">Other Committee Header </th>
              <th width="10%">Chair Person </th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($allRows as $parliamentaryyears)
            <tr>
              <td>
                  @foreach($parliamentaryyears['members'] as $members)
                        <span style="padding: 10px">
                            {{$members->name}},
                        </span>
                  @endforeach
              </td>
              <td>
                {{ $parliamentaryyears['data']->committeename }}
              </td>
              <td>{{ $parliamentaryyears['data']->name }}</td>
              <td>
                <a href="{{ route('othercommitteemember.edit', ['othercommitteemember' =>$parliamentaryyears['data']->id]) }}" class="btn btn-primary">Edit</a>
                <form style="width: 47%; float: right;" action="{{ route('othercommitteemember.destroy', ['othercommitteemember'=>$parliamentaryyears['data']->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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
