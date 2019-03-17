<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use DB;
use Illuminate\Http\Request;
use App\productsCatagories;
use App\Products;
use App\Members;
use App\Orders;
use App\orderItems;
use App\History;
use App\productSlide;
use App\historyManager;
use App\Admins;
use App\orderStatus;
use App\goodsReceipt;
use Hash;
use Carbon\Carbon;

class adminController extends Controller
{
    public function change()
    {
        $allOrders = DB::select('
            update orders set total = total*1.1
        ');
    }
    public function adminPage()
    {
         if(session('admin_email')&&session('admin'))
        {
            $today = Orders::where([
                ['created_at', '>=', Carbon::today()],
                ['created_at', '<=', Carbon::tomorrow()],
            ])->get();
            $orders = Orders::orderBy('created_at', 'asc')->get();

            $customers = $this->Customer();
            $bestSellers = $this->bestSellers();
            $Inventory = $this->Inventory();
            $saleByDate = $this->saleByDate(0,6);
            $saleByMonth = $this->saleByMonth(0,6);
            $orderStatus = $this->orderStatus();

            return view('admin.admin_page',['orders' => $orders,'customers' => $customers, 'saleByDate' => $saleByDate,
                'saleByMonth' => $saleByMonth, 'bestSellers' => $bestSellers,'Inventory' => $Inventory, 'today' => $today, 'orderStatus' => $orderStatus]);
        }
        else{
            return redirect()->route('signin');
        }
    }

    public function Customer()
    {   
        $customers = DB::select('
            select email, count(*) as amount, sum(total), avg(total)
            from orders
            group by email
            order by count(*) desc
        ');
        return $customers;
    }

    // cac san pham ban chay nhat
    public function bestSellers()
    {
        $bestSellers = DB::select('
            select products.*, sum(orders_items.quantity) as number
            from orders_items,products
            where products.id = orders_items.product_id
            group by products.id
            order by sum(orders_items.quantity) desc
            limit 6
        ');
        return $bestSellers;
    }

    // cac san pham chua tung dc dat hang
    public function Inventory()
    {
        $Inventory = DB::select('
            select products.name,sum(orders_items.quantity) as sale, products.quantity as  quan_in_stock
            from products, orders_items
            where products.id = orders_items.product_id
            group by products.id
            order by products.id 
        ');
        return $Inventory;
    }
    // so don hang theo ngay
    public function SaleByDate($start, $end)
    {
        $saleByDate = DB::select('
            with tmp as(
                select current_date - step as date
                from generate_series(:start,:end,1) as step
                ),
            tmp2 as(
                    select orders.created_at::date as date,count(*) as number, sum(total) as total
                    from orders
                    group by orders.created_at::date
                    order by orders.created_at::date
                )
            select date, case when total is NULL THEN 0 else total end
            from tmp left join tmp2 using(date)
            order by date
        ',['start' => $start, 'end' => $end]);
        return $saleByDate;
    }    
    public function ajaxSaleByDate(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $saleByDate = $this->SaleByDate($start,$end);
        return response()->json($saleByDate);
    }

    public function SaleByMonth($start, $end)
    {
        $saleByMonth = DB::select('
            with tmp as (
                select to_char((current_date - interval \'1 month\' * a),\'YYYY-MM\') as month
                from generate_series(:start,:end,1) AS s(a)
            ),
            tmp2 as(
                select to_char(created_at,\'YYYY-MM\') as month,count(*) as number, sum(total) as total
                from orders
                group by month
            )
            select month, case when total is NULL THEN 0 else total end 
            from tmp left join tmp2 using(month)
            order by month
        ',['start'=> $start, 'end' => $end]);
        return $saleByMonth;
    }    

    public function ajaxSaleByMonth(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $saleByMonth = $this->SaleByMonth($start,$end);
        return response()->json($saleByMonth);
    }

    public function numberProductInDate(Request $request)
    {
        $name = $request->name;
        $numberProductInDate = DB::select('
            with tmp as(
                select current_date - step as date
                from generate_series(0,6,1) as step
            ),
            tmp2 as(
             select orders_items.created_at::date as date, sum(orders_items.quantity) as number
                        from products,orders_items
                        where products.id = orders_items.product_id
                            and products.name = :name
                        group by orders_items.created_at::date
                        )
            select date,case when number is NULL THEN 0 else number end
            from tmp left join tmp2 using(date)
        ',['name' => $name]);
        
        //$numberProductInDate->toArray()
        return response()->json($numberProductInDate);
    }
    
    // report products sales
    public function reportProducts()
    {
        $allProducts = Products::all();
        $bestSellers = $this->bestSellers();
        $Inventory = $this->Inventory();

        return view('report/products',['allProducts'=> $allProducts, 'bestSellers' => $bestSellers, 'Inventory' => $Inventory]);
    }

    // trang thai cac don hang
    public function orderStatus()
    {
        $orderStatus = DB::select('
            with tmp as (
                select  status, count(*) as number
                from orders
                group by status
            )
            select name as status, case when number is NULL THEN 0 else number end
            from order_status left join tmp on id = status
        ');
        return $orderStatus;
    }



    public function viewGoodsReceipt()
    {
        $allProducts = DB::select('
            select *
            from products
        ');
        return view('/admin/goodsReceipt',['allProducts' => $allProducts]);
    }
    public function goodsReceipt(Request $request)
    {
        $receipt = new goodsReceipt;
        $receipt->product_id = $request->product_id;
        $receipt->quantity = $request->quantity;
        $receipt->price = $request->price;
        $receipt->save();
        return  back()->with(['receipt' => 'ok']);
    }
    public function historyWarehouse()
    {
        $allReceipts = goodsReceipt::all();
        return view('/admin/historyWarehouse',['allReceipts' => $allReceipts]);
    }




    public function getMember($member_id)
    {
        $member = Members::where('id',$member_id)->FirstOrFail();
        return $member;
    }
    /*products_catagories*/
	public function listProductsCatagories()
	{
		$products_catagories = productsCatagories::all();
		return view('admin/productsCatagories',['products_catagories' => $products_catagories]);	
	}
    public function editProductsCatagory(Request $request)
    {
    	$catagory = productsCatagories::where('name', $request->old_name)->FirstOrFail();
    	$catagory->name = $request->new_name;
        $catagory->save();	
        return response()->json(['name'=>$catagory->name,'id' => $catagory->id]);
    }
    public function addProductsCatagory(Request $request)
    {   
        if($request->input('add')){
            $newCatagory = new productsCatagories;
            $newCatagory->name = $request->input('newCatagory');
            $newCatagory->save();
            return redirect('/admin/products_catagories')->with('addNew',$newCatagory->name);
        }
        return redirect('/admin/products_catagories');
    }
    public function deleteProductsCatagory(Request $request)
    {
        if($request->input('delete')){
            $delCatagory = productsCatagories::where('name',$request->delCatagory)->delete();
            return redirect('/admin/products_catagories')->with('justDelete',$request->delCatagory);
        }
        return redirect('/admin/products_catagories');   
    }
    /*==========================*/

    /*products*/
    public function viewProductsCatagory(Request $request)
    {
        if($request->input('add')){
            $newCatagory = new productsCatagories;
            $newCatagory->name = $request->input('newCatagory');
            $newCatagory->save();
            return redirect('/admin/products_catagories')->with('addNew',$newCatagory->name);
        }
        return redirect('/admin/products_catagories');
    }
    public function listProducts()
    {
        $allProducts = Products::all();
        return view('admin/Products',['allProducts'=>$allProducts]);
    }
    public function listProductsInCatagory($catagory)
    {
        $allProducts = Products::where('catagory_id',$catagory)->get();
        return view('admin/Products',['allProducts' => $allProducts]);   
    }
    public function addProduct(Request $request)
    {
        if($request->input('add')){
            $newProduct = new Products;
            $newProduct->name = $request->input('name');
            $newProduct->quantity = $request->input('quantity');
            $newProduct->price = $request->input('price');
            $newProduct->url_image = $request->input('image');
            $newProduct->subcrible = $request->input('subcrible');
            $catagory = productsCatagories::where('name',$request->input('catagory'))->FirstOrFail();
            $newProduct->catagory_id = $catagory->id; 
            $newProduct->save();

            
            return redirect('/admin/products')->with('addNew',$newProduct->name);
        }
        return redirect('/admin/products');
    }
    public function formEditProduct(Request $request)
    {
        $product =  Products::where('id',$request->input('id'))->FirstOrFail();
        return view('admin/editProducts',['product' => $product]);
    }
    public function editProduct(Request $request)
    {
        if($request->input('edit')){
            $product = Products::where('id',$request->input('id'))->FirstOrFail();

            $product->name = $request->input('name');
            $event1 = ""; $event2 = "";
            if($product->quantity != $request->input('quantity')){
                $event1 = "Quantity : ".$product->quantity." to ".$request->input('quantity').'<br>'; 
                $product->quantity = $request->input('quantity');
            }
            if($product->price != $request->input('price')){
                $event2 = "Price : ".$product->price." to ".$request->input('price').'<br>'; 
                $product->price = $request->input('price');
            }
            $product->url_image = $request->input('url_image');
            $product->subcrible = $request->input('subcrible');
            $catagory = productsCatagories::where('name',$request->input('catagory'))->FirstOrFail();
            $product->catagory_id = $catagory->id; 
            $product->save();
            
           
            
            return redirect('/admin/products')->with('justEdit',$product->name);
        }
        return redirect('/admin/products');
    }
    public function deleteProduct(Request $request)
    {
        if($request->input('delete')){
            $delProduct = Products::where('name',$request->delProduct)->delete();
            return redirect('/admin/products')->with('justDelete',$request->delProduct);
        }
        return redirect('/admin/products');   
    }
    /*========================*/

    /*member*/
    public function listCustomers()
    {
        $allCustomers = DB::select('
            with tmp as (
            select email, count(*)
            from orders
            group by email
            )
            select distinct(tmp.email),name,orders.address, tmp.count
            from tmp, orders
            where tmp.email = orders.email
            order by tmp.count desc
            ');
        return view('admin/Customers',['allCustomers'=>$allCustomers]);
    }
    public function listMembers()
    {
        $allMembers = Members::all();
        return view('admin/Members',['allMembers'=>$allMembers]);
    }
    public function addMembers(Request $request)
    {
        if($request->input('add')){
            $newMember = new Members;
            $newMember->name = $request->input('name');
            $newMember->email = $request->input('email');
            $newMember->address = $request->input('address');
            $newMember->password = Hash::make($request->input('password'));
            $newMember->birthday = date('Y-m-d', strtotime($request->input('date')));
            $newMember->save();
            return redirect('/admin/members')->with('addNew',$newMember->name);
        }
        return redirect('/admin/members');
    }
    public function deleteMembers(Request $request)
    {
        if($request->input('delete')){
            $delMember = Members::where('name',$request->delMember)->delete();
            return redirect('/admin/members')->with('justDelete',$request->delMember);
        }
        return redirect('/admin/members');   
    }
    public function formEditMember(Request $request)
    {
        $member =  Members::where('id',$request->input('id'))->FirstOrFail();
        return view('admin/editMembers',['member' => $member]);
    }
    public function editMembers(Request $request)
    {
        if($request->input('edit')){
            $member = Members::where('id',$request->input('id'))->FirstOrFail();
            $member->name = $request->input('name');
            $member->email = $request->input('email');
            $member->password = Hash::make($request->input('password'));
            $member->birthday = date('Y-m-d', strtotime($request->input('date')));
            $member->save();
            return redirect('/admin/members')->with('justEdit',$member->name);
        }
        return redirect('/admin/members');
    }
    /*===========================*/


    /*order manager*/
    public function listOrders()
    {
        $allOrders = Orders::all();
        $total = $allOrders->sum('total');
        return view('admin/orders',['total' => $total, 'allOrders'=>$allOrders]);
    }
    public function listOrdersByCustomer($email)
    {
        $allOrders = Orders::where('email',$email)->get();
        return view('admin/orders',['allOrders'=>$allOrders]);   
    }
    public function listOrdersToday()
    {
        $allOrders = Orders::where([
            ['created_at', '>=', Carbon::today()],
            ['created_at', '<=', Carbon::tomorrow()],
        ])->get();
        $total = $allOrders->sum('total');
        return view('admin/orders',['total'=> $total,'allOrders'=>$allOrders]);
    }
    public function listItemsInOrder($order_id, Request $request)
    {
        $order = Orders::where('id',$order_id)->FirstOrFail();
        $allItems = orderItems::where('order_id',$order_id)->get();
        $request->session()->put('url.intended',url()->current());
        // history
        //$events = History::where('order_id',$order_id)->get();
        $events = History::where('order_id',$order_id)->get();
        $events = $events->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('d');
        });
        return view('admin/orderItems',['allItems' => $allItems, 'order' => $order,'events' => $events]);
    }
    public function updateOrder(Request $request)
    {
        $order = Orders::where('id',$request->order_id)->first();
        $order->status = $request->order_status;
        $order->save();
        return back();      
    }
    public function filterOrder(Request $request)
    {
        /*$pickDate = Carbon::create($request->year, $request->month, $request->day, 0, 0, 0)->toDateTimeString();
        $pickDateTomorrow = Carbon::create($request->year, $request->month, $request->day + 1 , 0, 0, 0)->toDateTimeString();*/
        $pickDate1 = Carbon::create($request->year1, $request->month1, $request->day1, 0, 0, 0)->toDateTimeString();
        $pickDate2 = Carbon::create($request->year2, $request->month2, $request->day2 + 1 , 0, 0, 0)->toDateTimeString();
        $allOrders = Orders::where([
            ['created_at', '>=', $pickDate1],
            ['created_at', '<=', $pickDate2],
        ])->get();
        foreach($allOrders as $order){
            $order->customer = $order->id;
        }
        $total = $allOrders->sum('total');
        return response()->json(['total' => $total,'allOrders'=>$allOrders]);
    }
    public function deleteOrder(Request $request)
    {
        Orders::where('id',$request->id)->delete();
        return redirect()->back()->with('justDelete',$request->id);
    }
    public function deleteItem(Request $request)
    {
        if($request->input('orderId')){
            $delItem = orderItems::where([
                ['order_id',$request->input('orderId')],
                ['product_id',$request->input('itemId')],
            ])->FirstOrFail();

            $order = Orders::where('id',$request->input('orderId'))->FirstOrFail();
            $order->total = $order->total -$delItem->price*$delItem->quantity;
            $order->save(); 
                orderItems::where([
                    ['order_id',$request->input('orderId')],
                    ['product_id',$request->input('itemId')],
                ])->delete();
        }        
        return redirect($request->session()->get('url.intended'));
    }

    public function viewMakeSlider()
    {
        $allProducts = Products::all();
        $allSlides = productSlide::all();

        foreach($allProducts as $product){
            $check = 0;
            foreach ($allSlides as $slide) {
                if($product->id == $slide->product_id){
                    $product->checked = 1; 
                    $check = 1;
                }
            }
            if($check == 0) $product->checked = 0;
        }
        return view('admin/makeSlider',['allProducts' => $allProducts,'allSlides' => $allSlides]);
    }

    public function makeSlider(Request $request)
    {
        $slide = new productSlide;
        $slide->product_id = $request->product_id;
        $slide->image = $request->image;
        $slide->caption = $request->caption;
        $slide->save();

        return redirect()->back();
    }

    public function removeSlider(Request $request)
    {
        productSlide::where('product_id',$request->product_id)->delete();
        return redirect()->back();
    }
    /*=============================*/

    /*history manager : cac thao tac vs database*/
    public function managerHistory()
    {
        $events = historyManager::all();
        return view('admin/managerHistory',['events' => $events]);
    }
    public function saveHistory($action)
    {
        $admin = Admins::where('name',Session('admin'))->first();
        $history = new historyManager;
        $history->admin_id = $admin->id;
        $history->action = $action;
        $history->save();   
    }
    /*================================*/

    /*Test ajax post */
    public function testGet(Request $request)
    {
        return response()->json(['response' => 'This is get method']);
    }
    public function testPost(Request $request)
    {
        $products_catagories = products_catagories::all();
        $new = new products_catagories;
        $new->name = $request->name;
        $new->save();
        return response()->json(['response' => $products_catagories]);
    }
}
