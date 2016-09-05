<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {

    
	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'setting';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name','dateStart','rangeType','user_id','parametar1','parametar2','parametar3','groupType'];

    
    public function grafik()
    {
        return $this->belongsTo('App\User');
    }
        
        

}
