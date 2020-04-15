<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        'name', 'rif', 'address', 'email', 'phone', 'user',
    ];
}
