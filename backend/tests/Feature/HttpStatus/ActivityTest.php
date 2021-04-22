<?php

namespace Tests\Feature\HttpStatus;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;


/**p
 * @see \App\Http\Controllers\ActivityController
 */

class ActivityTest extends TestCase
{
    function testActivity()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('activities'))
            ->assertOk();
    }
}
