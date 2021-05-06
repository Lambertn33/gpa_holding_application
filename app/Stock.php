<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Stock extends Model
{
    public $incrementing = false;
    protected $fillable = [
      'id',
      'product',
      'supplier',
      'remainingQuantity',
      'buying_price',
      'selling_price',
      'date',
      'entry_by'
    ];
    public function stock_records()
    {
        return $this->hasMany('App\Stock_Record');
    }
    protected $casts = [
        'id' => 'string',
    ];
}
