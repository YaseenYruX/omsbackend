<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quotes;

class Purchaser_quote extends Model
{
    use HasFactory;
    protected $table='purchaser_quote';
    public function quote()
    {
        return $this->hasOne(Quotes::class,'id','quote_id');
    }
}
