<?php namespace App\Http\Controllers;

use Auth;
use Game;
use Player;
use DB;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
		$games = $user->games;
		$players = $user->players;
		return view('home', compact('user', 'games', 'players', 'roles'));
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function nukacola()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');        
		DB::table('game_player')->truncate();
		DB::table('game_role')->truncate();
		DB::table('game_team')->truncate();
		DB::table('player_status')->truncate();
		DB::table('games')->truncate();
		//DB::table('players')->truncate();
		DB::table('times')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
		return redirect()->back();
	}

	

}
