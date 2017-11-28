<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Bet;
use App\Game;
use App\Item;
class admin extends Controller
{

	public function winner(Request $request)
{
	
	$gameid = \DB::table('games')->max('id');	
$tec = \DB::table('winner_tickets')->max('game_id');
if($tec ==$gameid){
\DB::table('winner_tickets')->where('game_id', '=', $gameid)->update(['winnerticket' => $request->get('id')]);} 
else {
\DB::table('winner_tickets')->insertGetId(
['winnerticket' => $request->get('id'), 'game_id' => $gameid]);	
}	
return redirect('/');
}

}
