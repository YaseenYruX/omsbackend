<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quotes_purchaser_price;

class Quotes_item extends Model
{
    use HasFactory;
    protected $table='rfq_quotes_item';

    public function prices()
    {
    	return $this->hasMany(Quotes_purchaser_price::class,'quotes_item_id','id');
    }
}
