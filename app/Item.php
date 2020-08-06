<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
    	'codeno', 'name', 'photo', 'price', 'discount', 'description', 'subcategory_id', 'brand_id'
    ];

    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order')
                    ->withPivot('qty')
                    ->withTimestamps();
    }
}
