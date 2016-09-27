<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Expansion;
use App\Response;

class RoleController extends Controller {

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
		$expansions = Expansion::all();
		if(\Request::has('filter'))
		{
			$roles = Role::where('expansion_id', '=', \Request::input('filter'))->get();
		} else {
			$roles = Role::all();
		}
    return view('roles.index', compact('roles', 'expansions'));
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
      $role = Role::where('id', '=', $id)->firstOrFail();
      return view('roles.show', compact('role'));
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
			$expansions = Expansion::all()->lists('name', 'id');
			return view('roles.create', compact('expansions'));
  }

  /**
   * Store a new user.
   *
   * @param  Request  $request
   * @return Response
   */
  public function store(Request $request)
  {
			Role::increment('position');
      $role = Role::create($request->all());
      $role->save();
			if($request->hasFile('image'))
			{
					$file = $request->file('image');
					if ($file->isValid())
					{
							$file->move(storage_path() . '/uploads/', ($filename = time() . '-' . $file->getClientOriginalName()));
							$role->image = ('/uploads/' . $filename);
							$role->save();
					}
			}
      return redirect('/roles');
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
      $role = Role::where('id', '=', $id)->firstOrFail();
			$expansions = Expansion::all()->lists('name', 'id');
			return view('roles.edit', compact('role', 'expansions'));
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
      $role = Role::where('id', '=', $id)->firstOrFail();
      $role->update($request->all());
      $role->save();
			if($request->hasFile('image'))
			{
					$file = $request->file('image');
					if ($file->isValid())
					{
							$file->move(storage_path() . '/uploads/', ($filename = time() . '-' . $file->getClientOriginalName()));
							$role->image = ('/uploads/' . $filename);
							$role->save();
					}
			}
      return redirect('/roles');
  }



}
