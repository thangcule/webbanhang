@extends('layouts/master')
@section('content')
	<style>
		#box-loader{
			position: relative;
		}
		.loader{
			position: absolute;
			top: 0px;	
		}
		.woocommerce table.shop_table td, .woocommerce table.shop_table th {
    		border-top: 1px solid rgba(0,0,0,.1);
		}
	</style>
	<div class="divide80"></div>
	<div class="container" style="padding-bottom: 80px;">
		<div id="notificatiom"></div>
	    <div class="col-md-12">
            <div id="post-2044" class="post-2044 page type-page status-publish hentry">
    			<div class="woocommerce">
						<table style="margin-top: 50px;" class="shop_table shop_table_responsive cart" cellspacing="0">
							<tr>
								<th class="product-remove">&nbsp;</th>
								<th class="product-thumbnail">Image</th>
								<th class="product-name">Product</th>
								<th class="product-price">Price</th>
								<th class="product-quantity">Quantity</th>
								<th class="product-subtotal">Total</th>
							</tr>
							@foreach($items as $item)
								<tr class="cart_item">
									<td class="product-remove">
										<a href="#" class="remove" data-id="{{$item->id}}" data-name="{{$item->name}}">&times;</a>					
									</td>
									<td class="product-thumbnail">
										<a href="/item/{{$item->id}}">
											<img width="32" height="180" src="{{$item->options->url_image}}" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image"/>
										</a>					
									</td>
									<td class="product-name" data-title="Product">
										<a href="">{{$item->name}}</a>					
									</td>
									<td class="product-price" data-title="Price">
										<span class="woocommerce-Price-amount amount"><?php echo number_format((string)$item->price); ?></span>					
									</td>
									<td class="product-quantity" data-title="Quantity">
										<div class="quantity">
											<input type="number" step="1" min="1" max="{{$item->quantity}}" value="{{$item->qty}}" class="input-text qty text" size="4" pattern="[0-9]*" data-id="{{$item->id}}" inputmode="numeric" style="width: 43px;height:19px;padding-right: 0" />
										</div>
									</td>
									<td class="product-total" data-title="Total" id="{{$item->id}}" data-price="{{$item->price}}">
										<?php echo number_format((string)$item->qty*($item->price)); ?>					
									</td>
								</tr>
							@endforeach
						</table>	
					<button class="pull-right button_search" id="update">Update</button><br>
					<div class="cart-collaterals" id="invoice" style="width: 50%;float:right;">
						<div id="box-loader">
							<div class="loader"></div>
						</div>
						<div class="cart_totals calculated_shipping">
							<h2>Cart Totals</h2>
							<table cellspacing="0" class="shop_table shop_table_responsive" style="margin-top: 3px">
								<tr class="cart-subtotal">
									<th>Subtotal</th>
									<td id="subtotal" data-title="subtotal" style="float: right;">{{Cart::subtotal()}}</td>
								</tr>
								<tr class="tax-rate tax-rate-us-co-state-tax-1">
									<th>State Tax</th>
									<td id="tax" data-title="tax" style="float: right;">{{Cart::tax()}}</td>
								</tr>
								<tr class="order-total">
									<th>Total</th>
									<td id="total" data-title="total" style="float: right;"><strong>{{Cart::total()}}</strong></td>
								</tr>
							</table>						
							<div class="wc-proceed-to-checkout">
								<a href="/checkout" class="checkout-button button alt wc-forward" style="width: 100%;font-size: 14px;border-radius: 5px;">Proceed to Checkout</a>
							</div>
					</div>
				</div>
			</div><!-- #post-## -->
    	</div>
	</div>
<script type="text/javascript">
	// mang luu id va soluong cac item trong cart
	var items = [ 
	@foreach($items as $item)
		{id: "{{$item->id}}", quantity: "{{$item->qty}}" },
	@endforeach
	];
	
	$(document).ready(function () {
		console.log(items);
		$('.remove').click(function () {
			var id = $(this).data("id");
			var name = $(this).data("name");
			$(this).closest("tr").remove();
			removeItem(id,name); // remove tren server
			updateItems(id); // update mang items
		});

		// cap nhat quantity khi click input tang so luong
		$("input[type='number']").click(function () {
			var quantity = $(this).val();
			var id = $(this).data("id");
			updateQuantity(id, quantity); // update den server
			updateProductTotal(); // update gia tung mat hang
		});

		// update item trong cart
		$('#update').click(function () {
			updateCart();
		});
	});

	// update so luong trong mang items
	function updateQuantity(id, quantity) {
		items.forEach(function (m) {
			if(m.id == id){
				m.quantity = quantity;
			}
		});
		updateCountCart();
	}

	function updateItems(id) {
		items.forEach(function (m) {
			console.log(parseInt(m.id)+' - '+parseInt(id));
			if(parseInt(m.id) == id){
				console.log("removeIt");
				var index = items.indexOf(m);
				items.splice(index,1);
			}
		});
		console.log("removed");	
		updateCountCart();
	}

	function updateCart() {
		str = '<div class="alert alert-info"><strong>Order</strong> has been change.</div>';
		jsonItems = JSON.stringify(items);
		$.ajax({
            data : {items : jsonItems},
            url : '/cart/update',
            success: function (data) {
            	//$('#notificatiom').html(str);
            	updateTotal(data.subtotal, data.tax, data.total);
            }
        });
	}	

	function removeItem(id,name) {
		str = '<div class="alert alert-info"><strong>'+ name + '</strong> has been remove.</div>';
        $.ajax({
            data : {id : id},
            url : '/cart/remove',
            success: function (data) {
            	//$('#notificatiom').html(str);	
            	updateTotal(data.subtotal, data.tax, data.total);
            }
        });
    }

    // update total tren html detail
    function updateProductTotal() {
    	items.forEach(function (m) {
    		var price = $('#'+m.id).data("price");
    		$('#'+m.id).html(m.quantity*price);
    	});
    }

    function updateTotal(subtotal, tax, total) {
    	$('.cart_totals').css("display","none");
    	$('.loader').css("display","block");
    	$('#box-loader').css("height","240px");
    	setTimeout(function () {
    		$('#box-loader').css("height","0px");
    		$('.cart_totals').css("display","block");
    		$('.loader').css("display","none");
    		
    		$('#subtotal').html(subtotal);
	    	$('#tax').html(tax);
	    	$('#total').html(total);
    	},1000);
    }

    function updateCountCart() {
    	console.log(items);
    	var count = 0;
    	if(items.length > 0)
	    	items.forEach(function (m) {
	    		count += parseInt(m.quantity);
	    	});
	    $('#countCart').html(count);
    }
</script>
@stop