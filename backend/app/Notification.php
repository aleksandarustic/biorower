<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;
use App\Http\Controllers\TimezoneController;


class Notification extends Model {

	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'notifications';

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

	protected $appends	= array('time_ago', 'date_format');

	public function getTimeAgoAttribute()
	{
		$datetime = Carbon::createFromTimeStamp($this->attributes['utc'])->toDateTimeString();
        return Carbon::parse($datetime)->diffForHumans();
    }

    public function getDateFormatAttribute()
    {
    	$timezone = TimezoneController::index();

    	return Carbon::createFromTimeStamp($this->attributes['utc'], $timezone)->toDateTimeString();
    }

    public function user_action()
    {
        return $this->belongsTo('App\User', "user_action", "id");
    }

    public function user_get()
    {
        return $this->belongsTo('App\User', "user_get", "id");
    }    

}
