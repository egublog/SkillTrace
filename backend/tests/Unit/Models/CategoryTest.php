<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryTest extends TestCase
{
    /**@test categoryのリレーション*/
    function testCategoryTraces()
    {
        $category = factory(Category::class)->create();

        $this->assertInstanceOf(Collection::class, $category->traces);
    }
}
