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

    /**
     * follow,unfollowしたら、DataBaseに保存、削除される
     *
     * @test
     */
    function testFollowingDatabase()
    {
        $users = factory(User::class, 2)->create();

        $this->actingAs($users[0])
            ->post('users/' . $users[1]->id . '/follow');

        $this->assertDatabaseHas('follows', [
            'user_id' => $users[0]->id,
            'user_to_id' => $users[1]->id
        ]);

        $this->actingAs($users[0])
            ->post('users/' . $users[1]->id . '/unfollow');

        $this->assertDatabaseMissing('follows', [
            'user_id' => $users[0]->id,
            'user_to_id' => $users[1]->id
        ]);
    }
}
