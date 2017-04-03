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
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

// Begin InvoiceDetail Factory
$factory->define(App\InvoiceDetail::class, function (Faker\Generator $faker) {
    return [
        'invoicenum_detail' => $faker->unique()->word,
				'trackingno' => '1Z2F' . $faker->numberBetween($min = 12346861503423, $max = 12346861506000),
				'detailamount' => $faker->randomFloat(2)
    ];
});
// End InvoiceDetail Factory

// Begin InvoiceHeader Factory
$factory->define(App\InvoiceHeader::class, function (Faker\Generator $faker) {
    return [
        'invoicenum_header' => $faker->unique()->word,
				'invoicedate' => $faker->date(),
				'invoiceamount'=> $faker->randomFloat(2)
    ];
});

// End InvoiceHeader Factory