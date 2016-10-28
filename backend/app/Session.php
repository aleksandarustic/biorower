<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

	protected $appends	= array('session_name');

    public function comments()
    {
        return $this->hasMany('App\Comment', 'session_id', 'id');
    }    

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function sessionSummary()
    {
        return $this->belongsTo('App\DataBiorowerSession', "data_biorower_sessions_id", "id");
    }    

	public function getSessionNameAttribute()
    {
    	if($this->attributes['name'] == ''){
    		$date = Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['date'])->format('D, d.M Y');
    		$name = "Session: ".$date;
    		return $name;
    	}else{
    		return $this->attributes['name'];
    	}
    }

}
