<?php

namespace Tests\Feature\HttpStatus;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

/**
 * @see \App\Http\Controllers\FollowingController
 */

class FollowingTest extends TestCase
{
    /**
     * Following@index
     *
     * @test
     */

    function testFollowingIndex()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('following.index', ['userId' => $user->id]))
            ->assertOk();
    }

    function testFollowingFollow()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $this->actingAs($user1)
            ->post('users/' . $user2->id . '/follow')
            ->assertOk();
    }

    function testFollowingUnfollow()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $this->actingAs($user1)
            ->post('users/' . $user2->id . '/unfollow')
            ->assertOk();
    }
}
