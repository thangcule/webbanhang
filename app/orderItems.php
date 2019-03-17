<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Products;
use App\Member;
class orderItems extends Model
{
    protected $table = 'orders_items';
    public function getProduct()
    {
    	$product = Products::where('id',$this->product_id)->FirstOrFail();
    	return $product;
    }
    public function getOrderMember()
    {
    	
    }
}
