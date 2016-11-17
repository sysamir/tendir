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

/*
 * User's factory
*/
$factory->define(App\Models\User::class, function (Faker\Generator $faker)
{
    return [
        'full_name'      => $faker->name,
        'email'          => $faker->safeEmail,
        'password'       => 'secret',
        'phone'          => $faker->phoneNumber,
        'address'        => $faker->address,
        'remember_token' => str_random(10),
    ];
});


/*
 * Company's factory
 * */
$factory->define(App\Models\Company::class, function (Faker\Generator $faker)
{
    return [
        'name'            => $faker->company,
        'username'        => $faker->userName,
        'password'        => 'secret',
        'phone'           => $faker->phoneNumber,
        'email'           => $faker->safeEmail,
        'info'            => $faker->address,
        'user_full_name'  => $faker->name,
        'user_email'      => $faker->email,
        'user_profession' => $faker->word,
        'user_phone'      => $faker->phoneNumber,
    ];
});