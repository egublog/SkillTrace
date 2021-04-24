<?php

namespace Tests\Unit\Controllers;

use App\Models\Ability;
use App\Models\Trace;
use App\Models\User;
use App\Models\UserLanguage;
use Tests\TestCase;

class SkillControllerTest extends TestCase
{
    /**
     * 何もなければありませんと表示されるか
     *
     * @test
     */
    public function testExample()
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->get(route('skills.show', ['userId' => $user->id, 'skillId' => $userLanguage->language_id]))
            ->assertSee($userLanguage->language->name)
            ->assertSee('⭐️')
            ->assertSee('できることがありません')
            ->assertSee('軌跡がありません');
    }

    /**
     * できることが追加されたら表示されるか
     * 
     * @test
     */

    function testAbilityContent()
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);

        $ability = factory(Ability::class)->create([
            'user_language_id' => $userLanguage->id
        ]);

        $this->actingAs($user)
            ->get(route('skills.show', ['userId' => $user->id, 'skillId' => $userLanguage->language_id]))
            ->assertSee($ability->content);
    }

    /**
     * 軌跡が追加されたら表示されるか
     * 
     * @test
     */

    function testTraceContent()
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);

        $trace = factory(Trace::class)->create([
            'user_language_id' => $userLanguage->id
        ]);

        $this->actingAs($user)
            ->get(route('skills.show', ['userId' => $user->id, 'skillId' => $userLanguage->language_id]))
            ->assertSee($trace->category->name)
            ->assertSee($trace->content);
    }

     /**
     * 自分の画面でだけ編集や削除ができるか
     * 
     * @test
    */

    function testEditOrDeleteInMyPage()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $userLanguage1 = factory(UserLanguage::class)->create([
            'user_id' => $user1->id
        ]);
        $userLanguage2 = factory(UserLanguage::class)->create([
            'user_id' => $user2->id
        ]);

        $ability1 = factory(Ability::class)->create([
            'user_language_id' => $userLanguage1->id
        ]);
        $ability2 = factory(Ability::class)->create([
            'user_language_id' => $userLanguage2->id
        ]);

        $trace1 = factory(Trace::class)->create([
            'user_language_id' => $userLanguage1->id
        ]);
        $trace2 = factory(Trace::class)->create([
            'user_language_id' => $userLanguage2->id
        ]);

        //自分の画面
        $this->actingAs($user1)
            ->get(route('skills.show', ['userId' => $user1->id, 'skillId' => $userLanguage1->language_id]))
            ->assertSee('class="edit"')
            ->assertSee('class="delete"')
            ->assertSee('このスキルを削除する')
            ->assertSee($ability1->content)
            ->assertSee($trace1->content);

        //他人の画面
        $this->actingAs($user1)
            ->get(route('skills.show', ['userId' => $user2->id, 'skillId' => $userLanguage2->language_id]))
            ->assertDontSee('class="edit"')
            ->assertDontSee('class="delete"')
            ->assertDontSee('このスキルを削除する')
            ->assertSee($ability2->content)
            ->assertSee($trace2->content);
    }
}
