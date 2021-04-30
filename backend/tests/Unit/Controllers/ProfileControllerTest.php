<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProfileControllerTest extends TestCase
{
    /**
     * profileのstore処理がDBに反映される
     *
     * @test
     */

    function testProfileDatabase()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->post(route('profiles.store'), ['name' => '山田花子', 'age' => 22, 'area_id' => 2, 'history_id' => 2, 'language_id' => 2]);

        $this->assertDatabaseHas('users', [
            'name' => '山田花子',
            'age' => 22,
            'area_id' => 2,
            'history_id' => 2,
            'language_id' => 2
        ]);
    }

    /**
     * nameのvalidationが機能している
     *
     * @test
     */

     function testNameValidation()
     {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->post(route('profiles.store'), ['name' => '', 'age' => 22, 'area_id' => 2, 'history_id' => 2, 'language_id' => 2])
            ->assertSessionHasErrors(['name' => '名前は必ず入力してください。']);
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
            ->post(route('profiles.store'), ['name' => '田中', 'age' => '', 'area_id' => 2, 'history_id' => 2, 'language_id' => 2])
            ->assertSessionHasErrors(['age' => '年齢は必ず入力してください。']);

        $this->actingAs($user)
            ->post(route('profiles.store'), ['name' => '田中', 'age' => 151, 'area_id' => 2, 'history_id' => 2, 'language_id' => 2])
            ->assertSessionHasErrors(['age' => '年齢は0~150の間で入力してください。']);
     }
    /**
     * validationが機能している
     *
     * @test
     */

     function testAreaValidation()
     {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->post(route('profiles.store'), ['name' => '田中', 'age' => 18, 'area_id' => '', 'history_id' => 2, 'language_id' => 2])
            ->assertSessionHasErrors(['area_id' => '住んでいる地域は必ず入力してください。']);
     }
    /**
     * validationが機能している
     *
     * @test
     */

     function testHistoryValidation()
     {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->post(route('profiles.store'), ['name' => '田中', 'age' => 22, 'area_id' => 2, 'history_id' => '', 'language_id' => 2])
            ->assertSessionHasErrors(['history_id' => 'エンジニア歴は必ず入力してください。']);
     }
    /**
     * validationが機能している
     *
     * @test
     */

     function testLanguageValidation()
     {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->post(route('profiles.store'), ['name' => '田中', 'age' => 22, 'area_id' => 2, 'history_id' => 2, 'language_id' => ''])
            ->assertSessionHasErrors(['language_id' => '得意言語は必ず入力してください。']);
     }
}
