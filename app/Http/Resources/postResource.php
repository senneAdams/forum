<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\commentResource;

class postResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);

        return [
            "title"   => $this->Title,
            'content' => $this->Content,
            'rating'  => $this->Rating,
            'comments' => commentResource::collection($this->comments)
        ];
    }
}
