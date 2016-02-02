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
        'name' => $faker->unique->userName,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Serenity\ContentType::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique->word,
    ];
});

$factory->define(Serenity\ContentTypeRelation::class, function (Faker\Generator $faker) {
    return [
        'left_variable' => $faker->unique->word,
        'right_variable' => $faker->unique->word,
        'relation_type' => $faker->numberBetween(1, 3),
    ];
});

$factory->define(Serenity\ContentTypeVariable::class, function (Faker\Generator $faker) {
    return [
        'variable' => $faker->unique->word,
    ];
});

$factory->define(Serenity\Content::class, function (Faker\Generator $faker) {
    return [
    ];
});

$factory->define(Serenity\Page::class, function (Faker\Generator $faker) {
    return [
        'slug' => $faker->unique->slug,
    ];
});

$factory->define(Serenity\Panel::class, function (Faker\Generator $faker) {
    return [
        'code' => $faker->unique->word,
    ];
});



// TODO: delete
$factory->define(Serenity\Region::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->country,
    ];
});

// TODO: delete
$factory->define(Serenity\District::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->city,
    ];
});
