<?php

namespace App\Http\Resources;

use App\Models\Rating;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDashboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->title,
            'price'=>$this->price,
            'quantity'=>$this->quantity,
            'sex'=>$this->sex,
            'purchases'=>$this->purchases->count(),
            'rating'=> Rating::calculateRating($this),
            'date'=> date_format($this->created_at,"Y/m/d"),
            'onDiscount'=> Product::isOnDiscount($this)
        ];
    }
}
