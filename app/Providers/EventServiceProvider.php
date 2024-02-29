<?php

namespace App\Providers;

use App\Events\ForgotPasswordRequestedEvent;
use App\Events\UserRegisteredEvent;
use App\Listeners\SendForgotPasswordTokenListener;
use App\Listeners\SendWelcomeEmailListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
// use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        UserRegisteredEvent::class => [
            SendWelcomeEmailListener::class
        ],
        ForgotPasswordRequestedEvent::class => [
            SendForgotPasswordTokenListener::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
