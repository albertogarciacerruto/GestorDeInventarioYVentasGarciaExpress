<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'image', 'amount', 'user', 'bsf',
    ];
  
    public function inventories()
    {
      return $this->hasMany('App\Inventary');
    }
}
