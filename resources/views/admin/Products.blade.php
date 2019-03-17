@extends('admin.master')
@section('content')
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <!-- tao cac thong bao them sua xoa -->
      @if(session('addNew'))
          <div class="alert alert-info">
            <strong>Products {{session('addNew')}}</strong> has been add.
          </div>
      @endif
      @if(session('justDelete'))
          <div class="alert alert-info">
            <strong>Products {{session('justDelete')}}</strong> has been remove.
          </div>
      @endif
       @if(session('justEdit'))
          <div class="alert alert-info">
            <strong>Products {{session('justEdit')}}</strong> has been edit.
          </div>
      @endif
      
    </section>

    <!-- Main content -->
    <section class="content">
          <div class="box box-info">
            <div class="box-header">
            	<h3 class="box-title"><i class="fa fa-tags"></i>Products</h3>
		    	<div class="pull-right"><a class="btn btn-success addNew" href="/admin/products/add"><i class="fa fa-plus"></i>&nbsp;  Add New</a></div>
          	</div>
            <!-- /.box-header -->
            <div class="box-body">
              <table  class=" data_table table table-bordered table-hover">
					<thead>
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th>Quantity</th>
						<th>Price</th>
            <th>Subcrible</th>
            <th>Action</th>
					</tr>
					</thead>
					<tbody>
					@foreach($allProducts as $product)
						<tr>
							<td>{{$product->id}}</td>
							<td>{{$product->name}}</td>
							<td>{{$product->quantity}}</td>
              <td>{{$product->price}}</td>
              <td>{{substr($product->subcrible,0,60)}} ...</td>
							<td class="action">
                <!-- edit -->
                <form action="/admin/products/edit" method="get" style="display: inline-block;">
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i>&nbsp;  Edit </button>
								</form>
                <!-- delete -->
                <button type="button" class="btn btn-danger delete" data-toggle="modal" data-name="{{$product->name}}" data-target="#deleteModal"><i class="fa fa-trash-o"></i>&nbsp;  Delete </button>
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
          <h3 class="box-title"><i class="fa fa-tags"></i>Delete Product</h3>
          <strong><h3 id="pickProduct"></h3></strong>
        </div>
        <div class="box-body">
            <form class="form-group" action="/admin/products/delete" method="post" id="delete_form">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden"  name="delProduct" id="delProduct">
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
          $(".delete").click(function () {
            // name trong input gui request de sua
            console.log($(this).data("name"));
            $('#deleteModal').find('#delProduct').val($(this).data("name"));
            // name tren box modal
            $('#deleteModal').find('#pickProduct').html($(this).data("name"));
          });
    </script>
@stop