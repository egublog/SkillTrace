<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\History;
use Illuminate\Database\Eloquent\Collection;

class HistoryTest extends TestCase
{
    /**
     * historyのリレーション
     *
     * @test
     */
    function testHistoryUsers()
    {
        $history = factory(History::class)->make();

        $this->assertInstanceOf(Collection::class, $history->users);
    }
}
