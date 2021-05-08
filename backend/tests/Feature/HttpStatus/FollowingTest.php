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
        $users = factory(User::class, 2)->create();

        $this->actingAs($users[0])
            ->post('users/' . $users[1]->id . '/follow')
            ->assertOk();
    }

    function testFollowingUnfollow()
    {
        $users = factory(User::class, 2)->create();

        $this->actingAs($users[0])
            ->post('users/' . $users[1]->id . '/unfollow')
            ->assertOk();
    }
}
