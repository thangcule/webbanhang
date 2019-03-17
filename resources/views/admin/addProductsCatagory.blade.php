@extends('admin.master')
@section('content')
<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
		  <h3 class="box-title"><i class="fa fa-plus-circle"></i> Add catagory</h3>
		</div>
		<form class="form-horizontal" action="/admin/products_catagories/add" method="post">
			<div class="box-body">
				<div class="form-group">
					<label for="first-name" class="col-sm-3 control-label">New catagory: </label>
					<div class="col-sm-9">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="text" name="newCatagory" placeholder="name" class="form-control">
					</div>
				</div>
				<div class="col-sm-offset-10">
					<input type="submit" name="add" class="btn btn-info" value="Add" style="margin: 0px 5%">
					<input type="submit" name="back" class="btn btn-default" value="Back">
				</div>
			</div>
		</form>
	</div>		  
</section>
<script type="text/javascript">
	
</script>
@stop