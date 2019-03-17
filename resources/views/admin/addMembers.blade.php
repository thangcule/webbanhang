@extends('admin.master')
@section('content')
    <section class="content-header">
         @if(session('addNew'))
          <div class="alert alert-info">
            <strong>Member {{session('addNew')}}</strong> has been created successful.
          </div>
      @endif         
    </section>
    <section class="content">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-plus-circle"></i> Add Member</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="/admin/members/add" method="post">
            	              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="box-body">
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Member name">
                  </div>
                </div>

                <div class="form-group">
                  <label for="email" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" placeholder="email">
                  </div>
                </div>

                <div class="form-group">
                  <label for="address" class="col-sm-2 control-label">Address</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" name="address" placeholder="address">
                  </div>
                </div>
				
				        <div class="form-group">
                  <label for="password" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="password" name="password" placeholder="Password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="avatar" class="col-sm-2 control-label">Avatar</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="avatar" name="avatar" placeholder="Avatar">
                  </div>
                </div>
				        <div class="form-group">
                    <label for="date" class="col-sm-2 control-label">Date of birth</label>
                    <div class="col-sm-10">
                        <div class="input-group date" data-provide="datepicker" id="date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control" name="date">
                        </div>
                    </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer col-sm-offset-10">
                <button type="submit" name="back" value="Back" class="btn btn-default" style="margin: 0px 5%;">Back</button>
                <button type="submit" name="add" value="Add" class="btn btn-info">Add</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
         
<script type="text/javascript">
	
</script>
@stop