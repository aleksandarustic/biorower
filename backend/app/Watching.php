<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Watching extends Model {

	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'watching';

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

    public function user2()
    {
        return $this->belongsTo('App\User', "user2_id", "id");
    }

    public function user1()
    {
        return $this->belongsTo('App\User', "user1_id", "id");
    }    

}
