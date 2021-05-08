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
        $users = factory(User::class, 3)->create();

        factory(Follow::class)->create([
            'user_id' => $users[1]->id,
            'user_to_id' => $users[0]->id
        ]);

        factory(Follow::class)->create([
            'user_id' => $users[2]->id,
            'user_to_id' => $users[0]->id
        ]);

        $this->actingAs($users[0])
            ->get(route('activities'))
            ->assertSee($users[1]->name)
            ->assertSee($users[1]->age)
            ->assertSee($users[1]->area->area)
            ->assertSee($users[1]->history->history)
            ->assertSee($users[1]->language->language)
            ->assertSee($users[2]->name)
            ->assertSee($users[2]->age)
            ->assertSee($users[2]->area->area)
            ->assertSee($users[2]->history->history)
            ->assertSee($users[2]->language->language);
    }
}
