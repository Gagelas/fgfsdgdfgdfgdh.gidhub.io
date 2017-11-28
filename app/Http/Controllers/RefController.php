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

class RefController extends Controller
{

const TITLE_UP = "Рефералка | ";

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	
public function ref()
    {
        return view('pages.ref');
    }	
	
	
	public function getcoupon(Request $request)
    {

	   $id = $request->get('idd');	   //(ИД кода)
	   $refid = $request->get('refid');	//(ИД Юзера активировшого)
	   $coupon = \DB::table('refers')->where('refers.usera', '=', $refid)->where('refers.userb', '=', $id)->orderBy('id', 'desc')->get(); //(Прверяем на количество однаковых реферов)
	   $userr = \DB::table('users')->where('users.steamid64', '=', $refid)->orderBy('id', 'desc')->get();
	   $refstatuss = \DB::table('users')->where('steamid64', $refid)->first(); //(Юзер пригласивший)   
	   $checkuser = \DB::table('users')->where('users.steamid64', '=', $id)->orderBy('id', 'desc')->get(); //(Прверяем юзера на наличие в БД)
	   $checkmoney  = \DB::table('users')->where('steamid64', $refid)->first(); //(Юзер пригласивший)
	   $checkmoney2  = \DB::table('users')->where('steamid64', $id)->first(); //(Юзер активирущий)
	   $money1 = $checkmoney->money+10; //(Деньги пригласившего)
	   $money2 = $checkmoney2->money+20; //(Деньги пришедший) 
	   $checkstatus  = \DB::table('users')->where('steamid64', $id)->first(); //(Юзер)	
	   $status = $checkstatus->refcount+1; //(Очки рефера)	   
	   $cstat = $checkstatus->refprofit+20; //(статистика денег рефера)	
	   	$refstatuss1 = $refstatuss->refstatus; //(Очки рефера)	
		
		$checkstatus22  = \DB::table('users')->where('steamid64', $id)->first(); //(Юзер)	
		$cstat22 = $checkstatus22->refprofit+10; //(статистика денег рефера)	
	   
	   

	   
	if($checkuser == NULL || $coupon > NULL || $refid == $id || $refstatuss1 > 0){
	$result =	response()->json([ 'success' => 'false', 'reason' => 'nickname']);	
	
	}else{

\DB::table('refers')->insertGetId(
['usera' => $refid, 'name' => $id, 'userb' => $id]);	


		\DB::table('users')
            ->where('steamid64', $refid)
           ->update(['money' => $money1]);
		   
		\DB::table('users')
            ->where('steamid64', $id)
           ->update(['money' => $money2]);	

		   
		   \DB::table('users')
            ->where('steamid64', $refid)
           ->update(['refstatus' => 1]);	
		   
		   \DB::table('users')
            ->where('steamid64', $id)
           ->update(['refcount' => $status]);
		   
		    \DB::table('users')
            ->where('steamid64', $id)
           ->update(['refprofit' => $cstat]);
		   
		   
		   		    \DB::table('users')
            ->where('steamid64', $refid)
           ->update(['refprofit' => $cstat22]);


		   

		   
	

}
		return redirect('/ref');	   
	}
	
// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------	
// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------



}