<?php
$factory->define(App\Dog::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'dog_name' => $faker->name,
        'owner_name' => $faker->unique()->safeEmail,
        'owner_id' => mt_rand(1,10),
        'created_at' => date('Y-m-d H:i:s',strtotime('-'.rand(1,30).' day'))
    ];
});