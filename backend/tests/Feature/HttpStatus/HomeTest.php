<?php

namespace Tests\Feature\HttpStatus;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

/**
 * @see \App\Http\Controllers\HomeController
 */

class HomeTest extends TestCase
{
    /**
     * HomeController
     *
     * @return void
     */

    public function testHome()
    {
        $response = $this->get('/home');

        $response->assertStatus(302);
    }

    function testHomeHome()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->get(route('home.home', ['userId' => $user->id]))
            ->assertOk();
    }
}
