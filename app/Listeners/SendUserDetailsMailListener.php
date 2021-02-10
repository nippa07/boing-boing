<?php

namespace App\Listeners;

use App\Events\SendUserDetailsMailEvent;
use App\Mail\SendUserDetailsMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendUserDetailsMailListener
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
     * @param  SendUserDetailsMailEvent  $event
     * @return void
     */
    public function handle(SendUserDetailsMailEvent $event)
    {
        $data['user'] = $event->user;
        $data['password'] = $event->password;
        Mail::to($data['user']->email)->send(new SendUserDetailsMail($data));
    }
}
