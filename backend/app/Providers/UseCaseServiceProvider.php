<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UseCaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\UseCase\FollowerIndexCaseInterface::class,
            \App\UseCase\FollowerIndexCase::class
        );

        $this->app->bind(
            \App\UseCase\FollowingIndexCaseInterface::class,
            \App\UseCase\FollowingIndexCase::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
