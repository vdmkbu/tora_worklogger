<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Position;
use Faker\Generator as Faker;

$factory->define(Position::class, function (Faker $faker) {

    $active = $faker->boolean;

    return [
        'name' => "position_" . $faker->word,
        'status' => $active ? Position::STATUS_ACTIVE : Position::STATUS_DISABLED
    ];
});
