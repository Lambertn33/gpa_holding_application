<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['id','client','status','date','product','description','quantity','unit_cost','total_cost'];
    protected $casts = [
        'id' => 'string'
    ];
}
