<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Ability;
use App\Models\UserLanguage;

class AbilityTest extends TestCase
{
    /**
     * abilityのリレーション
     *
     * @test
     */
    function testAbilityUserLanguage()
    {
        $ability = factory(Ability::class)->make();

        $this->assertInstanceOf(UserLanguage::class, $ability->userLanguage);
    }
}
