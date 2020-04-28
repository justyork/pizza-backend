<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\ProductInterface::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'text' => $faker->text,
        'price' => $faker->numberBetween(200, 1000)
    ];
});
