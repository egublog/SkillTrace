<?php

namespace Tests\Unit\Controllers;

use App\Models\User;
use App\Models\UserLanguage;
use Tests\TestCase;

class SkillStarControllerTest extends TestCase
{
    /**
     * starがDBに反映されている
     *
     * @test
     */
    function testStarDatabase()
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->put(route('skill_stars.update', ['userLanguageId' => $userLanguage->id]), ['star_count' => 3]);

        $this->assertDatabaseHas('user_languages', [
            'star_count' => 3
        ]);
    }
}
