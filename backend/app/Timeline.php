<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Http\Controllers\CommentController;
use Auth;
use Cookie;
use App\Http\Controllers\TimezoneController;

class Timeline extends Model {

	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'timeline';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['status', 'images', 'likes', 'user_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	//protected $dates = ['time'];

	protected $appends	= array('time_ago', 'scnt', 'total_time', 'dist', 'session_name', 'date_zone');

	public function getTimeAgoAttribute()
	{
        $datetime = Carbon::createFromTimeStamp($this->attributes['utc'])->toDateTimeString();
        return Carbon::parse($datetime)->diffForHumans();
    }

    public function getDateZoneAttribute()
    {
        $timezone = TimezoneController::index();

        return Carbon::createFromTimeStamp($this->attributes['utc'], $timezone)->toDateTimeString();
    }

    public function getScntAttribute() 
    {
    	return round($this->attributes['stroke_count'], config('parameters.scnt.format') );
    }

    public function getTotalTimeAttribute()
    {
    	return gmdate(config('parameters.time.format'), $this->attributes['totaltime']).' '.config('parameters.time.unit');
    }

    public function getDistAttribute()
    {
    	return round($this->attributes['distance'], config('parameters.dist.format') ).' '.config('parameters.dist.unit');
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

    public function userTimeline()
    {
        return $this->belongsTo('App\User', "user_id", "id");
    }

    /*public function user_get()
    {
        return $this->belongsTo('App\User', "user_get", "id");
    }    */

}
