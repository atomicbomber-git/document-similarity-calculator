<?php

use Faker\Generator as Faker;

$factory->define(App\Skripsi::class, function (Faker $faker) {
    return [
        'title' => ucwords($faker->sentence(10, TRUE)),
        'abstract' => $faker->realText(500),
        'chapter_1' => $faker->realText(1000),
        'chapter_2' => $faker->realText(1000)
    ];
});
