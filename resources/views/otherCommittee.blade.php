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
    <h3 class="box-title">Other Committee Form (Pages)</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
        <form action="@if(isset($assemblyData)) {{ route('othercommittee.update', ['othercommittee'=>$assemblyData->id ]) }} @else {{ route('othercommittee.store') }} @endif" method="post">
                @csrf
                @if(isset($assemblyData))
                {{ method_field('PUT') }}
                @endif
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for=""> Committee Page (heading) </label>
                        <input type="text" name="name" value="@if(isset($assemblyData)){{$assemblyData->name}}@endif " class="form-control">
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

  <!-- /.box-footer-->
</div>

<!-- Default box -->
<div class="box">

  <div class="box-header with-border">
    <h3 class="box-title">Other Committee Form</h3>

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
              <th width="75%">Heading</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
          @forelse($assembly as $assembly)
            <tr>
              <td>{{$assembly->id}}</td>
              <td>{{$assembly->name}}</td>
              <td>
                <a href="{{ route('othercommittee.edit', ['othercommittee' => $assembly->id]) }}" class="btn btn-primary">Edit</a>
                <form style="width: 47%; float: right;" action="{{ route('othercommittee.destroy', ['othercommittee'=> $assembly->id ]) }}" onSubmit="return confirm('Are Your Sure to Delete?')" class="form-inline" method="post">
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
<script>
  $("document").ready(function () {
            $(".open_child").click(function(z){
              $(".child_box").toggle();
            });
        })
</script>
@stop
