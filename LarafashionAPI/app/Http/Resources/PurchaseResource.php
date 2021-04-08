<?php

namespace App\Http\Resources;

use App\Http\Resources\ColorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
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
            'purchaser'=> $this->user->first_name.' '.$this->user->last_name,
            'product_id'=> $this->product_id,
            'email'=> $this->user->email,
            'size'=> $this->size->title,
            'color'=> $this->color->color_Hex,
            'quantity'=> $this->quantity,
            'date'=> date_format($this->created_at,"Y/m/d"),
            'price'=> $this->total_price,
        ];
    }
}
