<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Rating;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;

class HomePageController extends Controller
{
  
    public function trend()
    {
        // $products = Product::orderByDesc('views')->take(4)->get();
        // return response()->json($products->map(function($product){return $product->baseInfo();}));
        return ProductResource::collection(Product::orderByDesc('views')->take(4)->get());
       }
    public function deals()
    {
        // $products = Product::orderByDesc('discount')->with(['sizes','colors','images'])->where('discount_start_date','<',now())->where('discount_end_date','>=',now())->take(4)->get();
        // return response()->json($products->map(function($product){return $product->baseInfo();}));
        return ProductResource::collection(Product::orderByDesc('discount')->where('discount_start_date','<',now())->where('discount_end_date','>=',now())->take(4)->get());
    }
    public function rated()
    {
        // $products = Product::with(['sizes','colors','images'])->withCount('ratings')->orderByDesc('ratings_count')->take(4)->get();
        // return response()->json($products->map(function($product){return $product->baseInfo();}));
        return ProductResource::collection(Product::with(['sizes','colors','images'])->withCount('ratings')->orderByDesc('ratings_count')->take(4)->get());
    }
}
