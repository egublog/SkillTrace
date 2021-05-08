<?php

namespace Tests\Feature\HttpStatus;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

/**
 * @see \App\Http\Controllers\SearchController
 */

class SearchTest extends TestCase
{
    /**
     * SearchController@index,search
     *
     * @test
     */

    function testSearchIndex()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('searches.index'))
            ->assertOk();
    }

    function testSearchSearch()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('searches.search'))
            ->assertOk();
    }
}
