<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserLanguage;
use Faker\Generator as Faker;

$factory->define(UserLanguage::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'language_id' => $faker->numberBetween(1, 35),
        'star_count' => $faker->numberBetween(1, 5)
    ];
});
