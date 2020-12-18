<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Story;
use Faker\Generator as Faker;

$factory->define(Story::class, function (Faker $faker) {
    $type = $faker->randomElement(['long', 'short']);
    if ($type == 'long') {
        $body = $faker->paragraph();
    } else {
        $body = $faker->text(200);
    }
    return [
        //
        'user_id' => $faker->numberBetween(1, 2),
        'title' => $faker->unique()->lexify('??????????'), //?=10 ie 10 letters
        'body' => $body,
        'type' => $type,
        'status' => $faker->boolean()
    ];
});
