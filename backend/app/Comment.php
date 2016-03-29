<?php namespace App;

use Illuminate\Database\Eloquent\Model;

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
	protected $fillable = ['text'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];
	
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function session()
    {
        return $this->belongsTo('App\Session');
    }


}
