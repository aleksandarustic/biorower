<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model {

	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sessions';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['data'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }    

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function sessionSummary()
    {
        return $this->belongsTo('App\DataBiorowerSession', "data_biorower_sessions_id", "id");
    }    

}
