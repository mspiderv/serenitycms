<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Serenity\Admin::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->userName,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Serenity\Region::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->country,
    ];
});

$factory->define(Serenity\District::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->city,
    ];
});
