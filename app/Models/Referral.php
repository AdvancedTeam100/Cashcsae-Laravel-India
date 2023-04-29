<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Referral extends Model
{
    use HasFactory;

   public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
  
	
	 public function referraluser()
    {
        return $this->belongsTo(User::class, 'referred_user_id');
    }
    
}