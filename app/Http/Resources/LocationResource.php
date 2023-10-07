<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            'period_start' => $this->period_start->format('Y-m-d H:m:s'),
            'period_start_iso' => $this->period_start->isoFormat('lll'),
            'period_end' => $this->period_end?->format('Y-m-d H:m:s'),
            'period_end_iso' => $this->period_end?->isoFormat('lll'),
            'product' => new ProductResource($this->whenLoaded('product')),
            'warehouse' => new WarehouseResource($this->whenLoaded('warehouse')),
        ];
    }
}
