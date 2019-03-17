@extends('admin.master')
@section('content')
    <section class="content-header">
	</section>
    <section class="content">
        @if(session('receipt'))
            <div class="alert alert-info">
                <strong>Posted Goods Receipt</strong>
            </div>
        @endif
		<div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-plus-circle"></i> Edit product</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="/admin/goods-receipt" method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="catagory" class="col-sm-2 control-label">Products</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="product_id">
                                    @foreach($allProducts as $product)
                                        <option value="{{$product->id}}" >{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="quantity" class="col-sm-2 control-label">Quantity</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="quantity" name="quantity">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="quantity" class="col-sm-2 control-label">Price</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="price" name="price">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info pull-right" value="Send">
                    </div>
                </form>
            </div>
        </div>
	</section>
@stop