<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subcategory;
use Faker\Generator as Faker;

// for subcategories table 
$factory->define(Subcategory::class, function (Faker $faker) {
		return [
    	'name' => $faker->colorName,
    	'category_id' => App\Category::all(['id'])->random()
    ];
});
