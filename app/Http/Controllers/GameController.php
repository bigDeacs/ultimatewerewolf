<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use App\Expansion;
use App\Role;
use App\Status;
use App\Player;
use App\Recipe;

class GameController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Player Controller
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
    $games = Game::all();
    return view('games.index', compact('games'));
	}

  /**
   * Show the specified photo comment.
   *
   * @param  int  $photoId
   * @param  int  $commentId
   * @return Response
   */
  public function show($id)
  {
      $game = Game::where('id', '=', $id)->firstOrFail();
			dd($game->roles);
      return view('games.show', compact('game'));
  }

  /**
   * Edit the specified user.
   *
   * @param  Request  $request
   * @param  int  $id
   * @return Response
   */
  public function create()
  {
			$expansions = Expansion::all();
			$recipes = Recipe::all();
      return view('games.create', compact('expansions', 'recipes'));
  }

  /**
   * Store a new user.
   *
   * @param  Request  $request
   * @return Response
   */
  public function store(Request $request)
  {
      $game = Game::create($request->all());
      $game->save();
      return redirect('/games');
  }


  /**
   * Edit the specified user.
   *
   * @param  Request  $request
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
      $game = Game::where('id', '=', $id)->firstOrFail();
      return view('games.edit', compact('game'));
  }

  /**
   * Update the specified user.
   *
   * @param  Request  $request
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
      $game = Game::where('id', '=', $id)->firstOrFail();
      $game->update($request->all());
      $game->save();
      return redirect('/games');
  }

	public function build(Request $request)
  {
			if($request->input('recipe') != null)
			{
				$recipe = Recipe::find($request->input('recipe'));
				dd($recipe->roles);
				// build game
			} else {
				$roles = Role::whereRaw("expansion_id IN (".implode(", ", $request->input('expansions')).")")->get();
				return view('games.build', compact('roles'));
			}
  }

	public function start(Request $request)
  {
			// has list of roles, and names.
			// attach names to game.
			// count # of roles
			$total = 0;
			$balance = 0;
			foreach($request->input('role_list') as $key => $role)
			{
					for($x = 1; $x <= $role; $x++)
					{
						$total ++;
						$balance += Role::find($key)->impact;
	        }
			}
			$players = Player::where('user_id', '=', \Auth::user()->id)->get();
			// Create a game
			$game = Game::create(['total' => $total, 'balance' => $balance, 'user_id' => \Auth::user()->id, 'name' => 'Game: '.date('d-m-Y')]);

			foreach($request->input('role_list') as $key => $role)
			{
					for($x = 1; $x <= $role; $x++)
					{
						$roleCollection[] = Role::find($key);
	        }
					$game->roles()->attach($key, ['total' => $role]);
			}
			if($total <= 0)
			{
				$roleCollection = null;
			}
			$roles = collect($roleCollection)->sortBy('position')->values();

			return view('games.names', compact('roles', 'players', 'game'));

  }

	public function names(Request $request)
  {
			$game += Role::find($request->input('game'));
			// Attach players to game
			if(is_array($request->input('name_list'))) {
					$currentPlayers = array_filter($request->input('name_list'), 'is_numeric');
					$newPlayers = array_diff($request->input('name_list'), $currentPlayers);
					foreach($newPlayers as $newPlayer)
					{
							if($player = Player::create(['name' => $newPlayer, 'user_id' => \Auth::user()->id]))
							{
									$currentPlayers[] = $player->id;
							}
					}
			} else {
					$currentPlayers = [];
			}
			$game->players()->sync($currentPlayers);

			return redirect('/games/'.$game->id);
  }



}
