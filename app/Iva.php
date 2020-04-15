<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iva extends Model
{
    protected $fillable = [
        'name', 'value', 'status', 'user',
    ];
  
    public function quotations()
    {
        return $this->hasMany('App\Quotation');
    }
}
