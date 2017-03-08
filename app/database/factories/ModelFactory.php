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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Enrollment::class, function (Faker\Generator $faker) {

    return [
        'course_id' => $faker->numberBetween($min = 1, $max = 2),
        'user_id' => $faker->unique()->numberBetween($min = 1, $max = 10),
    ];
});

$factory->define(App\Schedule::class, function (Faker\Generator $faker) {

    $userIds = App\User::pluck('id')->all();
    $freetime = '';
    for($i = 0; $i < 168; $i++){
      $freetime = $freetime.$faker->numberBetween($min = 0, $max = 1);
    }
    return [
        'freetime' => $freetime,
        'user_id' => $faker->unique()->randomElement($userIds),
    ];
});



?>
