<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    public $incrementing = false;
    protected $fillable = ['id','client','isConfirmed','date'];
    protected $casts = [
        'id' => 'string'
    ];
    public function products()
    {
      return $this->belongsToMany(Product::class,'receipt__products')->withPivot('description','duration','amount');
    }
}
