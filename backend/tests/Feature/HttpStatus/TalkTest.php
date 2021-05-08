<?php

namespace Tests\Feature\HttpStatus;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Talk;

/**
 * @see \App\Http\Controllers\TalkController
 */

class TalkTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @test
     */

    function testTalkIndex()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('talks.index'))
            ->assertOk();
    }

    function testTalkSearch()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('talks.search', ['talk_search_name' => 'aaa']))
            ->assertOk();
    }

    function testTalkShow()
    {
        $users = factory(User::class, 2)->create();

        factory(Talk::class)->create([
            'user_id' => $users[1]->id,
            'user_to_id' => $users[0]->id
        ]);

        $this->actingAs($users[0])
            ->get(route('talks.show', ['theFriendId' => $users[1]->id]))
            ->assertOk();
    }

    function testTalkStore()
    {
        $users = factory(User::class, 2)->create();

        $talk = factory(Talk::class)->create([
            'user_id' => $users[1]->id,
            'user_to_id' => $users[0]->id
        ]);

        $this->actingAs($users[0])
            ->post(route('talks.store', ['theFriendId' => $users[1]->id]), ['message' => $talk->talk_body])
            ->assertRedirect(route('talks.show', ['theFriendId' => $users[1]->id]));
    }
}
