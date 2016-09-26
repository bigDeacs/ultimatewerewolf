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
Route::get('games/{games}/activate', ['as' => 'games.activate', 'uses' => 'GameController@activate']);
Route::get('games/{gamesgames}/deactivate', ['as' => 'games.deactivate', 'uses' => 'GameController@deactivate']);

Route::resource('expansions', 'ExpansionController');
Route::get('expansions/{expansions}/activate', ['as' => 'expansions.activate', 'uses' => 'ExpansionControlleractivate']);
Route::get('expansions/{expansions}/deactivate', ['as' => 'expansions.deactivate', 'uses' => 'ExpansionController@deactivate']);

Route::resource('roles', 'RoleController');
Route::get('roles/{roles}/activate', ['as' => 'roles.activate', 'uses' => 'RoleController@activate']);
Route::get('roles/{roles}/deactivate', ['as' => 'roles.deactivate', 'uses' => 'RoleController@deactivate']);

Route::resource('players', 'PlayerController');

Route::resource('scenarios', 'ScenarioController');
Route::get('scenarios/{scenarios}/activate', ['as' => 'scenarios.activate', 'uses' => 'ScenarioController@activate']);
Route::get('scenarios/{scenarios}/deactivate', ['as' => 'scenarios.deactivate', 'uses' => 'ScenarioController@deactivate']);

Route::resource('teams', 'TeamController');
Route::get('teams/{teams}/activate', ['as' => 'teams.activate', 'uses' => 'TeamController@activate']);
Route::get('teams/{teams}/deactivate', ['as' => 'teams.deactivate', 'uses' => 'TeamController@deactivate']);

Route::resource('games', 'GameController');
Route::get('games/{games}/activate', ['as' => 'games.activate', 'uses' => 'GameController@activate']);
Route::get('games/{games}/deactivate', ['as' => 'games.deactivate', 'uses' => 'GameController@deactivate']);
