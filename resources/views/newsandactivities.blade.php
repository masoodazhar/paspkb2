@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">

<!-- Default box -->
<div class="box">
<form action="" method="post">
  <div class="box-header with-border">
    <h3 class="box-title">  News & Activities Form</h3>

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
                    <label for="">Name</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Document Type</label>
                    <select name="" id="" class="form-control">
                        <option value="">PDF</option>
                        <option value="">JPG</option>
                        <option value="">PNG</option>
                        <option value="">Text (Description)</option>
                        <option value="">Text (Link)</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Image, PDF, Link</label>
                    <input type="file" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
              <div class="col-md-12">                  
                <div class="form-group">
                    <label for="">Description</label>
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
