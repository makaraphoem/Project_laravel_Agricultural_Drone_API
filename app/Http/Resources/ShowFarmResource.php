<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowFarmResource extends JsonResource
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
            'farm_name'=>$this->name,
            'size'=>$this->size,
            'farming_type'=>$this->farming_type,
            'user'=> new UserResource($this->user), 
            'maps'=>$this->maps
        ];
    }
}
