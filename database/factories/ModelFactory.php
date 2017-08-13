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
        'class' => $faker->word,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Plan::class, function (Faker\Generator $faker) {
    $grades = ['K','1st','2nd','3rd','4th','5th','6th','7th','8th','9th','10th','11th','12th'];
    return [
        'title' => $faker->sentence,
        'grade' => $grades[array_rand($grades)],
        'date_from' => $faker->date(),
        'date_to' => $faker->date(),
    ];
});

$factory->define(App\Standard::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->sentence
    ];
});

$factory->define(App\Expectation::class, function (Faker\Generator $faker) {
    return [
        'standard_id' => factory('App\Standard')->create()->id,
        'description' => $faker->sentence
    ];
});

$factory->define(App\EssentialQuestion::class, function (Faker\Generator $faker) {
    return [
        'description' => 'Essential Question'
    ];
});
