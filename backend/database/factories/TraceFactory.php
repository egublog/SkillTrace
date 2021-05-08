<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Trace;
use App\Models\UserLanguage;
use Faker\Generator as Faker;

$factory->define(Trace::class, function (Faker $faker) {
    return [
        'user_language_id' => factory(UserLanguage::class),
        'category_id' => $faker->numberBetween(1, 9),
        'content' => $faker->sentence()
    ];
});
