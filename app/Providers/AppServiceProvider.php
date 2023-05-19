<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        //check that app is local
        // $this->app->register('Barryvdh\Debugbar\ServiceProvider');
        // $this->app['request']->server->set('HTTPS', true);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // \Illuminate\Support\Facades\URL::forceScheme("https");
        // if(env('APP_ENV') === 'production') {
        // }
    }
}
