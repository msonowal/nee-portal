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

$factory->define(nee_portal\Models\Admin::class, function ($faker) {
   return [
       'username' => 'admin',
       'fullname' => $faker->name,
       'mobile_no' => $faker->unique()->PhoneNumber,
       'email' => $faker->unique()->email,
       'password' =>bcrypt('secret@nee#2016'),
       'remember_token'=>str_random(10),
       'reset_key'=>str_random(10),

   ];
});
