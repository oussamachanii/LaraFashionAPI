<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rating extends Model
{
    use HasFactory;
    protected $fillable=[
      'number',
      'product_id',
      'user_id',
  ];

    public function product()
    {
       return  $this->belongsTo(Product::class);
    }
    public function user()
    {
       return  $this->belongsTo(User::class);
    }
    public static function calculateRating($product)
    { 
       $number=0;
       foreach ($product->ratings as $rating) {
         $number = $number + $rating->number;
       }
    
      return ['stars'=> number_format($number/count($product->ratings))+0 ,'times'=>count($product->ratings)];
    }

}
