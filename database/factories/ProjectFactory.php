<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'name' => "project_" . $faker->word,
        'status' => $faker->boolean ? Project::STATUS_ACTIVE : Project::STATUS_DISABLED
    ];
});
