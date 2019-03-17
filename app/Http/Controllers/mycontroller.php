<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Members;
use App\Admins;
use App\Orders;
use App\orderItems;
class mycontroller extends Controller
{
	public function signint(){
		if(Session('admin')&&Session('admin_email'))
			{
				return redirect('/admin');
			}
		else
			return view('/login/signint');
	}
	public function dangnhap(Request $rq){
		$email=$rq->email;
    	$pass=$rq->password;
    	$admin=Admins::where('email',$email)->first();
    	if($admin && Hash::check($pass, $admin->password)){
            Session::put('admin',$admin->name);
            Session::put('admin_email',$email);
    		return redirect('/admin');
    	}
    	else
    		return redirect()->route('signin')->with('error','Tài khoản không tồn tại hoặc bạn không có quyền truy cập');
	}
	public function signout(){
		
		if(Session('admin')){
			Session::pull('admin');
			Session::pull('admin_email');
    		return redirect('/admin');
		}else if(Session('username')){
			Session::pull('username');
			Session::pull('user_email');
			return redirect('/');
		}
	}
	public function profile(){
		$name=Session::get('admin');
		$admin=Admins::where('name',$name)->first();
		return view('/login/profile',compact('admin'));
	}

	

	public function signin_user(Request $request){
		$email=$request->email;
		$password=$request->password;
		$member = Members::where('email',$email)->first();
    	if($member && Hash::check($password, $member->password)){
    		Session::put('username',$member->name);
    		Session::put('user_email',$member->email);
    		if($request->checkOut)
				return redirect()->back()->with('success','You are log in');
    		else return redirect('/');
    	}
		else
			return redirect()->back()->with('error1','tài khoản hoặc mật khẩu không chính xác');
	}
	public function register_user(Request $request)
	{
		if(Members::where('email',$request->email)->first()){
			return redirect()->back()->with('error2','Tài khoản đã tồn tại');
		}else{
			$member = new Members;
			$member->email = $request->email;
			$member->name = $request->name;
			$member->birthday = $request->birthday;
			$member->password = Hash::make($request->password);
			$member->address = $request->address;
			$member->save();
			Session::put('username',$request->name);
			Session::put('user_email',$request->email);
			
			return redirect('/');
		}
	}
	public function login(){
		return view('includes/login');
	}
}