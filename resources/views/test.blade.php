{{--<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="csrf-token" content="{{ csrf_token() }}" />
  	<title>AdminLTE 2 | Fixed Layout</title>
  	<!-- Tell the browser to be responsive to screen width -->
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  	<!-- Bootstrap 3.3.7 -->
  	<link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  	<style>
  		.show{
  			display: block;
  		}
  		.hidden{
  			display: none;
  		}
  	</style>
</head>
<body>
	<div class="container">
		@foreach($allCatagory as $catagory)
			<input type="button" class="btn btn-default filter" value="{{$catagory->name}}">
		@endforeach
		<input type="button" class="btn btn-default filter" value="View all">
	</div>
	<div class="container" id="filter_box"></div>
	<br>
	<div class="container" id="box_product">
		<div class="row">
			<div class="col-md-3" id="slider-range"></div><br>
			<h4>Price : <span id="start">5</span>tr - <span id="stop">15</span>tr</h4>
			@foreach($allProduct as $product)
				<div class="product {{$product->getCatagory()->name}}">
					<input type="hidden" value="{{$product->price/1000000}}">
					<h1>{{$product->name}} - {{$product->price/1000000}}tr</h1>
				</div>
			@endforeach
		</div>
	</div>



	<script src="{{asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
	<script src="{{asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript">
		var catagory_arr = [];
		$(document).ready(function () {
			$('.filter').click(function () {
				var catagory = $(this).val();
				var str = '<input type="button" class="btn btn-danger del_filter" value="'+catagory+'">';
				$('#filter_box').append(str);
				catagory_arr.push(catagory);
				console.log(catagory_arr);
				startFilter();
				filterByName();
				$('.del_filter').on("click", function () {
				console.log('dsa');
/*				popArrayByValue($(this).val());
				filterByName();*/
			});
			});
			

			/*$( "#slider-range" ).slider({
				range: true,
				min: 0,
				max: 30,
				values: [ 5, 15 ],
				slide: function( event, ui ) {
					$('#start').html(ui.values[0]);
					$('#stop').html(ui.values[1]);
					$('.product').each(function () {
						if($(this).find('input').val() < ui.values[0] || $(this).find('input').val() > ui.values[1])
							$(this).css("display","none");
						else $(this).css("display","block");
					});
				}
			});*/
		});	
		
		function filterByName() {
			catagory_arr.forEach(function (catagory) {
				$('.product').each(function () {
					if($(this).hasClass(catagory)){
						$(this).removeClass("hidden");
					}
				});
			});	
		}
		function popArrayByValue(remove) {
			catagory_arr.forEach(function (val) {
				if(val == remove){
					var index = catagory_arr.indexOf(val);
					catagory_arr.splice(index,1);
				}
			});
		}
		function startFilter() {
			$('.product').each(function (){
				$(this).addClass("hidden");
			});			
		}
	</script>
</body>
</html>--}}
<style>
	span{
		font-size: 18px;
		font-weight: bold;
	}
</style>
@foreach($allOrders as $order)
	<span>{{$order->order_id}} - </span>
@endforeach
<br>
@foreach($checks as $check)
	<span>{{$check->id}} - </span>
@endforeach