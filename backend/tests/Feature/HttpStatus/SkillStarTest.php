<?php

namespace Tests\Feature\HttpStatus;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\UserLanguage;

class SkillStarTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    function testSkillStarCreate()
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->get(route('skill_stars.create', ['userLanguageId' => $userLanguage->id]))
            ->assertOk();
    }

    function testSkillStarUpdate()
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->put(route('skill_stars.update', ['userLanguageId' => $userLanguage->id]), ['star_count' => random_int(1, 5)])
            ->assertRedirect(route('skills.show', ['userId' => $user->id, 'skillId' => $userLanguage->language_id]));
    }
}
