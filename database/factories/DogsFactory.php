<?php
$factory->define(App\Dog::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'dog_name' => $faker->name,
        'owner_name' => $faker->unique()->safeEmail,
        'owner_id' => mt_rand(1,10),
    ];
});