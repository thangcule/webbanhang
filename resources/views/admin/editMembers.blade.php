@extends('admin.master')
@section('content')
    <section class="content-header">
    </section>
    <section class="content">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-plus-circle"></i> Add Member</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="/admin/members/edit" method="post">
            	              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="box-body">
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="hidden" name="id" value={{$member->id}}>
                    <input type="text" class="form-control" id="name" name="name" value="{{$member->name}}">
                  </div>
                </div>

                <div class="form-group">
                  <label for="email" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <div class="form-control">{{$member->email}}</div>
                    <input type="hidden" class="form-control" id="email" name="email" placeholder="email" value="{{$member->email}}">
                  </div>
                </div>
                
                <input type="hidden" class="form-control" id="password" name="password" value="{{$member->password}}">

                <div class="form-group">
                  <label for="avatar" class="col-sm-2 control-label">Avatar</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="avatar" name="avatar" placeholder="Avatar" value="{{$member->avatar}}">
                  </div>
                </div>
				        <div class="form-group">
                    <label for="date" class="col-sm-2 control-label">Date of birth</label>
                    <div class="col-sm-10">
                        <div class="input-group date" data-provide="datepicker" id="date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control" name="date" value="{{$member->birthday}}">
                        </div>
                    </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer col-sm-offset-10">
                <button type="submit" name="back" value="Back" class="btn btn-default" style="margin: 0px 5%;">Back</button>
                <button type="submit" name="edit" value="Edit" class="btn btn-info">Edit</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
         
<script type="text/javascript">
	   $('.datepicker').datepicker()
</script>
@stop