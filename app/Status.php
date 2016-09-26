<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'statuses';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 * colour = colour on the background, nullable.
	 * icon = font awesome icon
	 */
	protected $fillable = ['name', 'description', 'icon', 'colour'];

	/**
	 * Many To Many Relationship
	 * A Player can have many Statuses
	 *
	 * @var array
	 */
	public function players()
	{
			return $this->belongsToMany('App\Player');
	}

	public function getPlayerListAttribute()
	{
			return $this->players->lists('id');
	}

	/**
	 * Many To Many Relationship
	 * A Status can belong to many Roles
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
