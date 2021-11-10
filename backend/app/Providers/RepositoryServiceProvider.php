<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\AbilityRepositoryInterface::class,
            \App\Repositories\Eloquent\AbilityRepository::class,
        );
        $this->app->bind(
            \App\Repositories\AreaRepositoryInterface::class,
            \App\Repositories\Eloquent\AreaRepository::class,
        );
        $this->app->bind(
            \App\Repositories\CategoryRepositoryInterface::class,
            \App\Repositories\Eloquent\CategoryRepository::class,
        );
        $this->app->bind(
            \App\Repositories\FollowRepositoryInterface::class,
            \App\Repositories\Eloquent\FollowRepository::class,
        );
        $this->app->bind(
            \App\Repositories\HistoryRepositoryInterface::class,
            \App\Repositories\Eloquent\HistoryRepository::class,
        );
        $this->app->bind(
            \App\Repositories\LanguageRepositoryInterface::class,
            \App\Repositories\Eloquent\LanguageRepository::class,
        );
        $this->app->bind(
            \App\Repositories\TraceRepositoryInterface::class,
            \App\Repositories\Eloquent\TraceRepository::class,
        );
        $this->app->bind(
            \App\Repositories\UserLanguageRepositoryInterface::class,
            \App\Repositories\Eloquent\UserLanguageRepository::class,
        );
        $this->app->bind(
            \App\Repositories\UserRepositoryInterface::class,
            \App\Repositories\Eloquent\UserRepository::class,
        );
        $this->app->bind(
            \App\Repositories\TalkRepositoryInterface::class,
            \App\Repositories\Eloquent\TalkRepository::class,
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
