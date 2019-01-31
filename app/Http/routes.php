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
Route::get('demo', 'DemoController@demo');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('games', 'GameController');
Route::get('games/{games}/remove', ['as' => 'games.remove', 'uses' => 'GameController@remove']);
Route::resource('expansions', 'ExpansionController');
Route::get('expansions/{expansions}/remove', ['as' => 'expansions.remove', 'uses' => 'ExpansionController@remove']);
Route::resource('roles', 'RoleController');
Route::get('roles/{roles}/remove', ['as' => 'roles.remove', 'uses' => 'RoleController@remove']);
Route::resource('recipes', 'RecipeController');
Route::get('recipes/{recipes}/remove', ['as' => 'recipes.remove', 'uses' => 'RecipeController@remove']);
Route::resource('players', 'PlayerController');
Route::get('players/{players}/remove', ['as' => 'players.remove', 'uses' => 'PlayerController@remove']);
Route::resource('scenarios', 'ScenarioController');
Route::get('scenarios/{scenarios}/remove', ['as' => 'scenarios.remove', 'uses' => 'ScenarioController@remove']);
Route::resource('teams', 'TeamController');
Route::get('teams/{teams}/remove', ['as' => 'teams.remove', 'uses' => 'TeamController@remove']);
Route::resource('statuses', 'StatusController');
Route::get('statuses/{statuses}/remove', ['as' => 'statuses.remove', 'uses' => 'StatusController@remove']);
Route::resource('users', 'UserController');
Route::get('users/{users}/remove', ['as' => 'users.remove', 'uses' => 'UserController@remove']);

Route::post('sort', '\Rutorika\Sortable\SortableController@sort');

Route::post('games/build', 'GameController@build');
Route::post('games/start', 'GameController@start');
Route::post('games/names', 'GameController@names');
Route::post('games/save', 'GameController@save');
Route::get('games/{id}/winner', 'GameController@winner');
Route::post('games/end', 'GameController@end');
Route::get('games/{id}/{deaths?}', 'GameController@show');
Route::post('games/reroll', 'GameController@reroll');

Route::get('nukacola', 'HomeController@nukacola');
