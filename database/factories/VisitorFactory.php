<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Visitor::class, function (Faker $faker) {
    return [
        'uid' => \Illuminate\Support\Str::random(40),
    ];
});
