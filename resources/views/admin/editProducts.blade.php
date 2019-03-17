@extends('admin.master')
@section('content')
<section class="content">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-plus-circle"></i> Edit product</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="/admin/products/edit" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="box-body">
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="hidden" name="id" value={{$product->id}}>
                    <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}">
                  </div>
                </div>

                <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Quantity</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="quantity" name="quantity" value="{{$product->quantity}}">
                  </div>
                </div>
        
        <div class="form-group">
                  <label for="price" class="col-sm-2 control-label">Price</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="price" name="price" value="{{$product->price}}">
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="url_image" class="col-sm-2 control-label">Url image</label>
                    <div class="col-sm-10">
                    <input class="form-control" rows="3" value="{{$product->url_image}}" name="url_image" id="url_image">
                    </div>
                </div>

                <div class="form-group">
                  <label for="subcrible" class="col-sm-2 control-label">Subcrible</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" rows="3" value="{{$product->subcrible}}" name="subcrible" id="subcrible">{{$product->subcrible}}</textarea>
                    </div>
                </div>

                 <div class="form-group">
                    <label for="catagory" class="col-sm-2 control-label">Catagory</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="catagory" name="catagory">
                        
                        @foreach($allCatagories as $catagory)
                            @if($catagory->id == $product->catagory_id)
                              <option value="{{$catagory->name}}" style="color: red;" selected="selected" >{{$catagory->name}}</option>
                            @else
                              <option value="{{$catagory->name}}">{{$catagory->name}}</option>
                            @endif
                        @endforeach
                      </select>
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
  
</script>
@stop