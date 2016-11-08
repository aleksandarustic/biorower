<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;
use App\Http\Controllers\TimezoneController;

class Comment extends Model {

	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comments';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['text','user_id','session_id', 'status'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	protected $appends	= array('time_ago', 'date_format');

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function session()
    {
        return $this->belongsTo('App\Session');
    }

    public function getDateFormatAttribute()
    {
    	$timezone = TimezoneController::index();

     	return Carbon::createFromTimeStamp($this->attributes['utc'], $timezone)->toDateTimeString();
    }

    public function getTimeAgoAttribute()
	{
		$datetime = Carbon::createFromTimeStamp($this->attributes['utc'])->toDateTimeString();
        return Carbon::parse($datetime)->diffForHumans();
    }



}
