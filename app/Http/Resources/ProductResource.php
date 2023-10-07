<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'color' => new ProductColorResource($this->whenLoaded('color')),
            'type' => new ProductTypeResource($this->whenLoaded('type')),
        ];
    }
}
