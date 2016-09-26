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
	protected $fillable = ['total', 'balance', 'status', 'user_id'];

	/**
	 * One To One Relationship
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
	 		return $this->belongsToMany('App\Player');
	}

	public function getPlayerListAttribute()
	{
			return $this->players->lists('id');
	}

	/**
	 * Many To Many Relationship
	 * A Game has many Expansions
	 *
	 * @var array
	 */
	public function expansions()
	{
			return $this->belongsToMany('App\Expansion');
	}

	public function getExpansionListAttribute()
	{
			return $this->expansions->lists('id');
	}

}
