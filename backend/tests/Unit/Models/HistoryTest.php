<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\History;
use Illuminate\Database\Eloquent\Collection;

class HistoryTest extends TestCase
{
    /**@test historyのリレーション*/
    function testHistoryUsers()
    {
        $history = factory(History::class)->create();

        $this->assertInstanceOf(Collection::class, $history->users);
    }
}
