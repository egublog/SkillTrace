<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Area;
use Illuminate\Database\Eloquent\Collection;

class AreaTest extends TestCase
{
    /**@test areaのリレーション*/
    function testAreaUsers()
    {
        $area = factory(Area::class)->make();

        $this->assertInstanceOf(Collection::class, $area->users);
    }
}
