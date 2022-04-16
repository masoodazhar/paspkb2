@extends('master')
@section('content')

 <!-- Main content -->
 <section class="content">

<!-- Default box -->
<div class="box">
<form action="" method="post">
  <div class="box-header with-border">
    <h3 class="box-title">  Stages of bills Form </h3>

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
                    <select name="" id="" class="form-control">
                        <option value="">1st Assembly</option>
                        <option value="">2nd Assembly</option>
                        <option value="">3rd Assembly</option>
                        <option value="">4th Assembly</option>
                        <option value="">5th Assembly</option>
                        <option value="">6th Assembly</option>
                        <option value="">... Assembly</option>
                        <option value="">50th Assembly</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for=""> Heading (Name) </label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for=""> Chairperson </label>
                    <select name="" id="" class="form-control">
                        <option value="">Fetch from member</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for=""> Members </label>
                    <select name="" id="" class="form-control" multiple>
                        <option value="">Fetch From Members</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for=""> display blow Details (Select Tabs)</label>
                    <select name="" id="" class="form-control">
                        <option value="">Business Reffered</option>
                        <option value="">Reports</option>
                        <option value="">SubCommittee</option>
                        <option value="">Notification</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for=""> Select Pages</label>
                    <select name="" id="" class="form-control">
                        <option value="">Committee Rules</option>
                        <option value="">Public Accounts Committee</option>
                        <option value="">Finance Committee</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for=""> Name (Heading) </label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for=""> Category (PDF, Text, Image) </label>
                    <select name="" id="" class="form-control">
                        <option value="">Text</option>
                        <option value="">Image</option>
                        <option value="">PDF</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">                  
                <div class="form-group">
                    <label for=""> Select (PDF, Image) </label>
                    <input type="file" class="form-control">
                </div>
            </div>
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
