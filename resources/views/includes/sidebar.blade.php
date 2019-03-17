<style>
    #cartItem h4{
        margin: 0px;
    }
    .itemInCart img{
        width: 120px;
    }
</style>
<div id="sidebar" class="col-md-3 col-sm-3">
    <input type="text" name="searchItem" id="input_search" placeholder="Search Products">
    <button class="button_search" id="search">Search</button>
    <div id="slider-range"></div><br>
    <div id="range"></div>
    
    <div id="catagory">
        <p>All catagories</p>
        @foreach($allCatagories as $catagory)
            <div class="checkBoxCatagory">
                <input type="checkbox" class="checkCatagory" data-id="{{$catagory->id}}"> 
                <label for="{{$catagory->name}}">{{$catagory->name}}</label>
            </div>
        @endforeach
    </div>
    
    <div id="cartItem">
        <h4>Cart</h4>
        @foreach($items as $item)
            <div class="itemInCart">
                <span class="remove_btn" data-id="{{$item->id}}" data-quantity = "{{$item->qty}}">x</span> 
                <a href="/item/{{$item->id}}"><img src="{{$item->options->url_image}}" alt=""></a>
                <div class="infoItemInCart"> 
                    <p class="name">{{$item->name}}</p>
                    <p class="qty-price">{{$item->qty}} x {{$item->price}}tr</p>
                </div>
            </div>    
            <div style="clear: both;"></div>
        @endforeach
    </div>
    <form action="/cart/view">
        <input type="submit" value="Check out" class="button_search" />
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function () {
            $('#btn_cart').click(function () {
                var quantity = parseInt($('#quantity').val());
                var id = $('#quantity').data("id");
                if(quantity == 0){
                    $('#hetsanpham').css("display","inline-block");
                }
                addItem(id, quantity);
                updateCountCart(quantity);
            });
            $("body").on("click", ".remove_btn",function () {
                $(this).parent().remove();
                var id = $(this).data("id");
                var quantity = -1*parseInt($(this).data("quantity"));
                removeItem(id);
                updateCountCart(quantity);
            });   
        });
        function addItem(id, quantity) {
            console.log($('#quantity').attr("max"));
            var conlai = parseInt($('#quantity').attr("max")) - parseInt(quantity);
            $('#quantity').attr("max",conlai);
            $('#conlai').html(conlai);
            $.ajax({
                data : {id :id, quantity: quantity},
                url : '/cart/add',
                success: function (data) {
                    str =     '<div class="itemInCart">'
                            + '<span class="remove_btn" data-id="'+data.id+'">x</span>' 
                            + '<img src="'+data.url_image+'" alt="">'
                            + '<div class="infoItemInCart">'
                            + '<p class="name">'+data.name+'</p>'
                            + '<p class="qty-price">'+data.quantity+' x '+data.price+'</p></div></div>';
                    $('#cartItem').append(str);
                }
            });
        }
        function removeItem(id) {
            $.ajax({
                data : {id : id},
                url : '/cart/remove',
                success: function (data) {
                    
                }
            });
        }
        var count = <?php echo $updateCount = Cart::count(); ?>;
        function updateCountCart(quantity) {
            console.log(typeof(count)+' - '+typeof(quantity));
            count = count+quantity;
            $('#countCart').html(count);
        }
</script>
