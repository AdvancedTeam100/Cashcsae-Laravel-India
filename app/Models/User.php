<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','phone','password','cm_firebase_token','phone','image','social_id','register_via',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	
	 public function earning()
    {
        return $this->hasOne(Earning::class,'user_id');
    }
	
	 public function bank_detail()
    {
        return $this->hasOne(BankDetail::class,'user_id');
    }
	
	 public function withdrawal_request()
    {
        return $this->hasMany(WithdrawalReq::class,'user_id');
    }
	public function complain()
    {
        return $this->hasMany(Complain::class,'user_id');
    }
	public function order()
    {
        return $this->hasMany(Order::class,'user_id');
    }
	public function referral()
    {
        return $this->hasMany(Referral::class,'user_id');
    }
}
