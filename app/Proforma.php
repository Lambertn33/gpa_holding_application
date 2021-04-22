<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proforma extends Model
{
    public $incrementing = false;
    protected $fillable = ['id','client_id','isConfirmed','status','date'];
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    public function products()
    {
      return $this->belongsToMany(Product::class ,'proforma__products')->withPivot('description','quantity','unit_cost','total_cost');
    }
    protected $casts = [
        'id' => 'string'
    ];
}
