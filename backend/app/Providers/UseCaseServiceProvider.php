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
            \App\UseCase\Follower\FollowerIndexCase::class
        );

        $this->app->bind(
            \App\UseCase\FollowingIndexCaseInterface::class,
            \App\UseCase\Following\FollowingIndexCase::class
        );

        $this->app->bind(
            \App\UseCase\HomeIndexCaseInterface::class,
            \App\UseCase\Home\HomeIndexCase::class
        );

        $this->app->bind(
            \App\UseCase\HomeHomeCaseInterface::class,
            \App\UseCase\Home\HomeHomeCase::class
        );

        $this->app->bind(
            \App\UseCase\ProfileIndexCaseInterface::class,
            \App\UseCase\Profile\ProfileIndexCase::class
        );

        $this->app->bind(
            \App\UseCase\ProfileStoreCaseInterface::class,
            \App\UseCase\Profile\ProfileStoreCase::class
        );

        $this->app->bind(
            \App\UseCase\ProfileImgStoreCaseInterface::class,
            \App\UseCase\Profile\ProfileImgStoreCase::class
        );

        $this->app->bind(
            \App\UseCase\SearchIndexCaseInterface::class,
            \App\UseCase\Profile\SearchIndexCase::class
        );

        $this->app->bind(
            \App\UseCase\SearchSearchInterface::class,
            \App\UseCase\Profile\SearchSearchCase::class
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
