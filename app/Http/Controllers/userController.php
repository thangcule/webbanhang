<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use View;
use App\Events\DemoPusher;
use App\productsCatagories;
use App\productSlide;
use App\Products;
use App\orderItems;
use App\Orders;
use Cart;
use App\Providers\session;
class userController extends Controller
{
    public function getPusher()
    {
        return view("demo-pusher");
    }
    public function firePusher()
    {
        event(new DemoPusher("Hi, I'm Trung Quân. Thanks for reading my article!"));
        return "Message has been sent.";
    }
    public function fixKey()
    {
        echo str_replace(array(',','.'),'',Cart::subtotal())/100;
    }

    public function userPage()
    {
    	$allCatagories = productsCatagories::all();
        
        $allProducts = Products::paginate(6);
 		$allSlides = productSlide::all();
 		$bestSellers = $this->bestSeller();
    	return view('pages/home',['allCatagories' => $allCatagories,'allSlides' => $allSlides,'bestSellers' => $bestSellers,'allProducts' => $allProducts]);
    }

    public function bestSeller()
    {
        $bestSellers = DB::select('
            select products.*, count(*) as number
            from orders_items,products
            where products.id = orders_items.product_id
            group by products.id
            order by count(*) desc
            limit 6
        ');
        return $bestSellers;
    }

    public function ajaxPaginate()
    {
        $allProducts = Products::paginate(6);
        return View::make('includes/listItems')->with(['notFound' => '','allProducts' => $allProducts])->render();
    }
    public function ajaxFilter(Request $request)
    {
        $catagories = $request->catagories;
        $min = $request->min*1000000;
        $max = $request->max*1000000;
        $text = $request->text;
        if(!$catagories && $min == 0 && $max == 30000000 && strlen($text) == 0) 
            $allProducts = Products::paginate(6);
        else if($catagories && strlen($text) > 0)
            $allProducts = Products::where(strtolower('name'),'LIKE','%'.$text.'%')->whereIn('catagory_id',$catagories)->whereBetween('price',[$min,$max])->paginate(6);
        else if($catagories) //chi can check catagories rong vi mac dinh min, max luon ko rong 
            $allProducts = Products::whereIn('catagory_id',$catagories)->whereBetween('price',[$min,$max])->paginate(6);
        else if(strlen($text) > 0)
            $allProducts = Products::where(strtolower('name'),'LIKE','%'.$text.'%')->whereBetween('price',[$min,$max])->paginate(6);
        else $allProducts = Products::whereBetween('price',[$min,$max])->paginate(6);
        if($allProducts->count() > 0)
            return View::make('includes/listItems')->with(['allProducts' => $allProducts, 'notFound' => ''])->render();
        else return View::make('includes/listItems')->with(['allProducts' => $allProducts, 'notFound' => 'Not found any products'])->render();
    }
    public function itemPage($product_id)
    {
        $product = Products::where('id',$product_id)->FirstOrFail();
        return view('/pages/item',['product' => $product]);
    }
}