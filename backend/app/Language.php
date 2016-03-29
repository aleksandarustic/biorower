<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'dic_languages';

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
        return $this->belongsTo('User', 'id', 'dic_languages_id');
    }

}
