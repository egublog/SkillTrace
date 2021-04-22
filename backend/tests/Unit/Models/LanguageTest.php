<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class LanguageTest extends TestCase
{
    /**@test languageのリレーション*/
    function testLanguageLanguages()
    {
        $language = factory(Language::class)->make();

        $this->assertInstanceOf(Collection::class, $language->languages);
    }

    function testLanguageUsers()
    {
        $language = factory(Language::class)->make();

        $this->assertInstanceOf(Collection::class, $language->users);
    }

}
