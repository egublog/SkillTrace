<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Trace;
use App\Models\Category;
use App\Models\UserLanguage;

class TraceTest extends TestCase
{
    /**@test traceのリレーション*/
    function testTraceCategory()
    {
        $trace = factory(Trace::class)->make();

        $this->assertInstanceOf(Category::class, $trace->category);
    }

    function testTraceUserLanguage()
    {
        $trace = factory(Trace::class)->make();

        $this->assertInstanceOf(UserLanguage::class, $trace->userLanguage);
    }
}
