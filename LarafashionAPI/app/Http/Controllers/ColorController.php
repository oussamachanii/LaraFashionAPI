<?php

namespace App\Http\Controllers;

use App\Http\Resources\ColorResource;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class ColorController extends Controller
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
            return ColorResource::collection(Product::find($request->productId)->colors);
        }
        return ColorResource::collection(Color::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['color_Hex'=>'required','product_id'=>'required']);
        $color = Color::create(['color_Hex'=>'#'.$request->color_Hex,'product_id'=>$request->product_id]);
        return ColorResource::collection([$color]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy(Color $color)
    {
        return $color->delete();
    }
}
