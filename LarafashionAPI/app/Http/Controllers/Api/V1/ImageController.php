<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->productId) {
            # code...
            return ImageResource::collection(Product::find($request->productId)->images);
        }
        return ImageResource::collection(Image::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Product $product)
    {
        $request->validate([
            // "image" => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:‭10240‬'
            "image" => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ]);
        if ($request->hasFile('image')) {
            $image = Image::create(["url"=> Storage::putFile('images', $request->file("image")) , 'product_id'=>$product->id]);
            return ImageResource::collection([$image]);
        }
        return response()->json(404);
        
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        Storage::delete($image->url);
        return $image->delete();
    }
}
