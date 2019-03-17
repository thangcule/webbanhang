@extends('layouts.master')
@section('content')
    <style>
        .loader{
            margin-top: 100px;
        }
        #shop-main{
            padding-bottom: 60px;
        }
        #range .price, #catagory p, #cartItem h4{
            font-size: 18px;
            font-weight: bold;
            color: #000;
        }
        .product{
            position: relative;
            height: 300px;
        }
        .advert, .product-option table{
            border: none;
            height: 200px;
        }
        .product-option table tr, .product-option table tr{
            margin: 0px;
        }
    </style>
    <div class="row">
        @include('includes.slider')
    </div>
	@include('includes.hotProducts')
    <div id="shop-main" class="container-fluid">
        @include('includes.sidebar')
        <div id="listItems" class="col-md-9">
        <div class="loader"></div>
        <div>
            {{$allProducts->links()}}    
                @foreach($allProducts as $product)
                    <div class="product col-md-4 col-sm-6 col-xs-12">
                        <div class="advert">                       
                            <h4>{{$product->name}}</h4>
                            <a href="/item/{{$product->id}}"><img src="{{$product->url_image}}" alt=""></a>
                            <p><?php echo number_format((string)$product->price); ?></p>
                        </div>
                        <div class="product-option">    
                            <h4>{{$product->name}}</h4>
                            <p><?php echo number_format((string)$product->price); ?></p>
                            <table>
                                <tr>
                                    <td>Man hinh</td>
                                    <td>LED-backlit IPS LCD, 5.5", Retina HD</td>
                                </tr>
                                <tr>
                                    <td>He dieu hanh</td>
                                    <td>iOS 11</td>
                                </tr>
                                <tr>
                                    <td>Camera truoc</td>
                                    <td>7 MP</td>
                                </tr>
                                <tr>
                                    <td>Camera sau</td>
                                    <td>2 camera 12 MP</td>
                                </tr>
                                <tr>
                                    <td>Dung luong pin</td>
                                    <td>2691 mAh, có sạc nhanh</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endforeach
        	</div>
        </div>
    </div>
    <script type="text/javascript">
        var filtered = 0;
        var Url;
        var min,max,values, text; // cac du lieu filter data dc update khi gap 3 event ben duoi 
        $('#range').html('<strong class="price">Price : '+0+'tr - '+30+'tr</strong>');
        $(document).ready(function () {
            enterEvent();
            loadSlider();
            ajaxPaginate(); // khoi tao hoac reset cac link paginate vs ajax
            // search theo checkbox catagory
            $('.checkCatagory').change(function() {   
                getFilterData();
                eventFilter(); // cac event slider va catagory checkbox
            });
            // search theo range price
            $( "#slider-range" ).on( "slidechange", function( event, ui ) {
                getFilterData();
                $('#range').html('<strong class="price">Price : '+min+'tr - '+max+'tr</strong>');
                eventFilter();   
            });
            // search theo input box
            $('#search').click(function () {
                getFilterData();
                eventFilter();
            });
        });

        function getFilterData() {
            values = $( "#slider-range" ).slider( "option", "values" );
            min = values[0];
            max = values[1];
            text = $('#input_search').val();
        }
        function eventFilter() {
            $('#listItems .row').html('');
            $('.loader').css("display","block");
            setTimeout(function () {    
                var catagories = arrCatagory();
                if(catagories.length == 0 && min == 0 && max == 30 && text.length == 0) {
                    filtered = 0;
                    getPageProducts(1); // dang mac dinh ko filter
                }
                else filterProducts(catagories,min,max,text);
                
            },500);
        }

        function ajaxPaginate() {
            $('.pagination a').on("click",function (e) {
                e.preventDefault(); 
                var page = $(this).attr("href").split('page=')[1]; // lay value page cua link pagination
                getPageProducts(page);
            });
        }

        function getPageProducts(page) {
            if(filtered == 0){
                Url = '/ajax/?page='+page; // truong hop ko loc
            }else{ // 2 url khac nhau neu loc va ko loc
                Url += '&page='+page; // truong hop loc
            }
            if(page) {
                $.ajax({
                    url: Url,
                    success: function (data) {
                        $('#listItems').html(data);
                        ajaxPaginate();
                    }
                });
            }
        }

        function filterProducts(catagories,min,max, text) {
            filtered = 1;
            console.log(catagories + ' - ' + min + ' - ' + max + ' - ' + text);
            $.ajax({
                data: {catagories : catagories,min:min,max:max,text:text},
                url: '/filter',
                success: function (data) {
                    Url = this.url;
                    //console.log(data);
                    $('#listItems').html(data);
                    ajaxPaginate();
                }
            });          
        }

        function arrCatagory() {
            var catagories = [];
            $('.checkCatagory').each(function () {
                if(this.checked){
                    catagories.push($(this).data("id"));
                }
            });
            return catagories;
        }

    	function loadSlider() {
            console.log("dsa");
    		$( "#slider-range" ).slider({
				range: true,
				min: 0,
				max: 30,
				values: [ 0, 30 ],
				slide: function( event, ui ) {
					$('#start').html(ui.values[0]);
					$('#stop').html(ui.values[1]);
				}
			});
    	}
        function enterEvent() {
            $('#input_search').keypress(function (event) {
                if(event.keyCode == 13){
                    var enterText = $('#input_search').val();
                    enterText = enterText.slice(0,enterText.length);
                    $('#search').trigger('click');
                } 
            });
        }
    </script>
@stop