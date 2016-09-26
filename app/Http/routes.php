<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('games', 'GameController');
Route::resource('expansions', 'ExpansionController');
Route::resource('roles', 'RoleController');
Route::resource('players', 'PlayerController');
//Route::resource('scenarios', 'ScenarioController');
Route::resource('teams', 'TeamController');
Route::resource('statuses', 'StatusController');

Route::post('/roles/reposition', function()
{
	if(Request::has('item'))
	{
		$i = 0;
		foreach(Request::get('item') as $id)
		{
			$i++;
			$item = Role::find($id);
			$item->order = $i;
			$item->save();
		}
		return Response::json(array('success' => true));
	}
	else
	{
		return Response::json(array('success' => false));
	}
});
