<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    
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
}
