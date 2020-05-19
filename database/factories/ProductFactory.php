<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'detail' => $faker->paragraph(),
        'price' => $faker->numberBetween(300,3000),
        'stock' => $faker->randomDigit(),
        'discount' => $faker->numberBetween(3,30),
    ];
});
