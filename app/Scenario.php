<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Scenario extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'scenarios';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['deaths', 'description'];

}
