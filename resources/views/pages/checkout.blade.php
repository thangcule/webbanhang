@extends('layouts/master')
@section('content')
<style>
	#bill, #order{
		margin-top: 20px;
	}
	#bill h3,#order h3{
		margin: 10px;
	}
	table{
		width: 100%;
		margin-top: 35px;
	}
	table tr th{
		font-weight: bold;
		color: #333;
		padding: 12px;
		font-size: 18px;
	}
	table tr td{
		font-size: 16px;
		padding: 12px;
		color: #222;
	}
	table tr td:nth-child(2), table tr th:nth-child(2) {
    	float: right;
	}
	table tr:nth-child(1){
		border-bottom: 3px solid #e2e2e2;
	}
	table tr{
		border-bottom: 1px solid #e2e2e2;	
	}
	.important{
		font-weight: bold;
		color: #222;
	}
	.form-group{
		margin-left: 5%;
		width: 90%
	}
	.control-label{
		font-weight: bold;
    	color: #555;
	}
	.half{
		margin-left: 5%;
		width: 42%; 
		display: inline-block;
	}
	.input-left{
		float: left;
	}
	.input-right{
		margin-right: 5%: 
	}
	abbr{
		color: red;
	}
	.woocommerce-info{
		margin-top: 40px;
	}
</style>
<div class="divide80"></div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="post-2045" class="post-2045 page type-page status-publish hentry">
		    	<div class="woocommerce">
		   		@if(Session('error1'))
					<div class="alert alert-danger" style="margin-top: 50px;">{{session('error1')}}</div>
				@endif
				@if(Session('success'))
					<div class="alert alert-danger" style="margin-top: 50px;">{{session('success')}}</div>
				@endif
	            @if(!Session('username'))
					<div class="woocommerce-info">Returning customer? <a href="#" class="showlogin">Click here to login</a></div>
					<form method="post" class="login" style="display:none;" action="{{route('signin_user')}}">
						{{ csrf_field() }}  
						<input type="hidden" name="checkOut" value="checkOut"> 
						<p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer, please proceed to the Billing &amp; Shipping section.</p>

						<p class="form-row form-row-first" style="width: 50%">
							<label for="username">Username or email <span class="required">*</span></label>
							<input type="text" class="input-text" name="email" id="username" />
						</p>
						<p class="form-row form-row-last">
							<label for="password">Password <span class="required">*</span></label>
							<input class="input-text" type="password" name="password" id="password" />
						</p>
						<div class="clear"></div>
						<p class="form-row">
							<input type="submit" class="button" name="login" value="Login" />
							<label for="rememberme" class="inline">
								<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Remember me		
							</label>
						</p>
						<p class="lost_password">
							<a href="http://crazy-themes.com/demo/assan/my-account/lost-password/">Lost your password?</a>
						</p>
						<div class="clear"></div>
					</form>
				@endif
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid" style="padding-bottom: 80px;"> 
	<div id="bill" class="col-md-6">
		<h3>Billing detail</h3>
		<form action="/order" method="post">
			{{csrf_field()}}
			<div class="form-group">
		    	<label for="name" class="col-sm-2 control-label">Name <abbr class="required" title="required">*</abbr></label>
		    	<input type="text" name="name" class="form-control" required>
		    </div>

			<div class="form-group half input-left">
		    	<label for="name" class="col-sm-2 control-label">Email address <abbr class="required" title="required">*</abbr></label>
		    	<input type="email" name="email" class="form-control" required>
		    </div>

		    <div class="form-group half input-right">
		    	<label for="name" class="col-sm-2 control-label">Phone <abbr class="required" title="required">*</abbr></label>
		    	<input type="text" name="phone" class="form-control" required>
		    </div>
			
			<div class="form-group">
		    	<label for="name" class="col-sm-2 control-label">Address <abbr class="required" title="required">*</abbr></label>
		    	<input type="text" name="address" class="form-control" required>
		    </div>

			<input type="submit" class="btn btn-info pull-right" value="Place Order" name="">
		</form>
	</div>
	<div id="order" class="col-md-6">
		<h3>Your order</h3>
			<table>
				<tr>
					<th>Product</th>
					<th>Total</th>
				</tr>
				@foreach($items as $item)
				<tr>
					<td>{{$item->name}} x {{$item->qty}}</td>
					<td>{{number_format((string)$item->price*$item->qty)}}</td>
				</tr>
				@endforeach
				<tr class="important">
					<td>Subtotal</td>
					<td>{{Cart::subtotal()}}</td>
				</tr>
				<tr class="important">
					<td>Tax</td>
					<td>{{Cart::tax()}}</td>
				</tr>
				<tr class="important">
					<td>Total</td>
					<td>{{Cart::total()}}</td>
				</tr>
			</table>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		    $(".showlogin").click(function(){
		        $(".login").slideToggle("slow");
		    });
		});
</script>
@stop