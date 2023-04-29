<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AllinCampaign extends Model
{
    use HasFactory;

    
  

    public function cuelinkcampaigns()
    {
        return $this->hasOne(CuelinkCampaign::class,'id', 'campaign_id');
    }
    public function admited()
    {
        return $this->hasOne(Api_Advcampaign::class,'id', 'admited_id');
    }
    public function impact()
    {
        return $this->hasOne(Offer::class,'id', 'impact_id');
    }


   
}