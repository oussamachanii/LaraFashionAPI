<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color extends Model
{
    use HasFactory; 
    protected $fillable=[
      'color_Hex'
  ];


    public function product()
    {
      return $this->belongsTo(Product::class);
    }
}

