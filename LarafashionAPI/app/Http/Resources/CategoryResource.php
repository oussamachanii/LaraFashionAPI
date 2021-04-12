<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['id'=>$this->id,'title'=>$this->title,'date'=>date_format($this->created_at,"Y/m/d"),'products'=>$this->products->count()??0];
    }
}
