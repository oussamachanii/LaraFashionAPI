<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['url'];
    public function product(){
      return   $this->belongsTo(Product::class);
    }
    public function shortInfo()
    {
      return ['id'=> $this->id,'src'=> Storage::url($this->url)];
      
    }
}
