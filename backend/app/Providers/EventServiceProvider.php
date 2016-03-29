<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
//use App\User;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		/*
	    User::saving(function($user)
	    {
	    	//return $user;
	    	
			foreach ($user as $name => $value) {
				if (empty($value)) {
					$user[$name] = null;
				}	
			}
			
	    });	
	    */	

		//
	}

}
