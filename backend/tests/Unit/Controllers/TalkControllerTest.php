<?php

namespace Tests\Unit\Controllers;

use App\Models\Talk;
use App\Models\User;
use Tests\TestCase;

class TalkControllerTest extends TestCase
{
    /**
     * talkしているUserが表示される
     *
     * @test
     */
    function testTalk()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $user3 = factory(User::class)->create();

        factory(Talk::class)->create([
            'user_id' => $user1->id,
            'user_to_id' => $user2->id
        ]);
        factory(Talk::class)->create([
            'user_id' => $user3->id,
            'user_to_id' => $user1->id
        ]);

        $this->actingAs($user1)
            ->get(route('talks.index'))
            ->assertSee($user2->name)
            ->assertSee($user2->age)
            ->assertSee($user2->area->area)
            ->assertSee($user2->history->history)
            ->assertSee($user2->language->language)
            ->assertSee($user3->name)
            ->assertSee($user3->age)
            ->assertSee($user3->area->area)
            ->assertSee($user3->history->history)
            ->assertSee($user3->language->language);
    }

    /**
     * search処理で指定したUserが表示される
     *
     * @test
     */

    function testTalkSearch()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create([
            'name' => '田中啓介'
        ]);
        $user3 = factory(User::class)->create([
            'name' => '田辺俊介'
        ]);
        $user4 = factory(User::class)->create([
            'name' => '渡辺海星'
        ]);

        factory(Talk::class)->create([
            'user_id' => $user1->id,
            'user_to_id' => $user2->id
        ]);
        factory(Talk::class)->create([
            'user_id' => $user3->id,
            'user_to_id' => $user1->id
        ]);
        factory(Talk::class)->create([
            'user_id' => $user4->id,
            'user_to_id' => $user1->id
        ]);


        $this->actingAs($user1)
            ->get(route('talks.search', ['talk_search_name' => '田']))
            ->assertSee($user2->name)
            ->assertSee($user3->name)
            ->assertDontSee($user4->name);

        $this->actingAs($user1)
            ->get(route('talks.search', ['talk_search_name' => '田中']))
            ->assertSee($user2->name)
            ->assertDontSee($user3->name)
            ->assertDontSee($user4->name);

        $this->actingAs($user1)
            ->get(route('talks.search', ['talk_search_name' => 'あ']))
            ->assertDontSee($user2->name)
            ->assertDontSee($user3->name)
            ->assertDontSee($user4->name);
    }

    /**
     * talk_showの左側の一覧が表示されるか
     *
     * @test
     */

    function testShow()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $user3 = factory(User::class)->create();

        $talk1 = factory(Talk::class)->create([
            'user_id' => $user1->id,
            'user_to_id' => $user2->id
        ]);
        $talk2 = factory(Talk::class)->create([
            'user_id' => $user3->id,
            'user_to_id' => $user1->id
        ]);

        $this->actingAs($user1)
            ->get(route('talks.show', ['theFriendId' => $user2->id]))
            ->assertSee($user2->name)
            ->assertSee($user3->name)
            ->assertSee($talk1->talk_body);

        $this->actingAs($user1)
            ->get(route('talks.show', ['theFriendId' => $user3->id]))
            ->assertSee($user2->name)
            ->assertSee($user3->name)
            ->assertSee($talk2->talk_body);
    }

    /**
     * talk内容がDBに反映される
     *
     * @test
     */

    function testTalkDatabase()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $this->actingAs($user1)
            ->post(route('talks.store', ['theFriendId' => $user2->id]), ['message' => 'おはよう']);

        $this->assertDatabaseHas('talks', [
            'user_id' => $user1->id,
            'user_to_id' => $user2->id,
            'talk_body' => 'おはよう'
        ]);
    }

    /**
     * talk_search_nameのvalidationが機能する
     *
     * @test
     */

     function testSearchValidation()
     {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('talks.search', ['talk_search_name' => '']))
            ->assertSessionHasErrors(['talk_search_name' => 'キーワードを入力してください。']);
     }

     /**
     * messageのvalidationが機能する
     *
     * @test
     */

     function testMessageValidation()
     {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $this->actingAs($user1)
            ->post(route('talks.store', ['theFriendId' => $user2->id]), ['message' => ''])
            ->assertSessionHasErrors(['message' => 'メッセージが入力されていません。']);
     }
}
