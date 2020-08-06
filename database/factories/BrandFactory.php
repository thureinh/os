<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Brand;
use Faker\Generator as Faker;

// for brands table 
$factory->define(Brand::class, function (Faker $faker) {
  
    return [
    	'name' => $faker->company,
    	'photo' => 'backend_template/brand_img/'.$faker->image('public/backend_template/brand_img', 200, 150, 'fashion', null, false)
    ];
});