<?php

namespace App\Providers;

use App\Events;
use App\Listeners;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Events\BuyCreated::class => [
            Listeners\SendBuyCommand::class,
        ],
    ];
}
