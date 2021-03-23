<?php

namespace App\Models;

use App\Models\Edition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Size extends Model
{
    use HasFactory;

    public function editions()
    {
        return $this->belongsToMany(Edition::class);
    }
}

