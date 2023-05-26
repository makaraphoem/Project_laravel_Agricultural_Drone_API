<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowLocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'province'=>$this->province,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            'drone'=> new DroneResource($this->drone)
        ];
    }
}
