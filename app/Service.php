<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name', 'description', 'amount', 'user', 'bsf',
    ];
    
    public function quotations()
    {
      return $this->belongsToMany('App\Quotation');
    }
}
