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
            \App\UseCase\SearchSearchCaseInterface::class,
            \App\UseCase\Profile\SearchSearchCase::class
        );

        $this->app->bind(
            \App\UseCase\SkillAbilityCreateCaseInterface::class,
            \App\UseCase\Profile\SkillAbilityCreateCase::class
        );

        $this->app->bind(
            \App\UseCase\SkillAbilityStoreCaseInterface::class,
            \App\UseCase\Profile\SkillAbilityStoreCase::class
        );

        $this->app->bind(
            \App\UseCase\SkillAbilityShowCaseInterface::class,
            \App\UseCase\Profile\SkillAbilityShowCase::class
        );

        $this->app->bind(
            \App\UseCase\SkillAbilityUpdateCaseInterface::class,
            \App\UseCase\Profile\SkillAbilityUpdateCase::class
        );

        $this->app->bind(
            \App\UseCase\SkillAbilityDestroyCaseInterface::class,
            \App\UseCase\Profile\SkillAbilityDestroyCase::class
        );

        $this->app->bind(
            \App\UseCase\SkillShowCaseInterface::class,
            \App\UseCase\Skill\SkillShowCase::class
        );

        $this->app->bind(
            \App\UseCase\SkillCreateCaseInterface::class,
            \App\UseCase\Skill\SkillCreateCase::class
        );

        $this->app->bind(
            \App\UseCase\SkillStoreCaseInterface::class,
            \App\UseCase\Skill\SkillStoreCase::class
        );

        $this->app->bind(
            \App\UseCase\SkillDeleteCaseInterface::class,
            \App\UseCase\Skill\SkillDeleteCase::class
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
