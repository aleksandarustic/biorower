<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Validator;
use Auth;
use App\Http\Middleware\LogLastUserActivity;
use DB;
use Carbon\Carbon;

use Hashids\Hashids;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';


	private $errors = array();

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
						   'id',
						   'email',
						   'password',
						   'auth_token',
						   'profile_id',
						   'first_name',
						   'last_name',
						   'display_name'
						   ];
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token', 'created_at', 'linkname'];

	/*
    public function language()
    {
    	return $this->hasOne('Language', 'id', 'dic_languages_id');
    }
    */	
    /*
	protected $defaults = array(
		   'name' => null,
		   'email' => null,
		   'password' => null,
		   'about_me' => null,
		   'first_name' => null,
		   'last_name' => null,
		   'dic_languages_id' => null,
		   'date_of_birth' => null,
		   'gender' => null,
		   'phone' => null,
		   'mobile' => null,
		   'line1' => null,
		   'line2' => null,
		   'city' => null,
		   'zip' => null,
		   'website' => null,
		   'dic_country_id' => null,
		   'dic_user_type_id' => null,
	);
	*/

	/*public function __construct(array $attributes = array())
	{
	    $this->rules = array(	
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users,email,'.Auth::id(),
			'display_name' => 'required',
	    );
	}*/

    public function errors()
    {
        return $this->errors;
    } 

    public function profile()
    {
        return $this->belongsTo('App\Profile', "profile_id", "id");
    }    

    public function usersettings()
    {
        return $this->belongsTo('App\UserSettings', "user_settings_id", "id");
    }    

    public function sessions()
    {
        return $this->hasMany('App\Session');
    }      

	public function sessionsCount()
	{
	  return $this->hasOne('App\Session')
	    ->selectRaw('user_id, count(*) as aggregate')
	    ->groupBy('user_id');
	}

	public function getSessionsCountAttribute()
	{
	  // if relation is not loaded already, let's do it first
	  if (!array_key_exists('sessionsCount', $this->relations))
	    $this->load('sessionsCount');

	  $related = $this->getRelation('sessionsCount');

	  // then return the count directly
	  return ($related) ? (int) $related->aggregate : 0;
	}

    public function messages()
    {
        return $this->hasMany('App\Message', 'receiver_user_id');
    }  	

	public function messagesCount()
	{
		return 	$this->hasOne('App\Message', 'receiver_user_id')
	              ->select(DB::raw('count(sender_user_id) as nummsg, sender_user_id'))
	              ->where('status', 1)
			      ->where('read', 0)
    			  ->groupBy('sender_user_id');
	}




	
	/*public function getMessagesCountAttribute()
	{
		return $this->messagesCount->count;
	}
	*/

	/*
	public function getIdEncryAttribute()
	{
		$hashids = new Hashids(GlobalFunctions::getEncKeyUserId());
		$encodedID = $hashids->encode($this->id);

		return 1;
	}
	*/	

}

