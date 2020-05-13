<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Client;
use Illuminate\Support\Str;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'token' => Str::random(20),
        'available_requests_number' => rand(1, 200)
    ];
});
