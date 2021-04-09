<?php

namespace Tests\Feature\HttpStatus;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class HomeTest extends TestCase
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


    public function testHome()
    {
        $response = $this->get('/home');

        $response->assertStatus(302);
    }

    function testMyHome()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('home.home', ['userId' => $user->id]))->assertOk();
    }

}
