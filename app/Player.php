<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'players';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'status', 'notes', 'team_id', 'user_id', 'role_id'];

	/**
	 * One To Many Relationship
	 * A Player belongs to a specific User
	 *
	 * @var array
	 */
	 public function user()
   {
       return $this->belongsTo('App\User');
   }

 /**
	* One To Many Relationship
	* A Player has a specific Role
	*
	* @var array
	*/
	public function role()
	 {
			 return $this->belongsTo('App\Role');
	 }

  /**
	 * One To Many Relationship
	 * A Player has a specific Role
	 *
	 * @var array
	 */
	public function team()
	{
		 return $this->belongsTo('App\Team');
 	}

 	/**
	 * Many To Many Relationship
	 * A Game can have many players
	 *
	 * @var array
	 */
 	public function games()
 	{
 	 		return $this->belongsToMany('App\Game');
 	}

	public function getGameListAttribute()
	{
			return $this->games->lists('id');
	}

	/**
	 * Many To Many Relationship
	 * A Player can have many Statuses
	 *
	 * @var array
	 */
	public function statuses()
	{
			return $this->belongsToMany('App\Status');
	}

	public function getStatusListAttribute()
	{
			return $this->statuses->lists('id');
	}

}
