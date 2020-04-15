<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = [
        'date', 'iden', 'user',
    ];
  
    public function inventories()
    {
      return $this->hasMany('App\Inventory');
    }
}
