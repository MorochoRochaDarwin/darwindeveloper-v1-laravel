<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'type' => 'normal',
        'verify_token' => null,
        'facebook_id' => null,
        'github_id' => null,
        'google_id' => null,
        'twitter_id' => null,
    ];
});


$factory->define(App\Tutorial::class, function (Faker\Generator $faker) {

    return [
        'titulo' => $faker->address,
        'descripcion' => $faker->text,
        'html' => $faker->text,
        'palabras_clave' => $faker->address,
        'sub_id' => 4,
    ];


});

