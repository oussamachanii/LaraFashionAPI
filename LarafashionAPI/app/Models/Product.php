<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}

