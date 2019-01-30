<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use App\Time;
use App\Expansion;
use App\Role;
use App\Status;
use App\Scenario;
use App\Player;
use App\Team;
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
   * Edit the specified user.
   *
   * @param  Request  $request
   * @param  int  $id
   * @return Response
   */
  	public function create()
  	{
	  	$expansions = Expansion::all();
		$recipes = Recipe::all()->sortBy('players');
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
				$teams = Team::all();
				$total = $recipe->players;
				$balance = 0;
				foreach($recipe->roles as $role)
				{
						for($x = 1; $x <= $role->recipes()->where('recipe_role.role_id', $role->id)->first()->pivot->total; $x++)
						{
							$balance += $role->impact;
		        }
				}
				$players = Player::where('user_id', '=', \Auth::user()->id)->orderBy('name', 'asc')->get();
				// Create a game
				$game = Game::create(['total' => $total, 'balance' => $balance, 'user_id' => \Auth::user()->id, 'name' => $request->input('name')]);
				$time = Time::create(['round' => 1, 'status' => 'day', 'game_id' => $game->id]);
				$count = 0;
				$roles = $recipe->roles->sortBy('position');
				foreach($roles as $role)
				{
						for($i = 0; $i < $role->recipes()->where('recipe_role.role_id', $role->id)->where('recipe_role.recipe_id', $recipe->id)->first()->pivot->total; $i++)
						{
							$roleCollection[] = Role::find($role->id);
							$game->roles()->attach($role->id, ['position' => $count]);
							$count++;
		        }
				}
				if($total <= 0)
				{
					$roleCollection = null;
				}
				$roles = collect($roleCollection)->sortBy('position')->values();
				foreach($roles as $role)
				{
					$roleIds[] = $role->id;
				}
				$statuses = Status::whereRaw("role_id IN (".implode(", ", $roleIds).")")->get();

				return view('games.names', compact('roles', 'players', 'game', 'teams', 'statuses', 'recipe'));
			} else {
				$roles = Role::whereRaw("expansion_id IN (".implode(", ", $request->input('expansions')).")")->orderBy('position', 'asc')->get();
				$name = $request->input('name');
				return view('games.build', compact('roles', 'name'));
			}
  }

	public function start(Request $request)
  {
			$teams = Team::all();
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
			$players = Player::where('user_id', '=', \Auth::user()->id)->orderBy('name', 'asc')->get();
			// Create a game
			$game = Game::create(['total' => $total, 'balance' => $balance, 'user_id' => \Auth::user()->id, 'name' => $request->input('name')]);
			$time = Time::create(['round' => 1, 'status' => 'day', 'game_id' => $game->id]);
			$count = 0;
			foreach($request->input('role_list') as $key => $role)
			{
					for($x = 1; $x <= $role; $x++)
					{
						$roleCollection[] = Role::find($key);
						$game->roles()->attach($key, ['position' => $count]);
						$count++;
	        }

			}
			if($total <= 0)
			{
				$roleCollection = null;
			}
			$roles = collect($roleCollection)->sortBy('position')->values();
			foreach($roles as $role)
			{
				$roleIds[] = $role->id;
			}
			$statuses = Status::whereRaw("role_id IN (".implode(", ", $roleIds).")")->get();
			$recipe = (object) ['description' => 'The Town of Salem was a prosperous village, children would laugh and play, families would gather together over delicious meals and for years now they have all lived in perfect harmony, until now. Everyone, close your eyes.'];
			return view('games.names', compact('roles', 'players', 'game', 'teams', 'statuses', 'recipe'));

  }

	public function names(Request $request)
  	{
		$game = Game::find($request->input('game'));
		// Attach players to game
		if(is_array($request->input('name_list'))) {
			foreach($request->input('name_list') as $player)
			{
				if(is_numeric($player))
				{
					$currentPlayers[] = $player;						
				} else {
					if($newPlayer = Player::create(['name' => $player, 'user_id' => \Auth::user()->id]))
					{
						$currentPlayers[] = $newPlayer->id;
					}
				}				
			}
		} else {
			$currentPlayers = [];
		}

		foreach($currentPlayers as $key => $player)
		{
			$game->players()->attach($player, ['position' => $key]);
		}

		foreach($request->input('team_list') as $key => $team)
		{
			$game->teams()->attach($team, ['position' => $key]);
		}
		
		if($request->input('status_list')){
			foreach($request->input('status_list') as $key => $positions)
			{
				$status = Status::find($key);
				foreach($positions as $lock => $position)
				{
					$player = $game->players()->where('game_player.position', '=', $lock)->firstOrFail();
					$player->statuses()->attach([$status->id => ['game_id' => $game->id]]);
				}
			}
		}
		
		return redirect('/games/'.$game->id);
	}

	/**
	 * Show the specified photo comment.
	 *
	 * @param  int  $photoId
	 * @param  int  $commentId
	 * @return Response
	 */
	public function show($id, $deaths = 0)
	{
			$game = Game::where('id', '=', $id)->firstOrFail();
			$roles = $game->roles;
			foreach($roles as $role)
			{
				$roleIds[] = $role->id;
			}
			$statuses = Status::whereRaw("role_id IN (".implode(", ", $roleIds).")")->get();
			$teams = Team::all();		
			$players = $game->players;			
			if($game->time->status == 'day')
			{
				if($deaths > 2){
					$scenarios = Scenario::where('deaths', '=', '-99')->get();
				} else {
					$scenarios = Scenario::where('deaths', '=', $deaths)->get();
				}
			} else {
				$scenarios = '';
			}
			return view('games.show', compact('game', 'roles', 'players', 'statuses', 'teams', 'scenarios'));
	}

	/**
	 * Show the specified photo comment.
	 *
	 * @param  int  $photoId
	 * @param  int  $commentId
	 * @return Response
	 */
	public function save(Request $request)
	{
			$game = Game::find($request->input('game'));
			foreach(Status::all() as $status)
			{
				$status->players()->where('game_player.game_id', '=', $game->id)->detach();
			}
			if($request->input('status_list')){
				foreach($request->input('status_list') as $key => $positions)
				{
					$status = Status::find($key);
					foreach($positions as $lock => $position)
					{
						$player = $game->players()->where('game_player.position', '=', $lock)->firstOrFail();
						$player->statuses()->attach([$status->id => ['game_id' => $game->id]]);
					}
				}
			}
			$time = $game->time;
			$time->status = $request->input('status');
			if($request->input('status') == 'night')
			{
				$time->round = ($time->round + 1);
			}
			$time->save();
			$deaths = 0;
			if($request->input('death_list')){
				foreach($request->input('death_list') as $key => $death)
				{
					$player = $game->players()->where('game_player.position', '=', $key)->firstOrFail();
					$game->players()->where('game_id', $game->id)->sync([$player->id => ['status' => 'dead']], false);
					$deaths++;
				}
			}
			if($request->input('team_list')){
				foreach(Team::all() as $team)
				{
					$game->teams()->detach();
					//$team->games()->where('game_team.game_id', '=', $game->id)->detach();
				}
				foreach($request->input('team_list') as $key => $team)
				{
					$game->teams()->attach($team, ['position' => $key]);
				}
			}
			return redirect('/games/'.$game->id.'/'.$deaths);
	}

    public function winner($id)
    {
        $game = Game::where('id', '=', $id)->firstOrFail();
        $roles = $game->roles;
        foreach($roles as $role)
        {
            $roleIds[] = $role->id;
        }
        $statuses = Status::whereRaw("role_id IN (".implode(", ", $roleIds).")")->get();
        $teams = Team::all();
        $players = $game->players;
        return view('games.winner', compact('game', 'roles', 'players', 'statuses', 'teams'));
    }

	public function end(Request $request)
	{
            $game = Game::find($request->input('game'));
			$game->status = 'ended';
			$game->save();

            if($request->input('team_list')){
                foreach($request->input('team_list') as $key => $team)
                {
                    $teams = $game->teams()->where('game_team.team_id', '=', $team)->get();
                    foreach($teams as $team) {
                        $team->sync([$team->id => ['position' => $team->position, 'winner' => 1]], false);
                    }
                }
            }

        return redirect('/games/'.$game->id);
	}
	
	public function remove($id)
   {
		$game = Game::find($id);
		$game->delete();
		return redirect('/');
   }


}
