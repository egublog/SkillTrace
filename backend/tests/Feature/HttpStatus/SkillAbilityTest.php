<?php

namespace Tests\Feature\HttpStatus;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\UserLanguage;
use App\Models\Ability;

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

        $this->actingAs($user)->get(route('skill_abilities.create', ['userLanguageId' => $userLanguage->id]))->assertOk();
    }

    function testSkillAbilityStore()
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)->post(route('skill_abilities.create', ['userLanguageId' => $userLanguage->id]))->assertStatus(302);
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

        $this->actingAs($user)->get(route('skill_abilities.show', ['userLanguageId' => $userLanguage->id, 'abilityId' => $ability->id]))->assertOk();
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

        $this->actingAs($user)->put(route('skill_abilities.update', ['userLanguageId' => $userLanguage->id, 'abilityId' => $ability->id]), ['ability' => $ability->content . 'a'])->assertStatus(302);
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

        $this->actingAs($user)->delete(route('skill_abilities.destroy', ['userLanguageId' => $userLanguage->id, 'abilityId' => $ability->id]))->assertStatus(302);
    }
}
