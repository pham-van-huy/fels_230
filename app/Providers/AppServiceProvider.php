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
use App\Repositories\Word\WordInterface;
use App\Repositories\Word\WordRepository;
use App\Repositories\Answer\AnswerRepository;
use App\Repositories\Answer\AnswerInterface;

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
        App::bind(WordInterface::class, WordRepository::class);
        App::bind(AnswerInterface::class, AnswerRepository::class);
    }
}
