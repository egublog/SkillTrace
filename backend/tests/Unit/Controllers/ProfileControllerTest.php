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
}
