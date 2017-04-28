<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| User Controller
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
    $users = User::where('user_id', '=', \Auth::user()->id)->get();
    return view('users.index', compact('users'));
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
      $user = User::where('id', '=', $id)->firstOrFail();
      return view('users.show', compact('user'));
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
      return view('users.create');
  }

  /**
   * Store a new user.
   *
   * @param  Request  $request
   * @return Response
   */
  public function store(Request $request)
  {
      $user = User::create($request->all());
      $user->save();
      return redirect('/users');
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
      $user = User::where('id', '=', $id)->firstOrFail();
      return view('users.edit', compact('user'));
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
      $user = User::where('id', '=', $id)->firstOrFail();
      $user->update($request->all());
      $user->save();
      return redirect('/users');
  }


}
