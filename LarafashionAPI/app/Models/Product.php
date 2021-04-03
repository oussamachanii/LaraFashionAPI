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
        'title',
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
    public function ratings(){
       return  $this->hasMany(Rating::class);
    }
    public function shortInfo(){
       return  $this->only(['id','title','description','price','shipping','sex','views','discount','discount_start_date','discount_end_date',]);
    }
    public function baseInfo(){
       return  [
          'data'=>$this->shortInfo() ,
      //  'image'=>$this->images->first()->shortInfo() ? $this->images[0]->shortInfo() : null,
       'image'=>is_null($this->images->first())? []:$this->images->first()->shortInfo(),
       'sizes'=>$this->sizes->map(function($size){
           return $size->shortInfo();
       }) ,
       'colors'=>$this->colors->map(function($color){
           return $color->shortInfo();
       }) ,
       'rating'=> $this->calculateRating()
       
      ];
    }
    public function calculateRating()
    { 
       $number=0;
       $i=0;
       $ratings =$this->ratings;
      //  $ratings->each(function($rating){
      //    $i++;
      //    $number = $number + $rating->number;
      //  });
       foreach ($ratings as $rating) {
         $i++;
         $number = $number + $rating->number;
       }
       if ($i == 0) {
          return 0 ;
       }
      return ['stars'=> number_format($number/$i)+0 ,'times'=>$i];
    }
}

