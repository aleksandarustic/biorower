<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{

	public function run()
	{
	    DB::table('users')->delete();
	    User::create(array(
	        'name'     => 'Chris Sevilleja',
	        'email'    => 'bojanproba81@gmail.com',
	        'password' => Hash::make('bojan'),
	        'created_at' => time(),
	        'updated_at' => time()
	    ));
	}

}