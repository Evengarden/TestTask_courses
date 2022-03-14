<?php

namespace App\Providers;

use App\Events\AddUserOnCourse;
use App\Listeners\ValidateAdditionListener;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
       AddUserOnCourse::class => [
           ValidateAdditionListener::class
       ]
    ];

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
