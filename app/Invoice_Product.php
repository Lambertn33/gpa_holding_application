<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice_Product extends Model
{
    public $incrementing = false;
    protected $fillable = [
      'invoice_product_id','invoice_id','product_id','product','description','quantity','unit_cost','total_cost'
    ];
    protected $casts = [
        'invoice_product_id' => 'string',
        'invoice_id' => 'string',
        'product_id' => 'string'
    ];
}
