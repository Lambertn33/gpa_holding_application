<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $incrementing = false;
    protected $fillable = ['id','name','details','category_id','price'];
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function receipts()
    {
      return $this->belongsToMany(Receipt::class,'receipt__products')->withPivot('description','quantity','unit_cost','total_cost');
    }
    public function proformas()
    {
      return $this->belongsToMany(Proforma::class ,'proforma__products')->withPivot('description','quantity','unit_cost','total_cost');
    }
    public function invoices()
    {
      return $this->belongsToMany(Invoice::class ,'invoice__products')->withPivot('description','quantity','unit_cost','total_cost');
    }
    protected $casts = [
        'id' => 'string'
    ];
    public function getSellingPrice()
    {
       return $this->price;
    }
}
