<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Area;
use App\Models\History;
use App\Models\Language;
use App\Models\UserLanguage;
use Illuminate\Database\Eloquent\Collection;

class UserTest extends TestCase
{
    /**@test userのリレーション*/
    function testUserArea()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Area::class, $user->area);
    }

    function testUserHistory()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(History::class, $user->history);
    }

    function testUserLanguage()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Language::class, $user->language);
    }

    function testUserLanguages()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Collection::class, $user->languages);
    }

    function testUserUserLanguages()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Collection::class, $user->userLanguages);
    }

    function testUserFollow()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Collection::class, $user->follow);
    }

    function testUserFollowTo()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Collection::class, $user->follow_to);
    }

    function testUserTalk()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Collection::class, $user->talk);
    }

    function testUserTalkTo()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Collection::class, $user->talk_to);
    }
    function testUserFollows()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Collection::class, $user->follows);
    }
    function testUserFollowsTo()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Collection::class, $user->follow_to);
    }
}
