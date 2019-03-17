<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/test','adminController@change');
Route::get('/', 'userController@userPage');
Route::get('/item/{product_id}','userController@itemPage');
Route::get('/ajax','userController@ajaxPaginate');
Route::get('/filter','userController@ajaxFilter');
Route::get('/cart/add','cartController@addItem');
Route::get('/cart/view','cartController@viewCart');
Route::get('/cart/remove','cartController@removeItem');
Route::get('/cart/drop','cartController@dropCart');
Route::get('/cart/update','cartController@updateCart');
Route::post('/order','cartController@Order');
Route::get('/vieworder','cartController@viewOrder');
Route::get('/listOrder','cartController@listOrder');
Route::get('/address',function ()
{
	return view('account/address');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin','adminController@adminPage');

/*product catagories*/
Route::get('/admin/products_catagories','adminController@listProductsCatagories');

Route::get('/admin/products_catagories/add',function (){ return view('admin/addProductsCatagory'); });
Route::post('/admin/products_catagories/add','adminController@addProductsCatagory');

Route::post('/admin/products_catagories/edit','adminController@editProductsCatagory');
Route::post('/admin/products_catagories/delete','adminController@deleteProductsCatagory');
Route::get('/admin/products_catagories/{catagory}','adminController@viewProductsCatagory');

Route::get('/admin/products_new','adminController@viewMakeSlider');
Route::post('/admin/products_new','adminController@makeSlider');
Route::post('/admin/products_new_remove','adminController@removeSlider');
/*======================*/

/*products manager*/
Route::get('/admin/products','adminController@listProducts');
Route::get('/admin/products/add',function (){ return view('admin/addProducts'); });

Route::post('/admin/products/add','adminController@addProduct');
Route::get('/admin/products/edit','adminController@formEditProduct');

Route::post('/admin/products/edit','adminController@editProduct');
Route::post('/admin/products/delete','adminController@deleteProduct');
Route::get('/admin/products/{catagory}','adminController@listProductsInCatagory');
/*======================*/

/*member manager*/
Route::get('/admin/members','adminController@listMembers');
Route::get('/admin/customers','adminController@listCustomers');
Route::get('/admin/members/add',function (){ return view('admin/addMembers'); });
Route::post('/admin/members/add','adminController@addMembers');

Route::get('/admin/members/edit','adminController@formEditMember');
Route::post('/admin/members/edit','adminController@editMembers');

Route::post('/admin/members/delete','adminController@deleteMembers');
/*======================*/

/*order manager*/
Route::post('/deleteOrder/{order_id}','cartController@deleteOrder');
Route::get('/admin/orders','adminController@listOrders');
Route::get('/admin/orders/{order_id}','adminController@listItemsInOrder');
Route::get('/admin/order-customer/{email}','adminController@listOrdersByCustomer');
Route::get('/admin/order-today','adminController@listOrdersToday');
Route::post('/admin/orders/update','adminController@updateOrder');
Route::post('/admin/orders/filter','adminController@filterOrder');
Route::post('/admin/orders/item_delete','adminController@deleteItem');
Route::post('/admin/orders/delete','adminController@deleteOrder');
/*history*/
Route::get('/admin/goods-receipt','adminController@viewGoodsReceipt');
Route::post('/admin/goods-receipt','adminController@goodsReceipt');
Route::get('/admin/warehouse-history','adminController@historyWarehouse');
Route::get('/admin/manager_history','adminController@managerHistory');
/*========================*/
/*Report */
Route::get('/admin/ajax/saleByDate','adminController@ajaxSaleByDate');
Route::get('/admin/ajax/saleByMonth','adminController@ajaxSaleByMonth');
Route::get('/admin/report/products','adminController@reportProducts');
Route::get('/admin/numberProductInDate','adminController@numberProductInDate');
/*=========================*/

Route::get('signin',[
	'as'=>'signin',
	'uses'=>'mycontroller@signint'
]);
Route::post('/dang-nhap',[
	'as'=>'dangnhap',
	'uses'=>'mycontroller@dangnhap'
]);

Route::get('signout',[
	'as'=>'signout',
	'uses'=>'mycontroller@signout'
]);
Route::get('profile',[
	'as'=>'profile',
	'uses'=>'mycontroller@profile'
]);
Route::get('login_user',[
	'as'=>'login_user',
	'uses'=>'mycontroller@login'
]);
route::post('signin_user',[
	'as'=>'signin_user',
	'uses'=>'mycontroller@signin_user'
]);
Route::post('register_user',[
	'as' => 'register_user',
	'uses' => 'mycontroller@register_user'
]);
ROute::get('information');
Route::get('cart',[
	'as'=>'cart',
	'uses'=>'mycontroller@cart'
]);
Route::get('checkout',[
	'as'=>'checkout',
	'uses'=>'cartController@Checkout'
]);
Route::get('signout',[
	'as' => 'signout',
	'uses' => 'mycontroller@signout'
]);
Route::post('order',[
	'as' => 'order',
	'uses' => 'cartController@Order'
]);

Route::get('demo-pusher','userController@getPusher');
Route::get('fire-pusher','userController@firePusher');
