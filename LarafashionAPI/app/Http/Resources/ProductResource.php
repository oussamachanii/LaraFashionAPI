<?php

namespace App\Http\Resources;

use App\Http\Resources\SizeResource;
use App\Http\Resources\ColorResource;
use App\Http\Resources\ImageResource;
use App\Models\Rating;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
         'id'=> $this->id,
        'title' => $this->title ,
        'description' => $this->description ,
        'price' => $this->price ?? 0 ,
        'shipping' => $this->shipping ?? 0 ,
        'sex' => $this->sex ,
        'views' => $this->views ?? 0 ,
        'quantity' => $this->quantity ?? 0,
        'discount' => $this->discount ?? 0,
        'discount_start_date' => $this->discount_start_date ,
        'discount_end_date' => $this->discount_end_date ,
        'category_id' => $this->category->id ,
        'colors'=> ColorResource::collection($this->colors),
        'sizes'=> SizeResource::collection($this->sizes),
        'images' => ImageResource::collection(is_null($this->images->first()) ? [] : ImageResource::collection($this->images)),
        'rating'=> Rating::calculateRating($this),
        ];
    }
 

}
