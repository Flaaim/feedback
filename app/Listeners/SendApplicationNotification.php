<?php

namespace App\Listeners;

use App\Events\ApplicationCreate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Notifications\ApplicationCreateNotification;

class SendApplicationNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ApplicationCreate  $event
     * @return void
     */
    public function handle(ApplicationCreate $event)
    {
        $users = User::whereHas('role', function($query){
            $query->where('title', 'Manager');
        })->get();
        foreach($users as $user){
            $user->notify(new ApplicationCreateNotification($event->application));
        }
        
    }
}
