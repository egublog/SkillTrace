<?php

namespace Tests\Feature\HttpStatus;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;


class FollowersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    function testFollowers()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('followers.index', ['userId' => $user->id]))->assertOk();
    }

}