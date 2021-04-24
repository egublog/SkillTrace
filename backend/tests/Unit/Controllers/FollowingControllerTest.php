<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Follow;

class FollowingControllerTest extends TestCase
{
    /**
     * 自分がfollowしている人が表示されるか
     * 
     * @test
     */

    function testFollowing()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $user3 = factory(User::class)->create();

        factory(Follow::class)->create([
            'user_id' => $user1->id,
            'user_to_id' => $user2->id
        ]);
        factory(Follow::class)->create([
            'user_id' => $user1->id,
            'user_to_id' => $user3->id
        ]);

        $this->actingAs($user1)
            ->get(route('following.index', ['userId' => $user1->id]))
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

    /**
     * 自分以外の人にだけfollowボタン表示されて、押すとfollowできる
     * 
     * @test
     */

    function testFollow()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();


        $this->actingAs($user1)
            ->get(route('home.home', ['userId' => $user1->id]))
            ->assertDontSee('</follow-button>');

        $this->actingAs($user1)
            ->get(route('home.home', ['userId' => $user2->id]))
            ->assertSee('</follow-button>');
    }

    // function test()
    // {
    //     $user1 = factory(User::class)->create();
    //     $user2 = factory(User::class)->create();

    //     $this->actingAs($user1)
    //         ->post('users/' . $user2->id . '/follow')
    //         ->assertDatabaseHas('follow', [
    //             'user_id' => $user1->id,
    //             'user_to_id' => $user2->id
    //         ]);
    // }
}