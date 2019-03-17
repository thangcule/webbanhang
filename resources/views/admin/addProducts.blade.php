@extends('admin.master')
@section('content')
<section class="content">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-plus-circle"></i> Add product</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="/admin/products/add" method="post">
            	              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="box-body">
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Products name">
                  </div>
                </div>

                <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Quantity</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity">
                  </div>
                </div>
				
			         	<div class="form-group">
                  <label for="price" class="col-sm-2 control-label">Price</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="price" name="price" placeholder="Price">
                  </div>
                </div>
				        
                <div class="form-group">
                  <label for="image" class="col-sm-2 control-label">Url image</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="image" name="image" placeholder="Url">
                  </div>
                </div>

                <div class="form-group">
	                <label for="subcrible" class="col-sm-2 control-label">Subcrible</label>
                  	<div class="col-sm-10">
	                  <textarea class="form-control" rows="3" placeholder="Enter ..." name="subcrible" id="subcrible"></textarea>
                    </div>
                </div>

				<div class="form-group">
                  	<label for="catagory" class="col-sm-2 control-label">Catagory</label>
                  	<div class="col-sm-10">
	                  	<select class="form-control" name="catagory">
	                    	@foreach($allCatagories as $catagory)
								          <option value="{{$catagory->name}}">{{$catagory->name}}</option>
	                    	@endforeach
	                  	</select>
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