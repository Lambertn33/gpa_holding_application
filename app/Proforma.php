<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proforma extends Model
{
    protected $fillable = ['id','client_id','status','product','description','date','quantity','unit_cost','total_cost'];
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    protected $casts = [
        'id' => 'string'
    ];
}
