<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transaction;
use Faker\Generator as Faker;

// $factory->define(Transaction::class, function (Faker $faker) {
//     return [
//         'client_id' => factory(\App\Client::class),
//         'amount'    => $faker->randomFloat(2, 3)
//     ];
// });

$factory->define(Transaction::class, function(Faker $faker){
    return [
        'client_id' => function(){
            return factory(\App\Client::class)->create()->id;
        },
        'amount'    => $faker->randomFloat(2, 3)
    ];
});