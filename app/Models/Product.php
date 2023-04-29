<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;
    public function scopeActive($query)
    {
        return $query->where('status', '=', 1);
    }

	 public function product_prices()
    {
        return $this->hasMany(ProductPrice::class,'product_id');
    }
    
	
	 public function images()
    {
        return $this->hasMany(Image::class,'product_id');
    }
}
