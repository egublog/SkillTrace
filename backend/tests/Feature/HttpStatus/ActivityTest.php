<?php

namespace Tests\Feature\HttpStatus;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;


class ActivityTest extends TestCase
{
    /**
     * Activity@__invoke
     *
     * @return void
     */

    function testActivity()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('activities'))
            ->assertOk();
    }
}
