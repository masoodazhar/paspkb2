@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">
@if($message = Session::get('success'))
<div class="alert alert-success"> {{ $message }} </div>
@endif
<!-- Default box -->

<div class="box">

    <form action="@if(isset($singleRow)){{ route('publicaccountscommitteemember.update', ['publicaccountscommitteemember'=>$singleRow->id ]) }} @else {{ route('publicaccountscommitteemember.store') }} @endif" method="post" enctype="multipart/form-data">
            @csrf
            @if(isset($singleRow))
                {{ method_field('PUT') }}
            @endif
  <div class="box-header with-border">
    <h3 class="box-title">  Committee Members Form </h3>

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
                        <option value="1" @if(isset($singleRow)) @if($singleRow->page == '1') selected @endif  @endif> public account committee </option>
                        <option value="2" @if(isset($singleRow)) @if($singleRow->page == '2') selected @endif  @endif> Committees on Rules of Procedure & Privileges </option>
                        <option value="3" @if(isset($singleRow)) @if($singleRow->page == '3') selected @endif  @endif> Finance Committee </option>
                        <option value="4" @if(isset($singleRow)) @if($singleRow->page == '4') selected @endif  @endif> Business Advisory committee </option>
                        <option value="5" @if(isset($singleRow)) @if($singleRow->page == '5') selected @endif  @endif> Library Committee </option>
                        <option value="6" @if(isset($singleRow)) @if($singleRow->page == '6') selected @endif  @endif> House committee </option>
                        <option value="7" @if(isset($singleRow)) @if($singleRow->page == '7') selected @endif  @endif> Construction committee </option>
                        <option value="8" @if(isset($singleRow)) @if($singleRow->page == '8') selected @endif  @endif> Special committee </option>

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
    <h3 class="box-title">Committee Members List</h3>
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
              <th width="15%">Page Name </th>
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
                @if($parliamentaryyears['data']->page == '1')
                public account committee
                @elseif ($parliamentaryyears['data']->page == '2')
                Committees on Rules of Procedure & Privileges
                @elseif ($parliamentaryyears['data']->page == '3')
                Finance Committee
                @elseif ($parliamentaryyears['data']->page == '4')
                Business Advisory committee
                @elseif ($parliamentaryyears['data']->page == '5')
                Library committee
                @elseif ($parliamentaryyears['data']->page == '6')
                House committee
                @elseif ($parliamentaryyears['data']->page == '7')
                Construction Advisory committee
                @elseif ($parliamentaryyears['data']->page == '8')
                Special committee
                @endif
              </td>
              <td>{{$parliamentaryyears['data']->name }}</td>
              <td>
                <a href="{{ route('publicaccountscommitteemember.edit', ['publicaccountscommitteemember' =>$parliamentaryyears['data']->id]) }}" class="btn btn-primary">Edit</a>
                <form style="width: 47%; float: right;" action="{{ route('publicaccountscommitteemember.destroy', ['publicaccountscommitteemember'=>$parliamentaryyears['data']->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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
