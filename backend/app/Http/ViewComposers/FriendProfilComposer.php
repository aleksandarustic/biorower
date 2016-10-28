<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Auth;
use App\Notification;
use App\Http\Controllers\TimelineController;

class FriendProfilComposer {

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $viewdata= $view->getData();

        $posts      = TimelineController::index($viewdata['user']['id']);
        $view->with('posts', $posts);
        //$view->with('brojkomentara', $broj);

    }

}