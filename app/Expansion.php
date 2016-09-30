<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Expansion extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'expansions';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'image'];

	/**
	 * One To Many Relationship
	 * An Expansion can have many Roles
	 *
	 * @var array
	 */
	public function roles()
	{
			return $this->hasMany('App\Role');
	}

}
