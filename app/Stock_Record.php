<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock_Record extends Model
{
    protected $fillable = ['id','stock_id','date','recorded_quantity'];

    public function stock()
    {
        return $this->belongsTo('App\Stock');
    }
    protected $casts = [
        'id' => 'string'
    ];
}
