<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->company,
        'color' => $faker->hexcolor,
        'closed' => false
    ];
});
