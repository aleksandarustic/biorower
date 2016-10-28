<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model {

	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'friends';

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

    public function user_2()
    {
        return $this->belongsTo('App\User', "user2", "id");
    }

    public function user_1()
    {
        return $this->belongsTo('App\User', "user1", "id");
    }    

}
