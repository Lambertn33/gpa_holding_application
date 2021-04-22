<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public $incrementing = false;
    protected $fillable = [
        'id',
        'names',
        'address',
        'phone_No'
    ];
    protected $casts = [
        'id' => 'string'
    ];
}
