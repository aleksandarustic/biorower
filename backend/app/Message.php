<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'messages';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['accepted', 'id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

    public function receiver()
    {
        return $this->belongsTo('App\User', "reveiver_user_id", "id");
    }

    public function sender()
    {
        return $this->belongsTo('App\User', "sender_user_id", "id");
    }

}
