<?php

use Faker\Generator as Faker;

$factory->define(App\History::class, function (Faker $faker) {
    $tasks = App\Task::pluck('id')->toArray();

    return [
      'table_name' => $faker->name,
      'record_id' => $faker->randomElement($tasks),
      'action' => 'Create'
    ];
});
