<?php

namespace Tests\Feature\HttpStatus;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Talk;


class TalkTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
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
        ->get(route('talks.search'))
        ->assertStatus(302);
    }

    function testTalkShow()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        factory(Talk::class)->create([
            'user_id' => $user2->id,
            'user_to_id' => $user1->id
        ]);

        $this->actingAs($user1)
        ->get(route('talks.show', ['theFriendId' => $user2->id]))
        ->assertOk();
    }

    function testTalkStore()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $talk = factory(Talk::class)->create([
            'user_id' => $user2->id,
            'user_to_id' => $user1->id
        ]);

        $this->actingAs($user1)
        ->post(route('talks.store', ['theFriendId' => $user2->id]), ['message' => $talk->talk_body])
        ->assertRedirect(route('talks.show', ['theFriendId' => $user2->id]));
    }
}
