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

class DemoController extends Controller {

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
        $this->middleware('guest');
    }

    /**
     * Show the specified photo comment.
     *
     * @param  int  $photoId
     * @param  int  $commentId
     * @return Response
     */
    public function demo()
    {
        $deaths = 1;
        $game = Game::where('id', '=', 1)->firstOrFail();
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
            $scenarios = Scenario::where('deaths', '=', $deaths)->get();
        } else {
            $scenarios = '';
        }
        return view('demo.demo', compact('game', 'roles', 'players', 'statuses', 'teams', 'scenarios'));
    }
}
