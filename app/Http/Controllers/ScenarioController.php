<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scenario;

class ScenarioController extends Controller {

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
		$this->middleware('role');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
    $scenarios = Scenario::all();
    return view('scenarios.index', compact('scenarios'));
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
      $scenario = Scenario::where('id', '=', $id)->firstOrFail();
      return view('scenarios.show', compact('scenario'));
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
			return view('scenarios.create');
  }

  /**
   * Store a new user.
   *
   * @param  Request  $request
   * @return Response
   */
  public function store(Request $request)
  {
      $scenario = Scenario::create($request->all());
      $scenario->save();
      return redirect('/scenarios');
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
      $scenario = Scenario::where('id', '=', $id)->firstOrFail();
      return view('scenarios.edit', compact('scenario'));
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
      $scenario = Scenario::where('id', '=', $id)->firstOrFail();
      $scenario->update($request->all());
      $scenario->save();
      return redirect('/scenarios');
  }


}
