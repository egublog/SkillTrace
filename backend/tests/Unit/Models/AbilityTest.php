<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Ability;
use App\Models\UserLanguage;

class AbilityTest extends TestCase
{
    /**@test abilityのリレーション*/
    function testAbilityUserLanguage()
    {
        $ability = factory(Ability::class)->create();

        $this->assertInstanceOf(UserLanguage::class, $ability->userLanguage);
    }
}
