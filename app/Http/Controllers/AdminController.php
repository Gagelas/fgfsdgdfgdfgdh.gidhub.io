<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Game;
use App\Item;
use App\Services\SteamItem;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

const TITLE_UP = "Админка | ";
const ACCESS_ADMIN = true;
const ACCESS_STEAMID64 = false;


public function admin() {		
 if($this->user->is_admin == 1 && self::ACCESS_ADMIN == true){
	 	$adminka = \DB::table('users')->orderBy('id')->get();
	  return view('pages.admin', compact('adminka'));
 }else{
	 return "У вас нет доступа!";
 }
}	
	
public function mute(Request $request){
	if($this->user->is_admin == 1){
		
		$user = \DB::table('users')->where('username', $request->get('steamid'))->first();

if($user->banchat == 1){
		\DB::table('users')
		->where('username', $request->get('steamid'))
		->update(['banchat' => 0]);
}else{
		\DB::table('users')
		->where('username', $request->get('steamid'))
		->update(['banchat' => 1]);
}
	return redirect('/admin');
}
	
		
	
	return redirect('/admin');

}
	
	
public function clearsupport(Request $request) {
	if($this->user->is_admin == 1){
			\DB::table('support')
		->delete();
		\DB::table('supmessages')
		->delete();
		\DB::table('users')->where('request')
		->delete();
		return redirect('/admin');
	}

}

public function supportban(Request $request) {
	
	if($this->user->is_admin == 1){
		$user = \DB::table('users')->where('username', $request->get('steamid'))->first();
		if($user->ban_ticket == 1){
		\DB::table('users')
		->where('username', $request->get('steamid'))
		->update(['ban_ticket' => 0]);
}else{
		\DB::table('users')
		->where('username', $request->get('steamid'))
		->update(['ban_ticket' => 1]);
}
		
	}
	return redirect('/admin');
}

public function setadmin(Request $request) {
	
	if($this->user->is_admin == 1){
	$user = \DB::table('users')->where('username', $request->get('steamid'))->first();

if($user->is_admin == 1){
		\DB::table('users')
		->where('username', $request->get('steamid'))
		->update(['is_admin' => 0]);
}else{
		\DB::table('users')
		->where('username', $request->get('steamid'))
		->update(['is_admin' => 1]);
}
	
	}else{
		
	}
	
	return redirect('/admin');
}

public function sendmoney(Request $request)
{
	
	if($this->user->is_admin == 1){
$user = \DB::table('users')->where('username', $request->get('steamid'))->first();
		$money = $user->money;
		$money2 = $user->money + $request->get('mone') ;
			
		\DB::table('users')
		->where('username', $request->get('steamid'))
		->update(['money' => $money2]);

		return redirect('/admin');
	}
}
public function removemoney(Request $request)
{
	
	if($this->user->is_admin == 1){
$user = \DB::table('users')->where('username', $request->get('steamid'))->first();
		$money = $user->money;
		$money2 = $user->money - $request->get('mone') ;
			if($money2 >= 0 ){
				\DB::table('users')
				->where('username', $request->get('steamid'))
				->update(['money' => $money2]);
			}

		return redirect('/admin');
	}
}
	

}