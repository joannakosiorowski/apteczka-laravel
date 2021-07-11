<?php
namespace App\Apteczka\ViewComposers;
use Illuminate\View\View;
use App\{Notification};
use Illuminate\Support\Facades\Auth;


class BackendComposer
{
   public function compose(View $view)
    {
        $view->with('notifications', Notification::where('user_id', 1)->where('status',0)->get());
    }
}