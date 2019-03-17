@extends('admin.master')
@section('content')
  <style>
      .go-shop,.slide-product{
          font-family: 'Source Sans Pro', sans-serif;
          border-radius: 2px;
          padding: 10px 15px 8px;
          letter-spacing: 2px;
          font-size: 14px;
          font-weight: 700;
      }
      .tp-caption .slide-product{
          background: #3ECCB5;
          color: #fff;
      }
      .tp-caption .go-shop{
          background: transparent;
          color: #fff;
          border: 1px solid #fff;
      }
      .tp-caption a:hover{
          color: #000;
          background: #fff;   
      }
      .subcrible{
          color: #fff;
          font-size: 20px;
          font-weight: bold;
          margin-bottom: 15px;
      }
      .image,.caption{
        display: block;
        width: 80%;
        margin: 10px;
      }
  </style>
	<section class="content">
		<style>
			.btn-default,.btn-success{
				font-weight: bold;
				border-radius: 20px;
			}
		</style>
        <div class="col-md-4">   
          <div class="box box-info">
            <div class="box-header">
            	<h3 class="box-title"><i class="fa fa-tags"></i>Products</h3>
          	</div>
            <!-- /.box-header -->
            <div class="box-body">
              <table  class=" data_table table table-bordered table-hover">
					<thead>
					<tr>
						<th>Name</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					@foreach($allProducts as $product)
						<tr>
							<td>{{$product->name}}</td>
              @if($product->checked == 1)
							<td>
                  <input type="checkbox" checked="checked" class="switch {{$product->id}}" data-id="{{$product->id}}" data-name="{{$product->name}}" data-toggle="toggle"  data-onstyle="success">
              </td>
              @else 
              <td>
                  <input type="checkbox" class="switch {{$product->id}}" data-id="{{$product->id}}" data-name="{{$product->name}}"  data-toggle="toggle" data-onstyle="success">
              </td>
              @endif
						</tr>
					@endforeach
					</tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
          <div class="col-md-8">
                <div class="tp-banner-container rev_slider_wrapper fullwidthbanner-container">
                    <div class="tp-banner" >
                      <ul id="slider">
                        <!-- SLIDE  -->
                        @foreach($allSlides as $slide)
                        <li data-transition="zoomout" data-slotamount="7" data-masterspeed="1500" >
                          <!-- MAIN IMAGE -->
                          <img src="{{$slide->image}}"  alt="slidebg1"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                          <!-- LAYERS -->
                          <!-- LAYER NR. 1 -->
                          <div class="tp-caption skewfromrightshort fadeout"
                            data-x="550"
                            data-y="400"
                            data-speed="500"
                            data-start="1200"
                            data-easing="Power4.easeOut">
                            <a href="#" class="slide-product">More detail</a>
                            <a href="#" class="go-shop">Go to Shop</a>
                          </div>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                </div>
          </div>
          <input type="hidden" data-toggle="modal" id="add" data-target="#addSlide">
          <input type="hidden" data-toggle="modal" id="remove" data-target="#removeSlide">
  	</section>
    
    <!-- modal add new slide -->
    <div class="modal fade" id="addSlide" role="dialog">
        <div class="modal-dialog">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-tags"></i>Add slide</h3>
                    <strong><h3 id="pickMember"></h3></strong>
                </div>
              <div class="box-body">
                  <form class="form-group post_form" action="/admin/products_new" id="add-form" method="post">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <span id="product-add-show"></span>
                      <input type="hidden" name="product_id" id="product-add-post">
                      <strong>Url image : </strong>
                      <textarea type="text" name="image" class="image"></textarea><br>
                      <input onclick="form_submit1()" class="btn btn-info" data-dismiss="modal" value="Add" style="text-align: left; width: 45px;">
                      <input type="button" class="btn btn-default"  id="cancel1" name="cancel" data-dismiss="modal" value="Cancel"> 
                  </form>
              </div>
            </div>
        </div>
    </div>
    <!-- ======================== -->
    <!-- modal remove slide -->
    <div class="modal fade" id="removeSlide" role="dialog">
        <div class="modal-dialog">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-tags"></i>Remove slide</h3>
                    <strong><h3 id="pickMember"></h3></strong>
                </div>
              <div class="box-body">
                  <form class="form-group" action="/admin/products_new_remove" id="remove-form" method="post">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <span id="product-remove-show"></span>
                      <input type="hidden" name="product_id" id="product-remove-post">
                      <input onclick="form_submit2()" class="btn btn-info" data-dismiss="modal" value="Remove" style="text-align: left; width: 45px;">
                      <input type="button" class="btn btn-default" id="cancel2" name="cancel" data-dismiss="modal" value="Cancel"> 
                  </form>
              </div>
            </div>
        </div>
    </div>
    <!-- ========================= -->
    <script type="text/javascript">
        var addSlide;
        $(function () {
            $('.data_table').DataTable();
            $('#DataTables_Table_0_length').parent().css({"width":"100%","display":"none"});
            $('#DataTables_Table_0_filter').css("width","100%");
            $('#DataTables_Table_0_info').parent().css("display","none");
            $('.tp-banner').revolution({
                 delay:5000,
                 sliderLayout: 'auto'
            });
        
        });
        function form_submit1() {
            $('#add-form').submit();
        } 
        function form_submit2() {
            $('#remove-form').submit();
        } 

         $('#addSlide').on("hidden.bs.modal",function () {
              $(".switch" ).unbind("change",changeToggle);
              $('.'+addSlide).bootstrapToggle('off');
              $(".switch" ).change("click",changeToggle);
         });
         $('#removeSlide').on("hidden.bs.modal",function () {
              $(".switch" ).unbind("change",changeToggle);
              $('.'+addSlide).bootstrapToggle('on');
              $(".switch" ).change("click",changeToggle);
         });        

        function changeToggle() {
            if(this.checked){
                addSlide = $(this).data("id");
                $('#product-add-post').val($(this).data("id"));
                $('#product-add-show').html("<strong>"+$(this).data("name")+"</strong><br>");
                $('#add').trigger('click');

             }else {
                addSlide = $(this).data("id");
                $('#product-remove-post').val($(this).data("id"));
                $('#product-remove-show').html("<strong>"+$(this).data("name")+"</strong><br>");
                $('#remove').trigger('click');
             }
          }
        $(".switch" ).change( "click",changeToggle);
    </script>
@stop