<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Log;
use Faker\Generator as Faker;

$factory->define(Log::class, function (Faker $faker) {

    $created_at = $faker->dateTimeBetween('-7 days');

    $projects = \App\Project::active()->get('id')->toArray();
    $projects = array_map(null, ...$projects);

    $users = App\User::active()->get('id')->toArray();
    $users = array_map(null, ...$users);

    return [
        'project_id' => $faker->randomElements($projects[0])[0],
        'text' => $faker->text(rand(20,40)),
        'link' => $faker->url,
        'user_id' => $faker->randomElements($users[0])[0],
        'time' => rand(1,8),
        'date' => date('Y-m-d', $created_at->getTimestamp())
    ];
});
