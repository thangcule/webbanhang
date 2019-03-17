<style>
	h4{
		font-weight: bold;	
	}
	#relate img{
		max-width: 50px;
		float: left;
		margin-bottom: 20px;
	}
	#relate .info{
		margin-left: 20px;
		float: left;
	}
	#relate .info p{
		font-weight: bold;
		margin: 0px;
		color: #888;
	}
</style>
<div id="relate" class="col-md-3">
	<h4>Related products</h4>
	@foreach($product->relateProduct() as $product)
		<a href="/item/{{$product->id}}"><img src="{{$product->url_image}}" alt=""></a>
		<div class="info">
			<p>{{$product->name}}</p>
			<p style="color: #c10017">{{$product->price}}</p>
		</div>
		<div style="clear: both"></div>
	@endforeach
</div>