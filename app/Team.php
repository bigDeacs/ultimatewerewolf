<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'teams';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'icon', 'notes', 'colour'];

	/**
	 * One To Many Relationship
	 * A Team can have Players
	 *
	 * @var array
	 */
	public function players()
 	{
 	 		return $this->belongsToMany('App\Player')->withPivot('game_id');
 	}

	public function getPlayerListAttribute()
	{
			return $this->players->lists('id');
	}

    public function roles()
    {
        return $this->hasMany('App\Role');
    }

	/**
	 * Many To Many Relationship
	 * A Player can have many Statuses
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

}
