<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Purchase;
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
    public function purchase()
    {
        return $this->hasMany(Purchase::class);
    }
    // public function shortInfo()
    // {
    //   // return ['id'=> $this->id,'hex'=> $this->color_Hex];
    //   return $this->only('id','color_Hex');
    // }

}

