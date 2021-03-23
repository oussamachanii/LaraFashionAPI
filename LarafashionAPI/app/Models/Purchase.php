<?php

namespace App\Models;

use App\Models\User;
use App\Models\Edition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function edition(){
        return $this->belongsTo(Edition::class);
    }
}
