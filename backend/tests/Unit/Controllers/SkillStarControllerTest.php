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

    /**
     * star_countのvalidationが機能する
     *
     * @test
     */

     function testStarCountValidation()
     {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->put(route('skill_stars.update', ['userLanguageId' => $userLanguage->id]), ['star_count' => ''])
            ->assertSessionHasErrors(['star_count' => '自己評価を選択してください。']);
     }
}
