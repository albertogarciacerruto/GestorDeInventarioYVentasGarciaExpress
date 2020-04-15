<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'date_init', 'date_finish', 'quantity', 'iva', 'total', 'status', 'client_id', 'user', 'iva_id', 'dolar_value',
    ];
  
    public function inventories()
    {
      return $this->belongsToMany('App\Inventory');
    }
  
    public function iva()
    {
      return $this->belongsTo('App\iva');
    }

    public function services()
    {
      return $this->belongsToMany('App\Service');
    }

}
