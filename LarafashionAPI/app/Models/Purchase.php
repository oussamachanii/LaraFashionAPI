<?php

namespace App\Models;

use App\Models\Size;
use App\Models\User;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable=[
        'quantity',
        'total_price',
        'user_id',
        'size_id',
        'color_id',
        'product_id',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function size(){
        return $this->belongsTo(Size::class);
    }
    public function color(){
        return $this->belongsTo(Color::class);
    }
    public function scopeSearch($query)
    {
            $query->with('user')->whereHas('user',function($user){
                $user->where('first_name', 'LIKE', '%'.request('search').'%')
                ->orWhere('last_name', 'LIKE', '%'.request('search').'%')
                ;})
            ->orWhere('total_price', '=', request('search'))
            ->orWhere('product_id', '=', request('search'));
            return $query;
    }
}
