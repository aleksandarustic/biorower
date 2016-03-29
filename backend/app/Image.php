<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {

	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'images';

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

    public function profile()
    {
        return $this->hasOne('App\Profile', 'image_id', 'id');
    }

}

