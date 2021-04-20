<?php

namespace Tests\Feature\HttpStatus;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;


class ProfileTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    function testProfileIndex()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('profiles.index'))->assertOk();
    }

    function testProfileStore()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->post(route('profiles.store'))->assertStatus(302);
    }

    function testProfileImgStore()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->post(route('profiles.img_store'))->assertStatus(302);
    }

}
