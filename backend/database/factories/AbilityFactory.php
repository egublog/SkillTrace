<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Ability;
use App\Models\UserLanguage;
use Faker\Generator as Faker;

$factory->define(Ability::class, function (Faker $faker) {
    return [
        'user_language_id' => factory(UserLanguage::class),
        'content' => $faker->sentence()
    ];
});
