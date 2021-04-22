<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proforma_Product extends Model
{
    public $incrementing = false;
    protected $fillable = [
      'proforma_product_id','product_id','proforma_id','description','quantity','unit_cost','total_cost'
    ];
    protected $casts = [
        'proforma_product_id' => 'string',
        'proforma_id' => 'string',
        'product_id' => 'string'
    ];
}
