<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\SocialAccount\SocialAccountInterface;
use App\Repositories\SocialAccount\SocialAccountRepository;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\Category\CategoryRepository;

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
        App::bind(UserInterface::class, UserRepository::class);
        App::bind(SocialAccountInterface::class, SocialAccountRepository::class);
        App::bind(CategoryInterface::class, CategoryRepository::class);
    }
}
