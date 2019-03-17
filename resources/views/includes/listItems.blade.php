<style>
    table{
        border: none;
    }
</style>
    <div class="loader"></div>
    <div class="row">
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
        <h4>{{$notFound}}</h4>
    </div>
