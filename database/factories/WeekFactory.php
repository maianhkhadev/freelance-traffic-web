<?php

use Faker\Generator as Faker;

$factory->define(App\Week::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->date($format = 'd-m-Y'),
        'date_range' => $faker->unique()->date($format = 'd-m-Y'),
        'closed' => false
    ];
});
