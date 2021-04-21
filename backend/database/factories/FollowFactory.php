<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Follow;
use App\Models\User;

$factory->define(follow::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(User::class)->create();
        },
        'user_to_id' => function() {
            return factory(User::class)->create();
        }
    ];
});
