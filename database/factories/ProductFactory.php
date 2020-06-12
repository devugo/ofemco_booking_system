<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\Service;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $services = Service::all();
    
    return [
        'service_id' => $faker->randomElement($array = $services),
        'icon' => 'fa-users',
        'title' => $faker->word,
        'sub_title' => $faker->sentence,
        'features' => json_encode($faker->words($nb = $faker->randomDigitNot(0), $asText = false)),
        'slashed_cost' => $faker->randomNumber($nbDigits = 5, $strict = false),
        'actual_cost' => $faker->randomNumber($nbDigits = 5, $strict = false)
    ];
});
