<?php

namespace Tests\Unit\Controllers;

use App\Models\Trace;
use App\Models\User;
use App\Models\UserLanguage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SkillTraceControllerTest extends TestCase
{
    /**
     * Store処理がDBに反映される
     *
     * @test
     */
    function testStore()
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);
        $trace = factory(Trace::class)->create([
            'user_language_id' => $userLanguage->id
        ]);

        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');

        $this->actingAs($user)
            ->post(route('skill_traces.store', ['userLanguageId' => $userLanguage->id]), ['trace_img' => $file, 'trace' => $trace->content, 'category' => $trace->category_id]);

        $this->assertDatabaseHas('traces', [
            'category_id' => $trace->category_id,
            'content' => $trace->content
        ]);
    }

    /**
     * update処理がDBに反映される
     *
     * @test
     */

    function testUpdate()
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);
        $trace = factory(Trace::class)->create([
            'user_language_id' => $userLanguage->id,
            'content' => 'abcdef',
            'category_id' => 1
        ]);

        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');

        $this->actingAs($user)
            ->put(route('skill_traces.update', ['userLanguageId' => $userLanguage->id, 'traceId' => $trace->id]), ['trace_img' => $file, 'trace' => $trace->content, 'category_id' => $trace->category_id]);

        $this->assertDatabaseHas('traces', [
            'category_id' => $trace->category_id,
            'content' => $trace->content
        ]);
    }

    /**
     * Destroy処理がDBに反映される
     *
     * @test
     */

    function testDestroy()
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);
        $trace = factory(Trace::class)->create([
            'user_language_id' => $userLanguage->id
        ]);

        $this->actingAs($user)
            ->delete(route('skill_traces.destroy', ['userLanguageId' => $userLanguage->id, 'traceId' => $trace->id]));

        $this->assertDatabaseMissing('traces', [
            'id' => $trace->id
        ]);
    }

    /**
     * categoryのvalidationが機能する
     *
     * @test
     */

     function testCategoryValidation()
     {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);
        $trace = factory(Trace::class)->create([
            'user_language_id' => $userLanguage->id
        ]);

        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');

        $this->actingAs($user)
            ->post(route('skill_traces.store', ['userLanguageId' => $userLanguage->id]), ['trace_img' => $file, 'trace' => $trace->content, 'category' => ''])
            ->assertSessionHasErrors(['category' => 'カテゴリーを選択してください。']);
     }

    /**
     * categoryのvalidationが機能する
     *
     * @test
     */

     function testTraceValidation()
     {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);
        $trace = factory(Trace::class)->create([
            'user_language_id' => $userLanguage->id
        ]);

        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');

        $this->actingAs($user)
            ->post(route('skill_traces.store', ['userLanguageId' => $userLanguage->id]), ['trace_img' => $file, 'trace' => '', 'category' => $trace->category_id])
            ->assertSessionHasErrors(['trace' => '軌跡は必ず入力してください。']);
     }
}
