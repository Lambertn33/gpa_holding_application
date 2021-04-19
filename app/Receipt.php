<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = ['id','client','date','product','description','duration','amount'];
    protected $casts = [
        'id' => 'string'
    ];
}
