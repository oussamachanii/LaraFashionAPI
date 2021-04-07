<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
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
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json()
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // return response()->json($product->baseInfo());
        // return response()->json((object) ['product'=>$product , 'images'=> $product->images]);
        // return response()->json((object) [
        //     'product'=>$product->shortInfo() ,
        //     'sizes'=> $product->sizes->map(function ($image){return $image->shortInfo();}),
        //     'colors'=> $product->colors->map(function ($color){return $color->shortInfo();}),
        //     'images'=> $product->images->map(function ($image){return $image->shortInfo();}),
        //     'rating'=> $product->calculateRating(),
        
        
        // ]);
        return ProductResource::collection($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    }

