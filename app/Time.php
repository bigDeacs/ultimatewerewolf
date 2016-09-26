<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'times';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 * status = day/night
	 * round = count/+1 at full cycle
	 */
	protected $fillable = ['round', 'status', 'game_id'];

	/**
	 * One To One Relationship
	 * A Time belongs to one Game
	 *
	 * @var array
	 */
	public function game()
	{
			return $this->belongsTo('App\Game');
	}

}
