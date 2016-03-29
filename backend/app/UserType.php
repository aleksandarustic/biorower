<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'dic_user_types';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];


    public function user()
    {
        return $this->belongsTo('User', 'id', 'dic_user_type_id');
    }

}
