<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseResource;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            return PurchaseResource::collection(Purchase::orderByDesc('created_at')->search()->paginate($request->pagination ?? 50));
        }
        return PurchaseResource::collection(Purchase::orderByDesc('created_at')->paginate($request->pagination ?? 50));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $product->update(['quantity'=>$request->quantity-$request->quantity]);
        return Purchase::create($request->only(['quantity','total_price','user_id','size_id','color_id','product_id']));
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
    public function destroy(Purchase $purchase)
    {
        return $purchase->delete();
    }
}
