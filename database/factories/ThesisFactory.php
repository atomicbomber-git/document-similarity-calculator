<?php

use Faker\Generator as Faker;

$factory->define(App\Thesis::class, function (Faker $faker) {
    return [
        'title' => ucwords($faker->sentence),
        'abstract' => $faker->realText(500),
        'chapter_1' => $faker->realText(1000),
        'chapter_2' => $faker->realText(1000)
    ];
});
