<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Station::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween(1,3),
        'name' => $faker->name,
        'location' => $faker->address,
        'update_time' => $faker->numberBetween(1,300),
        'isValid' => true,
        'app_key' => $faker->text(32)
    ];
});

$factory->define(App\Models\DiseaseModel::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->colorName,
        'user_id' => $faker->numberBetween(1,3)
    ];
});

$factory->define(App\Models\FollowDiseaseModel::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween(1,3),
        'disease_model_id' => $faker->numberBetween(1,3),
        'station_id' => $faker->numberBetween(1,3),
        'is_valid' => true
    ];
});

$factory->define(App\Models\Notification::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween(1,3),
        'disease_model_id' => $faker->numberBetween(1,3),
        'short_message' => $faker->randomLetter,
        'full_message' => $faker->randomLetter,
        'is_viewed' => false,
        'is_read' => false,
        'is_valid' => false
    ];
});
