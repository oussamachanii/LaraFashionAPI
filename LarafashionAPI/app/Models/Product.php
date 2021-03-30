<?php

namespace App\Models;

use App\Models\Size;
use App\Models\Color;
use App\Models\Image;
use App\Models\Rating;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory , SoftDeletes;
    
    protected $fillable = [
        'name',
        'description',
        'price',
        'shipping',
        'sex',
        'views',
        'discount',
        'discount_start_date',
        'discount_end_date',
    ];
    public function category(){
       return  $this->belongsTo(Category::class);
    }
   public function colors()
   {
      return $this->hasMany(Color::class);
   }
   public function sizes()
   {
      return $this->hasMany(Size::class);
   }
   public function images(){
       return  $this->hasMany(Image::class);
    }
    public function rating(){
       return  $this->hasMany(Rating::class);
    }
}

