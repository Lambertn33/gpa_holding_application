<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $incrementing = false;
    protected $fillable = ['id','name','details'];
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    protected $casts = [
        'id' => 'string'
    ];
}
