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
Route::get('roles/{roles}/remove', ['as' => 'roles.remove', 'uses' => 'RoleController@remove']);
Route::resource('recipes', 'RecipeController');
Route::resource('players', 'PlayerController');
Route::get('players/{players}/remove', ['as' => 'players.remove', 'uses' => 'PlayerController@remove']);
Route::resource('scenarios', 'ScenarioController');
Route::resource('teams', 'TeamController');
Route::resource('statuses', 'StatusController');
Route::resource('users', 'UserController');

Route::post('sort', '\Rutorika\Sortable\SortableController@sort');

Route::post('games/build', 'GameController@build');
Route::post('games/start', 'GameController@start');
Route::post('games/names', 'GameController@names');
Route::post('games/save', 'GameController@save');
Route::get('games/{id}/end', 'GameController@end');
Route::get('games/{id}/{deaths?}', 'GameController@show');

Route::get('nukacola', 'HomeController@nukacola');