<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name'=> $this->first_name.' '.$this->last_name,
            'email'=>$this->email,
            'location'=>$this->city.','.$this->region.','.$this->country.','.$this->code_postal,
            'address'=>$this->address,
            'role'=>$this->is_admin,
            'registerDate'=> date_format($this->created_at,"Y/m/d"),
        ];
    }
}
