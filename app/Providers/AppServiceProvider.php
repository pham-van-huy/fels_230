<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\User\UserInterface',
            'App\Repositories\User\UserRepository'
        );
        $this->app->bind(
            'App\Repositories\SocialAccount\SocialAccountInterface',
            'App\Repositories\SocialAccount\SocialAccountRepository'
        );
    }
}
