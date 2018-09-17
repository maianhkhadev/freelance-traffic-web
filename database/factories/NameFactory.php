<?php

use Faker\Generator as Faker;

$factory->define(App\Name::class, function (Faker $faker) {
    return [
        'value' => $faker->name,
        'table_name' => 'Task'
    ];
});
