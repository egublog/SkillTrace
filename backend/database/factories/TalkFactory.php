<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Talk;
use Faker\Generator as Faker;
use App\Models\User;

$factory->define(Talk::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(User::class)->create();
        },
        'user_to_id' => function() {
            return factory(User::class)->create();
        },
        'talk_body' => $faker->sentence(),
        'yet' => false
    ];
});
