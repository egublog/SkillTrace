<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Talk;
use App\Models\User;

class TalkTest extends TestCase
{
    /**
     * talkのリレーション
     *
     * @test
     */
    function testTalkUserFollower()
    {
        $talk = factory(Talk::class)->make();

        $this->assertInstanceOf(User::class, $talk->user_follower);
    }

    function testTalkUserFollowing()
    {
        $talk = factory(Talk::class)->make();

        $this->assertInstanceOf(User::class, $talk->user_following);
    }
}
