<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Edition extends Model
{
    use HasFactory;

    public function product(){
      return   $this->belongsTo(Product::class);
    }
    public function purchases(){
       return  $this->hasMany(Purchase::class);
    }
}
