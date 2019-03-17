@extends('pages/account')
 @section('account')
 <style>
 	.breadcrumb-wrap {
    padding: 30px 0;
    background-image: url('http://x5musicgroup.com/sp/fade_bg.jpg');
    background-position: center center;
    background-repeat: no-repeat;
    background-color: #f6f6f6;
    border-top: 1px solid #d2d3d4;
    border-bottom: 1px solid #d2d3d4;
}
.text-right {
    text-align: right;
}
ol.breadcrumb {
    margin: 0;
    padding: 0;
    background-color: transparent;
    color: #333;
}
.breadcrumb-wrap h4 {
    margin-top: 80px;
    margin-bottom: 30px;
    font-size: 16px;
    color: #333;
    font-weight: 700;
    letter-spacing: 8px;
    text-transform: uppercase;
    letter-spacing: 2px;
    font-family: "Source Sans Pro", sans-serif;
    line-height: 27px;
}
.woocommerce-MyAccount-navigation li {
    padding: 5px 0;
    border-bottom: 1px solid #e5e5e5;
}
.col-md-12{
    position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
}
.woocommerce-MyAccount-navigation li.is-active a{
    color: #32c5d2;
}
.woocommerce-MyAccount-navigation li a {
    color: #888;
    margin-right: 10px;
}

li {
    display: list-item;
}
a {
    text-decoration: none;
}
ol, ul {
    margin-top: 0;
    margin-bottom: 10px;
}
.woocommerce-MyAccount-navigation ul {
    list-style: none;
    padding-left: 0px;
}
.woocommerce-MyAccount-navigation li > a:after {
    color: #888;
    content: "\f105";
    font-family: 'FontAwesome';
    padding-left: 10px;
}
a:hover{
	text-decoration: none;
}
.woocommerce-MyAccount-navigation li > a:hover a:after {
	padding-left: 20px;
}
.woocommerce-account .woocommerce-MyAccount-content {
    float: right;
    width: 68%;
}
.woocommerce-account .woocommerce-MyAccount-navigation {
    float: left;
    width: 20%;
}
.woocommerce .woocommerce-info {
    border-top-color: #32c5d2;
}
.woocommerce a.button{
	font-size: 14px;
    font-weight: 400;
    background-color: #32c5d2;
    color: #fff;
}
 </style> 
 <div class="u-column1 col-1 woocommerce-Address">
 		<header class="woocommerce-Address-title title">
 			<h3>Billing Address</h3>
 			<a href="http://crazy-themes.com/demo/assan/my-account/edit-address/billing" class="edit">Edit</a>
 		</header>
 		<address>
 			You have not set up this type of address yet.		</address>
 	</div>
 
 
 	<div class="u-column2 col-2 woocommerce-Address">
 		<header class="woocommerce-Address-title title">
 			<h3>Shipping Address</h3>
			<a href="http://crazy-themes.com/demo/assan/my-account/edit-address/shipping" class="edit">Edit</a>
 		</header>
 		<address>
 			You have not set up this type of address yet.		</address>
 	</div>
 </div>