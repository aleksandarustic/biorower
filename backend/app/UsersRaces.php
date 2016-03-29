<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersRaces extends Model {

	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users_races';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }    

}
