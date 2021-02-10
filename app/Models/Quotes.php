<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quotes_item;

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
        return $this->hasMany(Quotes_item::class,'quotes_id','id');
    }
}
