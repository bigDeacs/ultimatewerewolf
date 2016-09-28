<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'recipes';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 * colour = colour on the background, nullable.
	 * icon = font awesome icon
	 */
	protected $fillable = ['name', 'description', 'players'];

	/**
	 * Many To Many Relationship
	 * A Player can have many Statuses
	 *
	 * @var array
	 */
	public function roles()
	{
			return $this->belongsToMany('App\Role');
	}

	public function getRoleListAttribute()
	{
			return $this->roles->lists('id');
	}

}
