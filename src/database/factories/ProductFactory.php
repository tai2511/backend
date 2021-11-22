<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Ecommerce\Products;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Products::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'user' => 1,
        'sku' => $faker->text(15),
        'slug' => $faker->unique()->text(14),
        'description' => $faker->text,
        'price' => $faker->numberBetween(1, 500),
        'quantity' => $faker->numberBetween(1, 200),
    ];
});
