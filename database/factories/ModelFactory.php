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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->safeColorName,
    ];
});

$factory->define(App\Models\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->safeColorName,
        'category_id' => function () {
            return factory(\App\Models\Category::class)->create()->id;
        }
    ];
});
