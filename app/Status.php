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
	protected $fillable = ['name', 'notes', 'icon', 'colour', 'role_id'];

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
	 * One To One Relationship
	 * A Status belongs to one Role
	 *
	 * @var array
	 */
	public function role()
	{
			return $this->belongsTo('App\Role');
	}

}
