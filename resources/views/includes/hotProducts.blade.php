	<style>
      .item img{
        max-height: 200px;
      } 
      .item .price{
          font-weight: bold;
          color: #c10017;
      }
  </style>
  <div class="container-fluid" id="hotCatagory">
        <h4>Hot products</h4>
        <div class="owl-carousel owl-theme">
        	   @foreach($bestSellers as $seller)
				<div class="item">
					<a href="/item/{{$seller->id}}"><img src="{{$seller->url_image}}" alt=""></a>
					<h4 style="margin-left: 40px;">{{$seller->name}}</h4>
          <p class="price"><?php echo number_format((string)$seller->price); ?></p>
				</div>
        	@endforeach
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: true
                  },
                 500: {
                    items: 2,
                    nav: true
                  }, 
	               768: {
                    items: 3,
                    nav: true
                  },
                  992: {
                    items: 4,
                    nav: true,
                  },
                  1170: {
                    items: 5,
                    nav: true,
                    loop: false,
                    margin: 20
                  },
                }
             })
        })
    </script>