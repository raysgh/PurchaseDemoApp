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
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'supplier_id' => \App\Supplier::get()->random()->id,
        'description' => $faker->sentence,
        'is_ordered' => $faker->boolean($chanceOfGettingTrue = 20),
    ];
});

$factory->define(App\OrderLine::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence,
        'quantity' => $faker->randomDigitNotNull,
        'price' => $faker->randomNumber($nbDigits = 6, $strict = false),
    ];
});

$factory->define(App\Supplier::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->streetAddress,
        'postcode' => $faker->postcode,
        'city' => $faker->city,
        'country' => $faker->country,
    ];
});
