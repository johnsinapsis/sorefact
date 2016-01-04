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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'login' => $faker->userName,
        'password' => bcrypt('123456'),
        'remember_token' => str_random(10),
        'role' => $faker->randomElement(['facturador','cartera'])

    ];
});

$factory->define(App\Resolucion::class, function (Faker\Generator $faker) {
    return [
        'num_resol' => $faker->numerify('00000####'),
        'fec_resol' => $faker->date(),
        'ini_consec' => 2001,
        'fin_consec' => 3000,
        'nota_resol' => $faker->text(),
        'act_consec' => $faker->numberBetween(2001,3000),
        'stock_consec' => 50

    ];
});

$factory->define(App\MotivoAnu::class, function (Faker\Generator $faker) {
    return [
        'nommotivo' => $faker->name

    ];
});

$factory->define(App\Funcion::class, function (Faker\Generator $faker) {
    return [
        'nomfuncion' => $faker->name

    ];
});

$factory->define(App\RoleFuncion::class, function (Faker\Generator $faker) {
    return [
        'role' => $faker->randomElement(['superadmin'])
    ];
});


