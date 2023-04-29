<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','admitad_cat_id','language' ];

    protected $casts = [
        'parent_id' => 'integer',
        'position' => 'integer',
        'priority' => 'integer',
        'status' => 'integer'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', '=', 1);
    }

    public function childes()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
	 public function cueoffers()
    {
        return $this->hasMany(CuelinkOffer::class,'category_id', 'cue_cat_id');
    }

    public function admitadoffers()
    {
        return $this->hasMany(Api_Advcampaign::class, 'cat_id');
    }
	public function cuecampaigns()
    {
        return $this->hasMany(CuelinkCampaign::class,'category_id', 'cue_cat_id');
    }
	public function ads()
    {
        return $this->hasMany(Offer::class,'category_id');
    }
}
