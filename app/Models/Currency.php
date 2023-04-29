<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'country_name','country_code','currency_code', 'currency_symbol', 'phone_code'
    ];
}