<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quotes_item;
use App\Models\Lead;
use App\Models\Purchaser_quote;

class Quotes extends Model
{
    use HasFactory;

       protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'qoute_status',
    ];

    public function items()
    {
        return $this->hasMany(Quotes_item::class,'quote_id','id');
    }
    public function lead()
    {
        return $this->hasOne(Lead::class,'id','lead_id');
    }
    public function purchaser()
    {
        return $this->hasOne(Purchaser_quote::class,'quote_id','id');
    }
}
