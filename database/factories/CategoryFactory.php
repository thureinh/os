<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

// for categories table 
$factory->define(Category::class, function (Faker $faker) {
  
    return [
    	'name' => $faker->company,
    	'photo' => 'backend_template/category_img/'.$faker->image('public/backend_template/category_img', 200, 150, 'fashion', null, false)
    ];
});
