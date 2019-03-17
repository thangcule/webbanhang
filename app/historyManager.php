<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Admins;
class historyManager extends Model
{
    protected $table = 'history_manager';
    public function getAdmin()
    {
    	$admin = Admins::where('id',$this->admin_id)->first();
    	return $admin;
    }
}
