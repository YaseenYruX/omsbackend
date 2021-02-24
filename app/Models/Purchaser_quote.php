<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quotes;
use App\Models\Quotes_item;

class Purchaser_quote extends Model
{
    use HasFactory;
    protected $table='purchaser_quote';
    public function quote()
    {
        return $this->hasOne(Quotes::class,'id','quote_id');
    }
    public function quoteitems(){
        return $this->hasMany(Quotes_item::class,'quote_id','quote_id');
    }
}
