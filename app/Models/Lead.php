<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Lead extends Model
{
    use HasFactory;

      public function sales()
    {
        return $this->hasOne(User::class, 'id', 'assigned_id');
    }
}
