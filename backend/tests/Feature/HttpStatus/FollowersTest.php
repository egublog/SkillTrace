<?php

namespace Tests\Feature\HttpStatus;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

/**
 * @see \App\Http\Controllers\FollowerController
 */

class FollowersTest extends TestCase
{
    /**
     * Followers@index
     *
     * @test
     */

    function testFollowers()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('followers.index', ['userId' => $user->id]))
            ->assertOk();
    }
}
