<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt_Product extends Model
{
    public $incrementing = false;
    protected $fillable = [
      'receipt_product_id','product_id','receipt_id','description','quantity','unit_cost','total_cost'
    ];
    protected $casts = [
        'receipt_product_id' => 'string',
        'receipt_id' => 'string',
        'product_id' => 'string'
    ];
}
