<?php

namespace Tests\Feature\HttpStatus;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\UserLanguage;
use App\Models\Ability;

/**
 * @see \App\Http\Controllers\SkillAbilityController
 */

class SkillAbilityTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    function testSkillAbilityCreate()
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->get(route('skill_abilities.create', ['userLanguageId' => $userLanguage->id]))
            ->assertOk();
    }

    function testSkillAbilityStore()
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->post(route('skill_abilities.create', ['userLanguageId' => $userLanguage->id]), ['ability' => 'aaaaa'])
            ->assertRedirect(route('skills.show', ['userId' => $user->id, 'skillId' => $userLanguage->language_id]));
    }

    function testSkillAbilityShow()
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);
        $ability = factory(Ability::class)->create([
            'user_language_id' => $userLanguage->id
        ]);

        $this->actingAs($user)
            ->get(route('skill_abilities.show', ['userLanguageId' => $userLanguage->id, 'abilityId' => $ability->id]))
            ->assertOk();
    }

    function testSkillAbilityUpdate()
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);
        $ability = factory(Ability::class)->create([
            'user_language_id' => $userLanguage->id
        ]);

        $this->actingAs($user)
            ->put(route('skill_abilities.update', ['userLanguageId' => $userLanguage->id, 'abilityId' => $ability->id]), ['ability' => $ability->content . 'abc'])
            ->assertRedirect(route('skills.show', ['userId' => $user->id, 'skillId' => $userLanguage->language_id]));
    }

    function testSkillAbilityDestroy()
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);
        $ability = factory(Ability::class)->create([
            'user_language_id' => $userLanguage->id
        ]);

        $this->actingAs($user)
            ->delete(route('skill_abilities.destroy', ['userLanguageId' => $userLanguage->id, 'abilityId' => $ability->id]))
            ->assertRedirect(route('skills.show', ['userId' => $user->id, 'skillId' => $userLanguage->language_id]));
    }
}
