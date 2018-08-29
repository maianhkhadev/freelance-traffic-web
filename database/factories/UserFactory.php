<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => 'Focus Asia Admin',
        'email' => 'focus.asia@admin.com',
        'password' => '$2a$04$8U.nbQkW34sbTOiUFbDszepIjrmdGHioQcziI.S0uXumRMwn5lGIm', // secret
        'remember_token' => str_random(10),
    ];
});
