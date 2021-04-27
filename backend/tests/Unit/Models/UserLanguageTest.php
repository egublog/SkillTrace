<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserLanguage;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class UserLanguageTest extends TestCase
{
    /**
     * userLanguageのリレーション
     *
     * @test
     */
    
    function testUserLanguageUser()
    {
        $userLanguage = factory(UserLanguage::class)->make();

        $this->assertInstanceOf(User::class, $userLanguage->user);
    }

    function testUserLanguageLanguage()
    {
        $userLanguage = factory(UserLanguage::class)->make();

        $this->assertInstanceOf(Language::class, $userLanguage->language);
    }

    function testUserLanguageAbility()
    {
        $userLanguage = factory(UserLanguage::class)->make();

        $this->assertInstanceOf(Collection::class, $userLanguage->ability);
    }

    function testUserLanguageTrace()
    {
        $userLanguage = factory(UserLanguage::class)->make();

        $this->assertInstanceOf(Collection::class, $userLanguage->trace);
    }
}
