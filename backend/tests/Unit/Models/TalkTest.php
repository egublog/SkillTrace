<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Talk;
use App\Models\User;

class TalkTest extends TestCase
{
    /**@test talkのリレーション*/
    function testTalkUserFollower()
    {
        $talk = factory(Talk::class)->create();

        $this->assertInstanceOf(User::class, $talk->user_follower);
    }

    function testTalkUserFollowing()
    {
        $talk = factory(Talk::class)->create();

        $this->assertInstanceOf(User::class, $talk->user_following);
    }
}
