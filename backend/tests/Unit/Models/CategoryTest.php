<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryTest extends TestCase
{
    /**
     * categoryのリレーション
     *
     * @test
     */
    function testCategoryTraces()
    {
        $category = factory(Category::class)->make();

        $this->assertInstanceOf(Collection::class, $category->traces);
    }
}
