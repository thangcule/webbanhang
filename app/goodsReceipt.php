<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Products;
class goodsReceipt extends Model
{
    protected $table = 'goods_receipt';
    public $timestamps = false;
    public function getProductName()
    {
    	$product = Products::where('id',$this->product_id)->first();
    	return $product;
    }
}
