<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\User;

class SearchControllerTest extends TestCase
{
    /**
     * nameで検索
     *
     * @test
     */
    function testSearchName()
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

        $this->actingAs($user1)
            ->get(route('searches.search', ['name' => '田']))
            ->assertSeeText($user2->name)
            ->assertSeeText($user3->name)
            ->assertDontSeeText($user4->name);

        $this->actingAs($user1)
            ->get(route('searches.search', ['name' => '田中']))
            ->assertSeeText($user2->name)
            ->assertDontSeeText($user3->name)
            ->assertDontSeeText($user4->name);

        $this->actingAs($user1)
            ->get(route('searches.search', ['name' => 'あ']))
            ->assertDontSeeText($user2->name)
            ->assertDontSeeText($user3->name)
            ->assertDontSeeText($user4->name);
    }

    /**
     * ageで検索
     *
     * @test
     */

    function testSearchAge()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create([
            'age' => 20
        ]);

        $this->actingAs($user1)
            ->get(route('searches.search', ['age' => 20]))
            ->assertSeeText($user2->age);
    }
    /**
     * areaで検索
     *
     * @test
     */

    function testSearchArea()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create([
            'area_id' => 1
        ]);

        $this->actingAs($user1)
            ->get(route('searches.search', ['area_id' => 1]))
            ->assertSeeText($user2->area->area);
    }
    /**
     * historyで検索
     *
     * @test
     */

    function testSearchHistory()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create([
            'history_id' => 1
        ]);

        $this->actingAs($user1)
            ->get(route('searches.search', ['history_id' => 1]))
            ->assertSeeText($user2->history->history);
    }
    /**
     * languageで検索
     *
     * @test
     */

    function testSearchLanguage()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create([
            'language_id' => 1
        ]);

        $this->actingAs($user1)
            ->get(route('searches.search', ['language_id' => 1]))
            ->assertSeeText($user2->language->language);
    }

    /**
     * ageのvalidationが機能している
     *
     * @test
     */

     function testAgeValidation()
     {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('searches.search', ['age' => 151]))
            ->assertSessionHasErrors(['age' => '年齢は0~150の間で入力してください。']);
     }
}
