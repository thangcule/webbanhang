@extends('admin.master')
@section('content')
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <!-- tao cac thong bao them sua xoa -->
      @if(session('addNew'))
          <div class="alert alert-info">
            <strong>Members {{session('addNew')}}</strong> has been add.
          </div>
      @endif
      @if(session('justDelete'))
          <div class="alert alert-info">
            <strong>Members {{session('justDelete')}}</strong> has been remove.
          </div>
      @endif      
      @if(session('justEdit'))
          <div class="alert alert-info">
            <strong>Members {{session('justEdit')}}</strong> has been edit.
          </div>
      @endif      
    </section>

    <!-- Main content -->
    <section class="content">
          <div class="box box-info">
            <div class="box-header">
            	<h3 class="box-title"><i class="fa fa-user"></i> Members</h3>
		    	<div class="pull-right"><a class="btn btn-success addNew" href="/admin/members/add"><i class="fa fa-plus"></i>&nbsp;  Add New</a></div>
          	</div>
            <!-- /.box-header -->
            <div class="box-body">
              <table  class=" data_table table table-bordered table-hover">
					<thead>
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th>Email</th>
            <th>Address</th>
						<th>Date of birth</th>
            <th>Created_at</th>
            <th>Action</th>
					</tr>
					</thead>
					<tbody>
				      @foreach($allMembers as $member)
                  <tr class="viewOrdersByCustomer" data-href="/admin/order-customer/{{$member->email}}">
                    <td>{{$member->id}}</td>
                    <td>{{$member->name}}</td>
                    <td>{{$member->email}}</td>
                    <td>{{$member->address}}</td>
                    <td>{{$member->birthday}}</td>
                    <td>{{$member->created_at}}</td>
                    <td class="action">
                      <!-- edit -->
                      <form action="/admin/members/edit" method="get" style="display: inline-block;">
                          <input type="hidden" name="id" value="{{$member->id}}">
                          <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i>&nbsp;  View </button>
                      </form>
                      <!-- delete -->
                      {{--<button type="button" class="btn btn-danger delete" data-toggle="modal" data-name="{{$member->name}}" data-target="#deleteModal"><i class="fa fa-trash-o"></i>&nbsp;  Delete </button> --}}
                    </td>
                  </tr>
                @endforeach
					</tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
  </section>
   
    <!-- box modal to delete catagory -->
  <div class="modal fade" id="deleteModal" role="dialog">
    <div class="modal-dialog">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><i class="fa fa-tags"></i>Delete member</h3>
          <strong><h3 id="pickMember"></h3></strong>
        </div>
        <div class="box-body">
            <form class="form-group" action="/admin/members/delete" method="post" id="delete_form">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden"  name="delMember" id="delMember">
              <input onclick="form_submit()" class="btn btn-info" name="delete" data-dismiss="modal" value="Ok" style="text-align: left; width: 45px;">
              <input type="button" class="btn btn-default" name="cancel" data-dismiss="modal" value="Cancel"> 
            </form>
        </div>
      </div>
    </div>
  </div>
    <script type="text/javascript">      
          function form_submit() {
            document.getElementById("delete_form").submit();
          } 
          $(function(){
              $('.viewOrdersByCustomer').click(function () {
                window.location = $(this).data("href");
              });
          });
          $(".delete").click(function () {
            // name trong input gui request de sua
            console.log($(this).data("name"));
            $('#deleteModal').find('#delMember').val($(this).data("name"));
            // name tren box modal
            $('#deleteModal').find('#pickMember').html($(this).data("name"));
          });
    </script>
@stop