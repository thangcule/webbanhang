<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Members;
class Orders extends Model
{
    protected $table = 'orders';
    public function getOrderMember()
    {
    	$member = Members::where('id',$this->member_id)->first();
    	if(!$member) {
    		$member = new Members;
    		$member->name = "visitor";
    		$member->email = "visitor@gmail.com";
    	}
    	return $member;
    }
}
