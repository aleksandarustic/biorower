<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Auth;
use App\Notification;
use App\Http\Controllers\NotificationsController;

class HeaderComposer {

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
        // Load all notifications in header dropdown menu
        $notifications      = NotificationsController::index();
        // The number of new notifications in the dropdown menu
        $number             = Notification::where(['status' => 1, 'isRead' => 0, 'user_get' => Auth::user()->id ])->get()->count();

        $view->with('numnewnotifications', $number);
        $view->with('listnotifications', $notifications);

    }

}