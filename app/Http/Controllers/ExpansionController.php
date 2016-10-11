<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expansion;

class ExpansionController extends Controller {

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
    $expansions = Expansion::all();
    return view('expansions.index', compact('expansions'));
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
      $expansion = Expansion::where('id', '=', $id)->firstOrFail();
      return view('expansions.show', compact('expansion'));
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
      return view('expansions.create');
  }

  /**
   * Store a new user.
   *
   * @param  Request  $request
   * @return Response
   */
  public function store(Request $request)
  {
      $expansion = Expansion::create($request->all());
      $expansion->save();
			if($request->hasFile('image'))
			{
					$file = $request->file('image');
					if ($file->isValid())
					{
							$file->move(storage_path() . '/uploads/', ($filename = time() . '-' . $file->getClientOriginalName()));
							$expansion->image = ('/uploads/' . $filename);
							$expansion->save();
					}
			}
      return redirect('/expansions');
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
      $expansion = Expansion::where('id', '=', $id)->firstOrFail();
      return view('expansions.edit', compact('expansion'));
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
      $expansion = Expansion::where('id', '=', $id)->firstOrFail();
      $expansion->update($request->all());
      $expansion->save();
			if($request->hasFile('image'))
			{
					$file = $request->file('image');
					if ($file->isValid())
					{
							$file->move(storage_path() . '/uploads/', ($filename = time() . '-' . $file->getClientOriginalName()));
							$expansion->image = ('/uploads/' . $filename);
							$expansion->save();
					}
			}
      return redirect('/expansions');
  }


}
