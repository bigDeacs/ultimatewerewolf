<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

	use \Rutorika\Sortable\SortableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 * description will have expanded text.
	 * image will be modal
	 * impact = the number on the card
	 * order = nullable, if null, show as if day time. default to null
	 * night = which night they wake: 1, 2, 3, etc, -99, 0
	 * admin panel, make this a live drag drop.
	 */
	protected $fillable = ['name', 'description', 'image', 'impact', 'position', 'night', 'max', 'expansion_id'];

	/**
	 * One To Many Relationship
	 * A Role can belong to many Players
	 *
	 * @var array
	 */
 	public function players()
  {
      return $this->hasMany('App\Player');
  }

	/**
	 * Many To Many Relationship
	 * A Player can have many Statuses
	 *
	 * @var array
	 */
	public function recipes()
	{
			return $this->belongsToMany('App\Recipe');
	}

	public function getRecipeListAttribute()
	{
			return $this->recipes->lists('id');
	}

	/**
	 * One To Many Relationship
	 * A Role belongs to a specific Expansion
	 *
	 * @var array
	 */
	public function expansion()
	{
		 return $this->belongsTo('App\Expansion');
 	}

	/**
	 * One To One Relationship
	 * A Game has one Time
	 *
	 * @var array
	 */
	public function status()
  {
      return $this->hasOne('App\Status');
  }

}
