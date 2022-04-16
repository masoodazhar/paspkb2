@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">

<!-- Default box -->
<div class="box">
<form action="" method="post">
  <div class="box-header with-border">
    <h3 class="box-title">  House Debates Form</h3>

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
                    <label for="">Assembly Tenure</label>
                    <select name="" id="" class="form-control">
                        <option value="">2018 to Todya</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Parliamentary Years</label>
                    <select name="" id="" class="form-control">
                        <option value="">Third Parliamentary Year</option>
                        <option value="">Second Parliamentary Year</option>
                        <option value="">First Parliamentary Year</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Session</label>
                    <select name="" id="" class="form-control">
                        <option value="">2018 to Todya</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for=""> Sittings</label>
                    <select name="" id="" class="form-control">
                        <option value="">2018 to Todya</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for="">Reference Number</label>
                    <input type="text" class="form-control" alt="">
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
