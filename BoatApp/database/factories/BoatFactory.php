<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\User;
use Faker\Generator as Faker;

// PRE: At least one user in the database
$factory->define(\App\Models\Boat::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => implode(' ', $faker->sentences()),
        'user_id' => User::all()->random(),
    ];
});

$factory->state(\App\Models\Boat::class, 'invalid', [
    'name' => 1,
    'description' => 2,
]);
