<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Boat::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => implode(' ', $faker->sentences()),
    ];
});

$factory->state(\App\Models\Boat::class, 'invalid', [
    'name' => 1,
    'description' => 2,
]);
