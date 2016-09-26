<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;

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
      return view('games.create');
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


}
