<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;
use App\Http\Controllers\TimezoneController;


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
	protected $fillable = ['data', 'date'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	//protected $dates = ['date'];

	protected $appends	= array('session_name', 'date_zone');

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
    	$timezone = TimezoneController::index();

    	if($this->attributes['name'] == ''){
    		$datetime = Carbon::createFromTimeStamp($this->attributes['utc'], $timezone)->toDateTimeString();
    		$date = Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->format('D, d.M Y');
    		$name = "Session: ".$date;
    		return $name;
    	}else{
    		return $this->attributes['name'];
    	}
    }

    public function getDateZoneAttribute()
    {
    	$timezone = TimezoneController::index();

        return Carbon::createFromTimeStamp($this->attributes['utc'], $timezone)->toDateTimeString();
    }
}
