@extends('layouts.master')
@section('content')
	<style>
        strong{
            color: #999;
        }
        #countCart{
            color: #222;   
        }
		#detailPage{
			background-color: #fff;
            padding-bottom: 60px;
		}
        #sidebar,#relate,#detailPage{
            margin-top: 100px;
        }
        #input_search,#search,#catagory{
            display: none;
        }
        .detail .price{
            color: #c10017;font-weight: bold;
        }
	</style>
        @include('includes.sidebar')
	<div id="detailPage" class="col-md-6 col-sm-9">
        <div class="" id="itemDetail">
	        <div class="detail">
	        	<img src="{{$product->url_image}}" alt="">
		        <div class="mota">
		             <table>
                            <tr>
                                <td colspan="2">
                                    <h4 style="margin-top: -10px">{{$product->name}}</h4>
                                    <p class="price"><?php echo number_format((string)$product->price); ?></p>
                                </td>
                            </tr>
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
                            <tr>
                            	<td>Con lai : </td>
                            	<td id="conlai">{{$product->quantity}}</td>
                            </tr>
                        </table>
			        <form action="#" id="addToCart">
		                <input type="number" step="1" min="0" max="{{$product->quantity}}" name="quantity" value="1" pattern="[0-9]*" inputmode="numeric" id="quantity" data-id="{{$product->id}}">
		    			<input type="button" id="btn_cart" value="Add to cart">
		                <p id="hetsanpham">Not enough quantity to buy</p>
		            </form>
		        </div>
		    </div>        
	    </div>
    </div>
    @include('includes.relate')
@stop