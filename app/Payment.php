<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'name', 'user',
    ];
  
    public function orders()
    {
      return $this->belongsToMany('App\Order');
    }
}
