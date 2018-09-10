<?php

use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    $members = App\Member::pluck('id')->toArray();
    $projects = App\Project::pluck('id')->toArray();
    $weeks = App\Week::pluck('id')->toArray();

    return [
        'name' => $faker->unique()->name,
        'value' => $faker->numberBetween($min = 5, $max = 50),
        'note' => $faker->text(100),
        'member_id' => $faker->randomElement($members),
        'week_id' => $faker->randomElement($weeks),
        'project_id' => $faker->randomElement($projects),
        'deleted' => false
    ];
});
