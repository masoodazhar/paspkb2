@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">

<!-- Default box -->
<div class="box">
<form action="" method="post">
  <div class="box-header with-border">
    <h3 class="box-title">Cabinet Composition Form</h3>

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
                    <label for="">Image</label>
                    <input type="file" name="aboutheading" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Tabs</label>
                    <select name="" id="" class="form-control">
                        <option value="">Tab 1</option>
                        <option value="">Tab 2</option>
                        <option value="">Tab 3</option>
                        <option value="">Tab 4</option>
                    </select>
                </div>
            </div>
           
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Date</label>
                    <select name="" id="" class="form-control">
                        <option value="">18 to Today</option>
                        <option value="">Tab 2</option>
                        <option value="">Tab 3</option>
                        <option value="">Tab 4</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Address</label>
                    <textarea name="description" class="form-control summernote" id="" cols="20" rows="10"></textarea>
                
                </div>
            </div>
        </div>
 
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <input type="submit" class="btn btn-primary" value="Submit">
  </div>
</form>
  <!-- /.box-footer-->
</div>
<!-- /.box -->

</section>
<!-- /.content -->

@stop