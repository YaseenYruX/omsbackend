<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotes_purchaser_price extends Model
{
    use HasFactory;
    protected $table='quotes_purchaser_price';
    public function brand()
    {
    	return $this->hasOne(M_flag::class,'id','brand_id');
    }
    public function condition()
    {
    	return $this->hasOne(M_flag::class,'id','condition_id');
    }
}
