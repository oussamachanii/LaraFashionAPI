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
        'price' => $this->price ,
        'shipping' => $this->shipping ,
        'sex' => $this->sex ,
        'views' => $this->views ,
        'discount' => $this->discount ,
        'discount_start_date' => $this->discount_start_date ,
        'discount_end_date' => $this->discount_end_date ,
        'colors'=> ColorResource::collection($this->colors),
        'sizes'=> SizeResource::collection($this->sizes),
        'images' => ImageResource::collection(is_null($this->images->first()) ? [] : ImageResource::collection($this->images)),
        'rating'=> Rating::calculateRating($this),
        ];
    }
 

}
