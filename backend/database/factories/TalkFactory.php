<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Talk;
use Faker\Generator as Faker;
use App\Models\User;

$factory->define(Talk::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'user_to_id' => factory(User::class),
        'talk_body' => $faker->sentence(),
        'yet' => false
    ];
});
