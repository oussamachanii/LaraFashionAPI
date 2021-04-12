<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductDashboardResource;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            return ProductDashboardResource::collection(Product::orderByDesc('created_at')->search()->paginate($request->pagination ?? 50));
        }
       return ProductDashboardResource::collection(Product::orderByDesc('created_at')->paginate($request->pagination ?? 50));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            "title" => 'required',
            "description" => 'required',
            "price" => 'required|numeric',
            "quantity" => 'required',
            "sex" => 'required',
            "price" => 'required',
            "category_id" => 'required',
         ]);
        $product = Product::create($request->only(['title','description','price','quantity','sex','price','category_id']));
         return ProductResource::collection([$product]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return ProductResource::collection([$product]);
        // return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        
        return $product->update($request->only(['title','price','sex','description','discount','discount_start_date','discount_end_date','shipping','quantity','category_id']));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        return $product->delete();
    }
    public function bag(Request $request)
    {
            // $products = Product::find($request->ids);
            // return $products->map(function ($product){return $product->baseInfo(); });      
            return ProductResource::collection(Product::find($request->ids));
    }
    public function search(Request $request)
    {
        return  ProductResource::collection(Product::filter()->paginate($request->pagination ?? 10));
    }
}

