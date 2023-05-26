<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowMapResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 'id'=>$this->id,
            // 'name'=>$this->name,
            'image'=>$this->image,
            // 'drone'=> new DroneResource($this->drone),
            // 'farm'=>new FarmResource($this->farm) 
        ];
    }
}
