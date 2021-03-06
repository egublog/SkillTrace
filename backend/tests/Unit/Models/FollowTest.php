<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Follow;
use App\Models\User;

class FollowTest extends TestCase
{
    /**
     * followのリレーション
     *
     * @test
     */
    function testFollowUserFollower()
    {
        $follow = factory(Follow::class)->make();

        $this->assertInstanceOf(User::class, $follow->user_follower);
    }

    function testFollowUserFollowing()
    {
        $follow = factory(Follow::class)->make();

        $this->assertInstanceOf(User::class, $follow->user_following);
    }
}
