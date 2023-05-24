<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowPlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'name'=> $this->id,
            'spraying'=> $this->spraying,
            'seeding'=>$this->seeding,
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date,
            'area'=>$this->area,
            'drone'=>DroneResource::collection($this->drones),
            'farmer'=> new UserResource($this->user), 
        ];
    }
}
