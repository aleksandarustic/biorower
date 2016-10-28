<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Carbon\Carbon;

class Profile extends Model {

	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'profiles';

	private $errors = array();

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
							'id',
							'about_me',
							'phone',
							'mobile',
							'line1',
							'line2',
							'city',
							'zip',
							'website',
							'date_of_birth',
							'gender',
							'dic_languages_id',
							'dic_country_id',
							'dic_user_type_id',
							'privacy',
							'notify_me_on_comment',
							'notify_me_on_new_session',
							'notify_me_on_new_watcher',
							'send_session_summary',
							'email_summary_alternative',
							'send_session_summary_alternate',
							];


	private $rules;



	public function __construct(array $attributes = array())
	{
	    $this->rules = array(
			'phone' => 'max:45',
			'mobile' => 'max:45',
			'line1' => 'max:45',
			'line2' => 'max:45',
			'city' => 'max:70',
			'zip' => 'max:45',
			'website' => 'max:100',
	    );
	}


    public function validateModel($data)
    {
        // make a new validator object
        $v = Validator::make($data, $this->rules);

        // check for failure
        if ($v->fails())
        {
            // set errors and return false
            $this->errors = $v->errors();
            return false;
        }

        // validation pass
        return true;
    }							

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	protected $appends	= array('month_birthday', 'day_birthday', 'year_birthday');

	public function getMonthBirthdayAttribute()
	{	
		if($this->attributes['date_of_birth']){
        	return Carbon::createFromFormat('Y-m-d', $this->attributes['date_of_birth'])->format('m');
   		}
    }

    public function getDayBirthdayAttribute()
    {
    	if($this->attributes['date_of_birth']){
        	return Carbon::createFromFormat('Y-m-d', $this->attributes['date_of_birth'])->format('d');
    	}
    }

    public function getYearBirthdayAttribute()
    {
    	if($this->attributes['date_of_birth']){
			return Carbon::createFromFormat('Y-m-d', $this->attributes['date_of_birth'])->format('Y');
    	}
    }    

    public function errors()
    {
        return $this->errors;
    } 

    public function user()
    {
        return $this->hasOne('App\User', 'profile_id', 'id');
    }

    public function image()
    {
        return $this->belongsTo('App\Image');
    }        
    
}
