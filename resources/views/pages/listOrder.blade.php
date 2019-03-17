@extends('layouts/master')
@section('content')
<style>
	#Invoice h3{
		margin: 10px;
		margin-left: 10%;
		font-size: 20px;
	    font-weight: bold;
	    color: #000;
	}
	table{
		width: 80%;
		margin-left: 10%;
		text-align: center;
	}
	
	table tr{
		border: solid 1px #ddd;
	}
	
</style>
	<div class="container" style="margin-top: 150px; min-height: 300px;">
	@foreach($allOrders as $order)
		<div id="Invoice" >
			<h3 style="display: inline-block;">Order #{{$order->id}}</h3>
			<span data-toggle="collapse" data-target="#detail_{{$order->id}}" class="btn btn-info">More detail</span>
			<div class="row collapse" id="detail_{{$order->id}}">
				<div>
					<div id="{{$order->id}}">
		        <div class="col-md-3 col-md-offset-1 status">
                    <div class="circle"><i class="fa fa-check"></i><i class="fa fa-refresh fa-spin"></i></div>
		            <div class="line"></div>
                    <div class="progress">Pending</div>
				</div>
			    <div class="col-md-3 status">
			        <div class="circle"><i class="fa fa-check"></i><i class="fa fa-refresh fa-spin"></i></div>
			        <div class="line"></div>
			        <div class="progress">Processing</div>
				</div>
 	            <div class="col-md-3 status">
	                <div class="circle"><i class="fa fa-check"></i><i class="fa fa-refresh fa-spin"></i></div>
 	                <div class="line"></div>
	            <div class="progress">Shipped</div>
				</div>
                <div class="col-md-1 status">
                	<div class="circle"><i class="fa fa-check"></i><i class="fa fa-refresh fa-spin"></i></div>
					<div class="progress">Delivery</div>
				</div>
				</div>
					<table>
						<tr>
							<th>Item</th>
							<th>Quantity</th>
							<th>Total</th>
						</tr>
						@foreach($order->listItem as $item)
						<tr>
							<td>{{$item->name}}</td>
							<td>{{$item->quantity}}</td>
							<td><?php echo number_format((string)$item->price*$item->quantity); ?></td>
						</tr>	
						@endforeach
					</table>
					<form action="/deleteOrder/{{$order->id}}" method="post">
						{{ csrf_field() }}
						<input type="submit" class="btn btn-danger pull-right" style="margin-right: 100px;" value = "Delete order">
					</form>
					<h3>Order at : {{$order->created_at}}</h3>
					@foreach($order->history as $event)
					<h3>{{$event->created_at}} : {{$event->subcrible}}</h3>
					@endforeach
					<h3>Total : {{$order->total}}</h3>
				</div>
			</div>
		</div>
	@endforeach
	</div>
<script type="text/javascript">

	$(document).ready(function () {
		@foreach($allOrders as $order)
			changeProgressSubcrible({{$order->id}},{{$order->status}});
		@endforeach
	});
	function changeProgressSubcrible(id,status) {
        order_status = /*parseInt($('#select_status').val())*/ status;
        $('#order_status').val(order_status);
        var i = 1;
        $('#'+ id +' > div').each(function () {
            if($(this).hasClass('done')) $(this).removeClass('done');
            if($(this).hasClass('spin')) $(this).removeClass('spin');
			if($(this).hasClass('wait')) $(this).removeClass('wait');

			if(i < order_status){
		        $(this).addClass('done');
			}
		    else if(i > order_status){
				$(this).addClass('wait');   
			}
			else $(this).addClass('spin');
                i++;
           });
    }
</script>
@stop