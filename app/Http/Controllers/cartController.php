<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Products;
use App\Orders;
use App\orderItems;
use App\Members;
use App\Events\DemoPusher;
use Mail;
use Cart;
use Illuminate\Support\Facades\Session;
class cartController extends Controller
{
    public function addItem(Request $request)
    {
        // id va quantity cua product add vao cart
    	$id = $request->id;
        $quantity = $request->quantity;
        $product = Products::where('id',$id)->FirstOrFail();
        Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => $quantity, 'price' => $product->price, 'options' => ['url_image' => $product->url_image]]);
        // gui du lieu ve cart trong page user 
        $data = array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $quantity,
            'url_image' => $product->url_image
        );
        return response()->json($data);
    }

    public function removeItem(Request $request)
    {
        $id = $request->id;
        $items = Cart::content();
        foreach($items as $item){
            if($item->id == $id){
                Cart::remove($item->rowId);
            }
        }   
        $data = $this->infoCart();
        return response()->json($data);
    }

    // thong tin ve tong gia tri cart
    public function infoCart()
    {
        $data = array(
            'subtotal' => Cart::subtotal(),
            'tax' => Cart::tax(),
            'total' => Cart::total()
        );
        return $data;
    }

    public function viewCart()
    {
    	$items = Cart::content();
        foreach($items as $item){
            $product = Products::where('name',$item->name)->FirstOrFail();
            $item->quantity = $product->quantity; // so luong toi da update trong view cart 
        }
    	return view('/pages/cart',['items' => $items]);
    }

    public function dropCart()
    {
        $items = Cart::content();
        foreach($items as $item){
            Cart::remove($item->rowId);
        }
    }

    public function updateCart(Request $request)
    {
        // manng updateItems chua [{id : "1", quantity : "3"}] cua moi item
        $updateItems  = $request->items;
        $updateItems = json_decode($updateItems);
        $items = Cart::content();
        $index = 0;
        foreach ($items as $item) {
            Cart::update($item->rowId, intval($updateItems[$index]->quantity));
            $index++;
        }
        $data = $this->infoCart();
        return response()->json($data);
    }

    public function Checkout(){
        $items = Cart::content();

        return view('/pages/checkout',['items' => $items]);
    }

    public function Order(Request $request)
    {
        $items = Cart::content();
        $order = new Orders;
        $email = $request->email;
        // luu thong tin trong bang order
        if(Session('username')) {
            $member = Members::where('name',Session('username'))->first();
            $order->member_id = $member->id; 
        }else $order->member_id = 0;          
        $order->nettotal = str_replace(array(',','.'),'',Cart::subtotal())/100;
        $order->tax = $order->nettotal*3/100;
        $order->total= $order->nettotal+$order->tax;
        $order->name = $request->name;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->save();

        // luu cac san pham vao order items
        foreach($items as $item){
            $orderItem = new orderItems;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->id;
            $orderItem->quantity = $item->qty;
            $orderItem->price = $item->price;
            $orderItem->save();
            // cap nhat so luong san pham con lai
            $product = Products::where('id',$item->id)->first();
            $product->quantity = $product->quantity - $item->qty;
            $product->save(); 
        }

        Mail::send('pages/order', ['items' => $items , 'name' => $request->name,'total' => Cart::subtotal()], function($message) use ($email){
            $message->to($email, 'Shop')->subject('Order Ship');
            $message->to('vucongduy192@gmail.com', 'Shop')->subject('Order Ship');
        });

        event(new DemoPusher(""));
        $subtotal = Cart::subtotal();
        //return view('pages/order',['items' => $items , 'name' => $request->name,'total' => $subtotal]);
        
        // luu don hang vao session
      /*  $array_order = $request->session()->get('orders_visitor');
        array_push($array_order,$order);*/
        $request->session()->push('orders_visitor',$order);
        return redirect('/vieworder')->with(['orders_visitor' => $request->session()->get('orders_visitor')]);
        //$this->viewOrder($request);
    }

    public function viewOrder(Request $request)
    {
        return view('pages/order',['orders_visitor' => $request->session()->get('orders_visitor')]);
    }

    public function test(Request $request)
    {
/*        $order = Orders::first();
        $request->session()->put('order',$order);
        echo 'success';*/
        /*$order = DB::select('
            select * 
            from orders
            where total > 40000000
            limit 1    
        ');
        $request->session()->push('orders_visitor',$order);*/
        /*$allOrders = $request->session()->get('orders_visitor');
        foreach ($allOrders as $order) {
            echo $order->name;
        }*/
        $order = DB::select('
            select * 
            from orders
            where total > 40000000
            limit 1    
        ');
        $array_order = $request->session()->get('orders_visitor');
        array_push($array_order,$order);
                $request->session()->push('orders_visitor',$array_order);
         $allOrders = $request->session()->get('orders_visitor');
        foreach ($allOrders as $order) {
            echo $order->name;
        }       
        //echo "session is null";

//        echo $request->session()->get('order');
    }
    public function listOrder()
    {   
        $email = Session('user_email');
        $allOrders = DB::select('
            select *
            from orders
            where  orders.email = :email
            order by id
        ',['email' => $email]);
        
        foreach($allOrders as $order){
            $order->listItem = DB::select('
                select products.*,orders_items.quantity
                from orders_items,products
                where order_id = :id
                    and product_id = products.id
            ',['id' => $order->id]);
            $order->history = DB::select('
                select subcrible,created_at
                from history
                where order_id = :id
            ',['id' => $order->id]);
        }

        return view ('/pages/listOrder',['allOrders' => $allOrders]);
    }
    public function deleteOrder(Request $request)
    {
        $order = Orders::where('id',$request->order_id)->first();
        $order->status = -1;
        $order->total = 0;
        $order->save();
        return back();
    }
}