<?php

namespace Tests\Feature\HttpStatus;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Language;


class SkillTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // function testSkill()
    // {
    //     $user = factory(User::class)->create();

    //     $this->actingAs($user)->get(route('skills.show', ['userId' => $user->id, 'skillId' => 3]))->assertOk();
    // }
}
