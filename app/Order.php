<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    	'orderdate', 'voucherno', 'total', 'note', 'status', 'user_id'
    ];

    public function items()
    {
    	return $this->belongsToMany('App\Item')
									->withPivot('qty')
									->withTimestamps();
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
