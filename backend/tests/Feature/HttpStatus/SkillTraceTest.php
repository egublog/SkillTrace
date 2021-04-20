<?php

namespace Tests\Feature\HttpStatus;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\UserLanguage;
use App\Models\Trace;

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

        $this->actingAs($user)->get(route('skill_traces.create', ['userLanguageId' => $userLanguage->id]))->assertOk();
    }

    function testSkillTraceStore() 
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)->post(route('skill_traces.store', ['userLanguageId' => $userLanguage->id]))->assertStatus(302);
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

        $this->actingAs($user)->get(route('skill_traces.show', ['userLanguageId' => $userLanguage->id, 'traceId' => $trace->id]))->assertOk();
    }

    function testSkillTraceUpdate() 
    {
        $user = factory(User::class)->create();
        $userLanguage = factory(UserLanguage::class)->create([
            'user_id' => $user->id
        ]);
        $trace = factory(Trace::class)->create([
            'user_language_id' => $userLanguage->id
        ]);

        $this->actingAs($user)->put(route('skill_traces.update', ['userLanguageId' => $userLanguage->id, 'traceId' => $trace->id]))->assertStatus(302);
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

        $this->actingAs($user)->delete(route('skill_traces.destroy', ['userLanguageId' => $userLanguage->id, 'traceId' => $trace->id]))->assertStatus(302);
    }
}
