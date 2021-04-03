<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['id','name','details','category_id','price'];
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    protected $casts = [
        'id' => 'string'
    ];
}
