<div class="container" id="footer-info">
	<div class="col-md-4">
		<h2>Shop</h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem quam, adipiscing condimentum tristique vel, eleifend sed turpis. Pellentesque cursus arcu id magna euismod in elementum purus molestie.</p>
	</div>
	<div class="col-md-4">
		<h2>Contact</h2>
		<div id="contact-info">
			<ul>
				<li>Address : so 19 Ta Quang Buu, Bach Khoa, Ha Noi</li>
				<li>Mail address: vucongduy192@gmail.com</li>
				<li>Phone : 0971053097</li>
			</ul>
		</div>		
	</div>
	<div class="col-md-4">
		<h2>New Products</h2>
		<ul>
			@foreach($products as $product)
				<a href="/item/{{$product->id}}"><img src="{{$product->url_image}}" alt=""></a>
			@endforeach
		</ul>
	</div>
</div>
<div class="container">
	<div class="col-md-5 col-sm-12 col-xs-12">
	</div>
	<div class="col-md-7 col-sm-12 col-xs-12"></div>
		<ul class="footer_r">
			<li><a href="#"><i class="mdi mdi-facebook"></i></a></li>
			<li><a href="#"><i class="mdi mdi-twitter"></i></a></li>
			<li><a href="#"><i class="mdi mdi-linkedin"></i></a></li>
			<li><a href="#"><i class="mdi mdi-vimeo"></i></a></li>
			<li><a href="#"><i class="mdi mdi-dropbox"></i></a></li>
		</ul>
	</div>
</div>
		
