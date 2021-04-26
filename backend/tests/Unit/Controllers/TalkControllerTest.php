<?php

namespace Tests\Unit\Controllers;

use App\Models\Talk;
use App\Models\User;
use Tests\TestCase;

class TalkControllerTest extends TestCase
{
    /**
     * 
     *
     * @test
     */
    public function testExample()
    {
        $user = factory(User::class)->create();
        $talk = factory(Talk::class)->create();

        $this->actingAs($user)
        ->get(route('talks.index'));
        
    }
}
