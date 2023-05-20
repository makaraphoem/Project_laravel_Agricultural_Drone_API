<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DroneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=>$this->name,
            'sensor'=>$this->sensor,
            'playoad_capacity'=>$this->playoad_capacity,
            'batter_life'=>$this->batter_life,
        ];
    }
}
