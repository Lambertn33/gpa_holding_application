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
    protected $casts = [
        'id' => 'string'
    ];
}
