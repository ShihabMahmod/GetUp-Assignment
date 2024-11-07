<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\auth\RegisterService;
use App\Models\User;
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(RegisterService::class, function ($app) {
            return new RegisterService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
    }
}
