    
    <div class="navbar-fixed-top" id="navbar-menu">
        <div class="container-fluid" style="height: 40px;overflow: hidden; background: #fff">
            <div class="row" >
                <div class="pull-right">
                    <div id="text-3" class="top-widget widget_text">            
                        <div class="textwidget">
                            <ul class="list-inline top-dark-right">                      
                                <li class="hidden-sm hidden-xs"><i class="fa fa-envelope"></i> Support@mail.com</li>
                                <li class="hidden-sm hidden-xs"><i class="fa fa-phone"></i> +01 1800 453 7678</li>
                                @if(Session('username'))
                                    <li><a href="/listOrder"><i class="fa fa-user"></i>{{session('username')}}</a></li>
                                @else
                                    <li><a href="{{route('login_user')}}"><i class="fa fa-lock"></i> Login</a></li>
                                @endif
                                <li><a href="{{route('signout')}}"><i class="fa fa-user"></i> Sign Out</a></li>
                                @if(Session('orders_visitor'))
                                <li><a href="/vieworder"><i class="fa fa-user"></i> Order</a></li>
                                @endif
                            </ul>
                        </div>           
                    </div>
                </div>
            </div>
        </div>
        <div class="container">    
            <div class="row" id="bar">
                <div id="logo" class="navbar-header col-md-3 col-sm-3 col-xs-12">
                    <button id="but" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span> 
                    </button>
                    <a href="/" class="navbar-brand">
                        <img src="" alt="">Shop
                    </a>
                </div>
                <div id="menu" class="collapse navbar-collapse col-md-9 col-sm-9 col-xs-12">
                <ul class="nav navbar-nav">
                    <li><a href="/">Home</a></li>
                    <li><a href="/">Shop</a></li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" aria-expanded="false">Contact us<i class="mdi mdi-chevron-down mdi-20px"></i>
                        </a>
                            <ul class="dropdown-menu">
                                <li><a href="#" class="product"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;   Phone</a></li>
                                <li><a href="#" class="product"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;   Gmail</a></li>
                                <li><a href="#" class="product"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;   Our Location</a></li>
                            </ul>
                        </a>
                    </li>
                    <li><a href="/cart/view"><i class="mdi mdi-cart mdi-20px"></i>(<strong id="countCart">{{$countCart}}</strong>)</a></li>
                </ul>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
             if($('.navbar-fixed-top').offset().top > 40){
                $('.navbar-fixed-top').css("margin-top","-40px");
            }
            $(window).scroll(function () {
                if($('.navbar-fixed-top').offset().top > 40){
                    $('.navbar-fixed-top').css("margin-top","-40px");
                }else{
                    $('.navbar-fixed-top').css("margin-top","0px");
                }
            });
        });
    </script>