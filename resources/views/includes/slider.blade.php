<style>
	a:hover{
		text-decoration: none;
	}
</style>
<div class="tp-banner-container" style="margin-top: 0px;">
		<div class="tp-banner" >
			<ul>
				<!-- SLIDE  -->
				@foreach($allSlides as $slide)
				<li data-transition="zoomout" data-slotamount="7" data-masterspeed="1500" >
					<!-- MAIN IMAGE -->
					<img src="{{$slide->image}}"  alt="slidebg1"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
					<!-- LAYERS -->
					<!-- LAYER NR. 1 -->
					<div class="tp-caption skewfromrightshort fadeout"
						data-x="800"
						data-y="499"
						data-speed="500"
						data-start="1200"
						data-easing="Power4.easeOut">
						<a href="/item/{{$slide->product_id}}" class="slide-product">More detail</a>
						<a href="#" class="move go-shop">Go to Shop</a>
					</div>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.tp-banner').revolution({
				delay: 3000,
				startwidth:1170,
				startheight:600,
				hideThumbs:10,
				fullWidth:"on",
				forceFullWidth:"on"
			});
			$('.move').click(function (e) {
				e.preventDefault()
				$('html,body').delay(100).animate({scrollTop: $("#shop-main").offset().top - 100},1000);			
			});
		});

	</script>
	