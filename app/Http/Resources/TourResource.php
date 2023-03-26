<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TourResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'image' => $this->image,
//            'place_id' => $this->place_id,
//            'discount_id' => $this->discount_id,
            'place' => new PlaceResource($this->place),
            'discount' => new DiscountResource($this->discount),
            'created_at' => $this->created_at
        ];
    }
}
