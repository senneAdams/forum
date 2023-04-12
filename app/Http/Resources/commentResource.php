<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class commentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);

        return [
            "title"   => $this->Title,
            'content' => $this->Content,
            'rating'  => $this->Rating,
            'fromPostID' => $this->fromPostID
        ];
    }
}
