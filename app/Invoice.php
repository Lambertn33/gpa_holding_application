<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public $incrementing = false;
    protected $fillable = ['id','client','isConfirmed','status','date'];
    protected $casts = [
        'id' => 'string'
    ];
    public function products()
    {
      return $this->belongsToMany(Product::class ,'invoice__products')->withPivot('description','quantity','unit_cost','total_cost');
    }
}
