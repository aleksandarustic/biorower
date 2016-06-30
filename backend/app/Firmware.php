<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Firmware extends Model {

	/**
	 * The primary key for the model.
	 *
	 * @var string
	 */
	protected $primaryKey = 'device_type_id';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'firmwares';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['device_type_id'];

}
