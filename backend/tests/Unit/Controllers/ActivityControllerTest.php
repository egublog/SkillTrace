<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Follow;

class ActivityControllerTest extends TestCase
{
    /**@
     * followした人たちが表示されているか
     * 
     * @test
     * */
    function testActivity()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $user3 = factory(User::class)->create();

        factory(Follow::class)->create([
            'user_id' => $user2->id,
            'user_to_id' => $user1->id
        ]);

        factory(Follow::class)->create([
            'user_id' => $user3->id,
            'user_to_id' => $user1->id
        ]);

        $this->actingAs($user1)
            ->get(route('activities'))
            ->assertSee($user2->name)
            ->assertSee($user2->age)
            ->assertSee($user2->area->area)
            ->assertSee($user2->history->history)
            ->assertSee($user2->language->language)
            ->assertSee($user3->name)
            ->assertSee($user3->age)
            ->assertSee($user3->area->area)
            ->assertSee($user3->history->history)
            ->assertSee($user3->language->language);
        }
}
