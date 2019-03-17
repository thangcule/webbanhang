@extends('layouts/master')
@section('content')
<style>
	#account{
		margin-top: 80px;
	}
</style>
<div class="divide80"></div>
<div id="account" class="container">
    <div class="row">
                <div class="col-md-12">
            <div id="post-2046" class="post-2046 page type-page status-publish hentry">
    <div class="woocommerce">
<nav class="woocommerce-MyAccount-navigation">
	<ul>
					<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard is-active">
				<a href="http://crazy-themes.com/demo/assan/my-account/">Dashboard</a>
			</li>
					<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--orders">
				<a href="http://crazy-themes.com/demo/assan/my-account/orders/">Orders</a>
			</li>
					<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--downloads">
				<a href="http://crazy-themes.com/demo/assan/my-account/downloads/">Downloads</a>
			</li>
					<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-address">
				<a href="http://crazy-themes.com/demo/assan/my-account/edit-address/">Addresses</a>
			</li>
					<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-account">
				<a href="http://crazy-themes.com/demo/assan/my-account/edit-account/">Account Details</a>
			</li>
					<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--customer-logout">
				<a href="http://crazy-themes.com/demo/assan/my-account/customer-logout/">Logout</a>
			</li>
			</ul>
</nav>


<div class="woocommerce-MyAccount-content">
	
@yield('account')

<p>
	From your account dashboard you can view your <a href="http://crazy-themes.com/demo/assan/my-account/orders/">recent orders</a>, manage your <a href="http://crazy-themes.com/demo/assan/my-account/edit-address/">shipping and billing addresses</a> and <a href="http://crazy-themes.com/demo/assan/my-account/edit-account/">edit your password and account details</a>.</p>

</div>
</div>

</div><!-- #post-## -->
        </div>
            </div>
</div>
@stop