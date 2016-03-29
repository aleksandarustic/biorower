<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'dic_countries';

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
        return $this->belongsTo('User', 'id', 'dic_country_id');
    }

}
