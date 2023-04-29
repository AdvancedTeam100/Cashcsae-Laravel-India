<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class HomeAdv extends Model
{
    use HasFactory;

    protected $casts = [
        'rank' => 'integer'
    ];

  

    public function adv()
    {
        return $this->hasOne(Partner::class,'id', 'p_id');
    }

   
}
