<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'email', 'lastname', 'identification_number', 'address', 'user', 'status', 'phone',
    ];

    public function quotations()
    {
        return $this->hasMany('App\Quotation');
    }
}