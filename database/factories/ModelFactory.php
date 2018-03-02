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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'user_group' => rand(0,1)
    ];
});

$factory->define(App\Post::class,function (Faker\Generator $faker)
{
	return [
		"title"=> $faker->sentence(rand(10,15),true),
		"slug"=> $faker->slug,
		"excerpt"=> $faker->paragraph(rand(10,12),true),
		"content"=> $faker->paragraph(rand(20,30),true)
	];
});
$factory->define(\App\Category::class,function (Faker\Generator $faker){
    return [
        "name"=>$faker->word(rand(4,8)),
        "slug"=>$faker->slug,
    ];
});
 