<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Validator;
use Auth;

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

	/*
	   'id',
	   'about_me',
	   'first_name',
	   'last_name',
	   'dic_languages_id',
	   'date_of_birth',
	   'gender',
	   'phone',
	   'mobile',
	   'line1',
	   'line2',
	   'city',
	   'zip',
	   'website',
	   'dic_country_id',
	   'dic_user_type_id',
	   'authToken',
	   'created_at'
	*/	

	
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
     public function save()
     {

   	  $this->password = bcrypt('secret');
      // before save code 
      parent::save();
      // after save code
     };
    */

    private $rules;

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

	public function __construct(array $attributes = array())
	{
	    $this->rules = array(
	    	/*
	        'name' => 'required|min:4',
	        'email'  => 'email',
	        */
	        // .. more rules here ..

			/*'name' => 'required|alpha_num|max:255',*/
			
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users,email,'.Auth::id(),
			'display_name' => 'required',
			/*

			*/
	    );

	    /*
		foreach ($this->attributes as $name => $value) {
			if (empty($value)) {
				$this->attributes[$name] = null;
			}	
		}
		*/

		//$this->setRawAttributes($this->defaults, true);
		//parent::__construct($this->attributes);
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
	    return $this->hasOne('App\Message', 'receiver_user_id')
	              ->selectRaw('receiver_user_id, count(*) as count')
	              ->where('read', '=', 0)
    			  ->groupBy('receiver_user_id');
	  			  /*
    			  ->selectRaw('user_id, count(*) as count')
    			  ->groupBy('user_id');
    			  */
	}



	/*
	public function getMessagesCountAttribute()
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

