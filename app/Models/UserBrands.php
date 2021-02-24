<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brands;

class UserBrands extends Model
{
    use HasFactory;
    protected $table='user_brands';

    public function brand_get()
    {
    	return $this->hasOne(Brands::class,'id','brand_id');
    }
    public function brand()
    {
    	return $this->BelongsTo(Brands::class,'brand_id');
    }
}
