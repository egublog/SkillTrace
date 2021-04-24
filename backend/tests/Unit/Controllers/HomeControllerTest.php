<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserLanguage;

class HomeControllerTest extends TestCase
{
    /**
     * homeで自分の情報が表示される
     * 
     * @test 
    */

    function testHome()
    {
        $user = factory(User::class)->create();

        $language = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->get(route('home.home', ['userId' => $user->id]))
            ->assertSee($user->name)
            ->assertSee($user->age)
            ->assertSee($user->area->area)
            ->assertSee($user->history->history)
            ->assertSee($user->language->language)
            ->assertSee('プロフィールの編集')
            ->assertDontSee('トークする')
            ->assertSee('class="skill-add"')
            ->assertSee($language->language->name);
    }
}
