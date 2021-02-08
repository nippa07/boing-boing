<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\QuoteMailEvent' => [
            'App\Listeners\QuoteMailListener',
        ],
        'App\Events\QuoteStatusMailEvent' => [
            'App\Listeners\QuoteStatusMailListener',
        ],
        'App\Events\OrderMailEvent' => [
            'App\Listeners\OrderMailListener',
        ],
        'App\Events\SendUserDetailsMailEvent' => [
            'App\Listeners\SendUserDetailsMailListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
