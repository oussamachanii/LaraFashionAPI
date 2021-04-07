<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;

class SearchController extends Controller
{
    public function bag(Request $request)
    {
            // $products = Product::find($request->ids);
            // return $products->map(function ($product){return $product->baseInfo(); });      
            return ProductResource::collection(Product::find($request->ids));
    }
    public function search()
    {
        // $products = collect(Product::paginate(4)); 
        // $ids = collect($products['data'])->map(function($product){return $product['id'];});
        // $products['data']= collect( Product::find($ids))->map(function ($product){return $product->baseInfo(); });
        
        // return [
        //     'products'=> $products,
        //     'categories'=> Category::select(['title'])->withCount('products')->orderByDesc('products_count')->take(5)->get() ,
        // ];
        return  ProductResource::collection(Product::all());
    }
}
