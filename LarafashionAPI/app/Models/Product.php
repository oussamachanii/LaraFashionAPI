<?php

namespace App\Models;

use App\Models\Size;
use App\Models\Color;
use App\Models\Image;
use App\Models\Rating;
use App\Models\Category;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory , SoftDeletes;


    
    
    protected $fillable = [
        'title',
        'description',
        'price',
        'quantity',
        'shipping',
        'sex',
        'views',
        'category_id',
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
    public function ratings(){
       return  $this->hasMany(Rating::class);
    }
    public function purchases(){
       return  $this->hasMany(Purchase::class);
    }
    public function scopeFilter($query)
   {
         if (request('title')) {
            $query->where('title', 'LIKE', '%'.request('title').'%');
         }
         if (request('min')) {
            $query->where('price', '>=', request('min'));
         }
         if (request('max')) {
            $query->where('price', '<=', request('max'));
         }
         if (request('rating')) {
            // $query->where('rating', '==', request('rating'));
            $query->with('ratings')->whereHas('ratings',function($rating){$rating->where('number','=',request('rating'));});
         }
         if (request('category')) {
            $query->where('category_id', '=', request('category'));
         }
         if (request('size')) {
            $query->with('sizes')->whereHas('sizes',function($size){$size->where('id','=',request('size'));});
         }
         if (request('sex')) {
            $query->where('sex', '=', request('sex'));
         }
            return $query;
         }
         public function scopeDiscount($query)
         {
            return $query->where('discount_start_date','<=',now())->where('discount_end_date','>=',now());
         }
         public static function  isOnDiscount($product)
         {
            
            if ($product->discount < 0 || $product->discount_start_date > date("Y-m-d") || $product->discount_end_date < date("Y-m-d")) {
               return false;
           }
           return true;
         }
         public function scopeSearch($query)
         {
            $query->where('title', 'LIKE', '%'.request('search').'%')
            ->orWhere('price', '=', request('search'))
            ->orWhere('quantity', '=', request('search'))
            ;
            return $query;
         }
}

