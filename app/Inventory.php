<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'quantity', 'batch_id', 'location_id', 'product_id', 'status', 'user',
    ];
  
    public function product()
    {
      return $this->belongsTo('App\Product');
    }
    public function batch()
    {
      return $this->belongsTo('App\Batch');
    }
    public function location()
    {
      return $this->belongsTo('App\Location');
    }
    public function quotations()
    {
      return $this->belongsToMany('App\Quotation');
    }
}
