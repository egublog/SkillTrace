<?php

namespace Tests\Feature\HttpStatus;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\UserLanguage;
use App\Models\Trace;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * @see \App\Http\Controllers\SkillTraceController
 */

class SkillTraceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    function testSkillTraceCreate() 
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
        ->get(route('skill_traces.create', ['userLanguageId' => $userLanguage->id]))
        ->assertOk();
    }

    function testSkillTraceStore() 
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
        ->post(route('skill_traces.store', ['userLanguageId' => $userLanguage->id]), ['trace_img' => $file, 'trace' => $trace->content, 'category' => $trace->category_id])
        ->assertRedirect(route('skills.show', ['userId' => $user->id, 'skillId' => $userLanguage->language_id]));
    }

    function testSkillTraceShow() 
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);
        $trace = factory(Trace::class)->create([
            'user_language_id' => $userLanguage->id
        ]);

        $this->actingAs($user)
        ->get(route('skill_traces.show', ['userLanguageId' => $userLanguage->id, 'traceId' => $trace->id]))
        ->assertOk();
    }

    function testSkillTraceUpdate() 
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
        ->put(route('skill_traces.update', ['userLanguageId' => $userLanguage->id, 'traceId' => $trace->id]), ['trace_img' => $file, 'trace' => $trace->content, 'category_id' => $trace->category_id])
        ->assertRedirect(route('skills.show', ['userId' => $user->id, 'skillId' => $userLanguage->language_id]));
    }

    function testSkillTraceDestroy() 
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);
        $trace = factory(Trace::class)->create([
            'user_language_id' => $userLanguage->id
        ]);

        $this->actingAs($user)
        ->delete(route('skill_traces.destroy', ['userLanguageId' => $userLanguage->id, 'traceId' => $trace->id]))
        ->assertRedirect(route('skills.show', ['userId' => $user->id, 'skillId' => $userLanguage->language_id]));
    }
}
