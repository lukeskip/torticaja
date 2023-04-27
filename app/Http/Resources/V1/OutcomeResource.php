<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class OutcomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {   
        $path_photo = 'storage/img/outcomes/'.$this->photo;
        return[
            'id'=>$this->id,
            'label'=>$this->label,
            'slug'=>$this->slug,
            'amount'=>$this->amount,
            'category'=>$this->category,
            'photo'=> $path_photo,
            'date'=> $this->date,
        ];

    }
}
