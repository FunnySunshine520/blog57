<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(\App\Models\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->text,
        'published_at' => $faker->dateTime,
    ];
});
