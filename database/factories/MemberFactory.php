<?php

use Faker\Generator as Faker;

$factory->define(App\Member::class, function (Faker $faker) {
    $teams = App\Team::pluck('id')->toArray();

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'team_id' => $faker->randomElement($teams),
        'color' => $faker->hexcolor,
        'disabled' => false
    ];
});
