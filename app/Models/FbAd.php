<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class FbAd extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => 'integer'
    ];

    
}