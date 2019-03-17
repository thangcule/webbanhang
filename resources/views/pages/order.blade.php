@extends('layouts.master')
@section('content')
<style>
	#Invoice{
		margin-top: 180px;
		min-height: 250px;
	}
	#Invoice h3{
	    margin: 1rem 0px;
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
	@if(Session('orders_visitor'))
		@foreach($orders_visitor as $order)
			<div id="Invoice">
				<h3>Customer : {{$order->name}}</h3>
				<div>
					<h3>Order date : {{$order->created_at}}</h3>
					<h3>Total : {{$order->total}}</h3>
					<a href="/login_user" style="margin-left: 10%">Register account to see deltail order</a>
				</div>
			</div>
		@endforeach
	@else
		<div id="Invoice">
			<h3>You don't have any orders</h3>
		</div>
	@endif
@stop