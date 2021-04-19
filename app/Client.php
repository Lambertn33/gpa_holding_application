<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'id',
        'client_Names',
        'Tin',
        'contact_Names',
        'Address',
        'phone_No',
        'email',
    ];
    public function proformas()
    {
        return $this->hasMany('App\Proforma');
    }
    protected $casts = [
        'id' => 'string'
    ];
}
