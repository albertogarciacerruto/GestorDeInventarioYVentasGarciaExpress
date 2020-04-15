<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name', 'store', 'user',
    ];
  
    public function inventories()
    {
        return $this->hasMany('App\Inventory');
    }
}
