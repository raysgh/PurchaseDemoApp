<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    protected $appends = ['totalPrice'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    public function orderLines()
    {
        return $this->hasMany('App\OrderLine');
    }

    public function getTotalPriceAttribute()
    {
        return $this->orderLines()->get()->sum(function ($product) {
            return $product['price'] * $product['quantity'] / 100;
        });
    }
}
