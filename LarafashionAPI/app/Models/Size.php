<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Size extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'product_id',
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
    // return $this->only(['id','title','product_id']);
    // }
}

