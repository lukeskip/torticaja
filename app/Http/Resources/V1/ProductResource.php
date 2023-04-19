<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id'=> $this->id,
            'label'=> $this->label,
            'price'=> $this->price,
            'amount'=> $this->amount,
            'quantity'=> $this->quantity,
            'unit'=> $this->unit,
            'image'=> $this->image,
        ];

    }
}
