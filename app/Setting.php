<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];

    protected $casts = [
      'value' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
