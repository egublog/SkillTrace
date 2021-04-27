<?php

namespace Tests\Unit\Controllers;

use App\Models\Ability;
use App\Models\User;
use App\Models\UserLanguage;
use Tests\TestCase;

class SkillAbilityControllerTest extends TestCase
{
    /**
     * Store処理がDBに反映される
     *
     * @test
     */
    function testStore()
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->post(route('skill_abilities.create', ['userLanguageId' => $userLanguage->id]), ['ability' => 'aaaaa']);

        $this->assertDatabaseHas('abilities', [
            'content' => 'aaaaa'
        ]);
    }

    /**
     * update処理がDBに反映される
     *
     * @test
     */

    function testUpdate()
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);
        $ability = factory(Ability::class)->create([
            'user_language_id' => $userLanguage->id
        ]);

        $this->actingAs($user)
            ->put(route('skill_abilities.update', ['userLanguageId' => $userLanguage->id, 'abilityId' => $ability->id]), ['ability' => $ability->content . 'abc']);

        $this->assertDatabaseHas('abilities', [
            'content' => $ability->content . 'abc'
        ]);
    }

    /**
     * Destroy処理がDBに反映される
     *
     * @test
     */

    function testDestroy()
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);
        $ability = factory(Ability::class)->create([
            'user_language_id' => $userLanguage->id
        ]);

        $this->actingAs($user)
            ->delete(route('skill_abilities.destroy', ['userLanguageId' => $userLanguage->id, 'abilityId' => $ability->id]));

        $this->assertDatabaseMissing('abilities', [
            'content' => $ability->content
        ]);
    }
}
