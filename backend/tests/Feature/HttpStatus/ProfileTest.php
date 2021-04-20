<?php

namespace Tests\Feature\HttpStatus;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class ProfileTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    function testProfileIndex()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('profiles.index'))->assertOk();
    }

    function testProfileStore()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->post(route('profiles.store'), ['name' => '山田花子', 'age' => 22, 'area_id' => 2, 'history_id' => 2, 'language_id' => 2])->assertRedirect('users/' . $user->id);
    }

    function testProfileImgStore()
    {
        $user = factory(User::class)->create();
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');

        $this->actingAs($user)->post(route('profiles.img_store'), ['profile_img' =>$file])->assertRedirect('profiles');
    }

}
