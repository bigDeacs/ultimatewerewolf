<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;
use App\Role;

class StatusController extends Controller {

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
    $statuses = Status::all();
    return view('statuses.index', compact('statuses'));
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
      $status = Status::where('id', '=', $id)->firstOrFail();
      return view('statuses.show', compact('status'));
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
			return view('statuses.create', compact('roles'));
  }

  /**
   * Store a new user.
   *
   * @param  Request  $request
   * @return Response
   */
  public function store(Request $request)
  {
      $status = Status::create($request->all());
      $status->save();
      return redirect('/statuses');
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
      $status = Status::where('id', '=', $id)->firstOrFail();
			$roles = Role::all()->lists('name', 'id');
      return view('statuses.edit', compact('status', 'roles'));
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
      $status = Status::where('id', '=', $id)->firstOrFail();
      $status->update($request->all());
      $status->save();
      return redirect('/statuses');
  }


}
