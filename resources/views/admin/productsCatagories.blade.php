@extends('admin.master')
@section('content')
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <!-- tao cac thong bao them sua xoa -->
      @if(session('addNew'))
          <div class="alert alert-info">
            <strong>Catagory {{session('addNew')}}</strong> has been add.
          </div>
      @endif
      @if(session('justDelete'))
          <div class="alert alert-info">
            <strong>Catagory {{session('justDelete')}}</strong> has been remove.
          </div>
      @endif
      <div id="justEdit"></div>
    </section>

    <!-- Main content -->
    <section class="content">
          <div class="box box-info">
            <div class="box-header">
            	<h3 class="box-title"><i class="fa fa-tags"></i>Catagories Products</h3>
		    	<div class="pull-right"><a class="btn btn-success addNew" href="/admin/products_catagories/add"><i class="fa fa-plus"></i>&nbsp;  Add New</a></div>
          	</div>
            <!-- /.box-header -->
            <div class="box-body">
              <table  class=" data_table table table-bordered table-hover">
					<thead>
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th>Created at</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					@foreach($products_catagories as $catagory)
						<tr id="row{{$catagory->id}}">
							<td>{{$catagory->id}}</td>
							<td id="row_name{{$catagory->id}}">{{$catagory->name}}</td>
							<td>{{$catagory->created_at}}</td>
							<td class="action">
                <!-- view -->
								<a href="/admin/products/{{$catagory->id}}" type="button" class="btn btn-warning"><i class="fa fa-edit"></i>&nbsp;  View </a>
								<!-- Edit -->
                <button type="button" class="btn btn-info edit" data-toggle="modal" data-target="#editModal" data-name="{{$catagory->name}}" id="modal_name{{$catagory->id}}"><i class="fa fa-edit"></i>&nbsp;  Edit </button>
								<!-- delete -->
                <button type="button" class="btn btn-danger delete" data-toggle="modal" data-name="{{$catagory->name}}" data-target="#deleteModal"><i class="fa fa-trash-o"></i>&nbsp;  Delete </button>
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
    <!-- /.content -->
  <!-- box modal to edit catagory -->>
  <div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog"> 
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><i class="fa fa-tags"></i>Edit Catagories</h3>
          <strong><h3 id="chooseCatagory"></h3></strong>
        </div>
        <div class="box-body">
            <form class="form-group" action="#">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <label for="catagory_new_name">Change catagory name : </label>
              <input type="text" class="form-control" autocomplete="off" id="catagory_new_name">
              <input type="hidden" id="catagory_old_name">
          </form>
        </div>
        <div class="box-footer">
              <input type="submit" class="btn btn-info" id="changeNameCatagory" data-dismiss="modal" value="Ok">
              <input type="button" class="btn btn-default" id="cancel" data-dismiss="modal" value="Cancel"> 
        </div>
      </div>
    </div>
  </div>

  <!-- box modal to delete catagory -->
  <div class="modal fade" id="deleteModal" role="dialog">
    <div class="modal-dialog">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><i class="fa fa-tags"></i>Delete Catagories</h3>
          <strong><h3 id="pickCatagory"></h3></strong>
        </div>
        <div class="box-body">
            <form class="form-group" action="/admin/products_catagories/delete" method="post" id="delete_form">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden"  name="delCatagory" id="delCatagory">
              <input onclick="form_submit()" class="btn btn-info" name="delete" data-dismiss="modal" value="Ok" style="text-align: left; width: 45px;">
              <input type="button" class="btn btn-default" name="cancel" data-dismiss="modal" value="Cancel"> 
            </form>
        </div>
      </div>
    </div>
  </div>

    <script type="text/javascript">      
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      function form_submit() {
            document.getElementById("delete_form").submit();
      }    
      /*edit*/
      $(".edit").click(function () {
            // name trong input gui request de sua
            $('#editModal').find('#catagory_old_name').val($(this).data("name"));
            // name tren box modal
            $('#editModal').find('#chooseCatagory').html($(this).data("name"));
      });

      $("#changeNameCatagory").click(function () {
          editCatagory($('#catagory_old_name').val() ,$('#catagory_new_name').val());  
      });

      $('#catagory_new_name').keypress(function(e){
          if(e.which == 13) {
              e.preventDefault();
              $('#editModal').modal('hide');
              $('.modal-backdrop').hide();
              $("#changeNameCatagory").click();
          }
      });

      function editCatagory(old_name,new_name) {
            $.post({
               data: {old_name : old_name, new_name : new_name},
               type: "POST",
               url: '/admin/products_catagories/edit',
               success: function (data) {
                  console.log(data.id);
                  // update so lieu tren row table
                  $('#row'+data.id).find('#row_name'+data.id).html(data.name);
                  //  update so lieu tren thuoc tinh data-name cua button edit
                  $('#row'+data.id).find('#modal_name'+data.id).data("name",data.name) ;
                  // cap nhat thong bao cho admin
                    var str = '<div class="alert alert-info"><strong>Catagory '+old_name
                              + ' </strong> has been change to <strong>'+ new_name + '</strong></div>'

                  $('#justEdit').html(str);
               },
        });
      }
      /*delete*/
      $(".delete").click(function () {
            // name trong input gui request de sua
            console.log($(this).data("name"));
            $('#deleteModal').find('#delCatagory').val($(this).data("name"));
            // name tren box modal
            $('#deleteModal').find('#pickCatagory').html($(this).data("name"));
      });
  </script>
@stop