<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\productsCatagories;
class Products extends Model
{
    protected $table = 'products';
    public function getCatagory()
    {
    	return productsCatagories::where('id',$this->catagory_id)->FirstOrFail();
    }
    public function relateProduct()
    {
    	$relateProduct = Products::where('catagory_id',$this->catagory_id)->get();	
        
    	return $relateProduct;
    }
}
