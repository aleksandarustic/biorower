<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		    View::composer('components.header', 	'App\Http\ViewComposers\HeaderComposer');
		    View::composer('user.friend-profile', 	'App\Http\ViewComposers\FriendProfilComposer');
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
