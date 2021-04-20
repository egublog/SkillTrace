<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Talk;
use Faker\Generator as Faker;

$factory->define(Talk::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'user_to_id' => 2,
        'talk_body' => $faker->sentence(),
        'yet' => false
    ];
});
