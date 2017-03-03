<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'games';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'total', 'balance', 'status', 'user_id'];

	/**
	 * One To Many Relationship
	 * A Game belongs to a specific User
	 *
	 * @var array
	 */
 	public function user()
 	{
			return $this->belongsTo('App\User');
 	}

	/**
	 * One To One Relationship
	 * A Game has one Time
	 *
	 * @var array
	 */
	public function time()
  {
      return $this->hasOne('App\Time');
  }

	/**
 	 * Many To Many Relationship
 	 * A Game can have many players
 	 *
 	 * @var array
 	 */
	public function players()
	{
	 		return $this->belongsToMany('App\Player')->withPivot('position', 'status');
	}

	public function getPlayerListAttribute()
	{
			return $this->players->lists('id');
	}

	/**
	 * Many To Many Relationship
	 * A Player can have many Statuses
	 *
	 * @var array
	 */
	public function roles()
	{
			return $this->belongsToMany('App\Role')->withPivot('position');
	}

	public function getRoleListAttribute()
	{
			return $this->roles->lists('id');
	}

	/**
	 * Many To Many Relationship
	 * A Player can have many Statuses
	 *
	 * @var array
	 */
	public function teams()
	{
			return $this->belongsToMany('App\Team')->withPivot('position');
	}

	public function getTeamListAttribute()
	{
			return $this->teams->lists('id');
	}

}
