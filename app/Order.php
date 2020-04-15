<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'date_init', 'date_aprox', 'date_final', 'num_product', 'iva', 'total', 'bank', 'confirmation', 'payment_id', 'image', 'client_id', 'quotation_id', 'status', 'user', 'suggestion', 'iva_id', 'dolar_value',
    ];
  
    public function payments()
    {
      return $this->belongsToMany('App\Payment');
    }
}
