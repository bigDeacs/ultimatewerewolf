<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Role;
use App\Response;

class RecipeController extends Controller {

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
		$recipes = Recipe::all();
    return view('recipes.index', compact('recipes'));
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
      $recipe = Role::where('id', '=', $id)->firstOrFail();
      return view('recipes.show', compact('recipe'));
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
			$roles = Role::all()->lists('name', 'id');
			return view('recipes.create', compact('roles'));
  }

  /**
   * Store a new user.
   *
   * @param  Request  $request
   * @return Response
   */
  public function store(Request $request)
  {
      $recipe = Role::create($request->all());
      $recipe->save();
			if(is_array($request->input('game_list'))) {
					$currentRoles = array_filter($request->input('role_list'), 'is_numeric');
			} else {
					$currentRoles = [];
			}
			$recipe->roles()->sync($currentRoles);
      return redirect('/recipes');
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
      $recipe = Recipe::where('id', '=', $id)->firstOrFail();
			$roles = Role::all()->lists('name', 'id');
			return view('recipes.edit', compact('recipe', 'roles'));
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
      $recipe = Recipe::where('id', '=', $id)->firstOrFail();
      $recipe->update($request->all());
      $recipe->save();

			if(is_array($request->input('game_list'))) {
					$currentRoles = array_filter($request->input('role_list'), 'is_numeric');
			} else {
					$currentGames = [];
			}
			$recipe->games()->sync($currentGames);

      return redirect('/recipes');
  }



}
