<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
      'id',
      'product',
      'supplier',
      'quantity',
      'buying_price',
      'selling_price',
      'date'
    ];
    protected $casts = [
        'id' => 'string',
    ];
}
